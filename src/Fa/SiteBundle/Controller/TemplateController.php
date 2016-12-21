<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of TemplateController
 *
 * @author Almir
 */
class TemplateController extends Controller {
    
    public function cadastrarAction($id_template){
        $template = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $template = $em->find('FaSiteBundle:Template', $id_template);
        
        //se nao existir, cria novo objeto
        if(is_null($template)){
            $template = new \Fa\SiteBundle\Entity\Template();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\TemplateType(), $template);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($template);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_templates'));
        }
        
        $templates = $em->getRepository('FaSiteBundle:Template')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Template/index.html.twig', array(
            'usuario' => $user,
            'templates' => $templates,
            'formTemplate' => $form->createView()
        ));
        
    }
    
    public function formAction($id_template){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $template = $em->find('FaSiteBundle:Template', $id_template);
        
        if(is_null($template)){
            $template = new \Fa\SiteBundle\Entity\Template();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\TemplateType(), $template);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Template/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'template' => $template
                ));
    }
    
    public function excluirAction($id_template){
        $template = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $template = $em->find('FaSiteBundle:Template', $id_template);
        
        //se nao existir, cria novo objeto
        if(!is_null($template)){
            $em->remove($template);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_templates'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
