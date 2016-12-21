<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of DestaqueMenuController
 *
 * @author Almir
 */
class DestaqueMenuController extends Controller {
    
    public function cadastrarAction($destaque_menu){
        $destaqueMenu = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $destaqueMenu = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findOneBy(array('menu' => $destaque_menu));
        
        //se nao existir, cria novo objeto
        if(is_null($destaqueMenu)){
            $destaqueMenu = new \Fa\SiteBundle\Entity\DestaqueMenu();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\DestaqueMenuType(), $destaqueMenu);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($destaqueMenu);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_destaques_menu'));
        }
        
        $destaques = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:DestaqueMenu/index.html.twig', array(
            'usuario' => $user,
            'destaques' => $destaques,
            'formDestaqueMenu' => $form->createView()
        ));
        
    }
    
    public function formAction($destaque_menu){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $destaqueMenu = $em->getRepository('FaSiteBundle:DestaqueMenu')->
                findOneBy(array('menu' => $destaque_menu));
        
        if(is_null($destaqueMenu)){
            $destaqueMenu = new \Fa\SiteBundle\Entity\DestaqueMenu();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\DestaqueMenuType(), $destaqueMenu);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:DestaqueMenu/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'destaqueMenu' => $destaqueMenu
                ));
    }
    
    public function excluirAction($destaque_menu){
        $destaqueMenu = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $destaqueMenu = $em->getRepository('FaSiteBundle:DestaqueMenu')->
                findOneBy(array('menu' => $destaque_menu));
        
        //se nao existir, cria novo objeto
        if(!is_null($destaqueMenu)){
            $em->remove($destaqueMenu);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_destaques_menu'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
