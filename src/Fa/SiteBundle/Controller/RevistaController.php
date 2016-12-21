<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of RevistaController
 *
 * @author Almir
 */
class RevistaController extends Controller {
    
    public function cadastrarAction($id_revista){
        $revista = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $revista = $em->find('FaSiteBundle:Revista', $id_revista);
        
        //se nao existir, cria novo objeto
        if(is_null($revista)){
            $revista = new \Fa\SiteBundle\Entity\Revista();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\RevistaType(), $revista);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            $revista->setSlug($revista->getTitulo());
            
            $em->persist($revista);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_revistas'));
        }
        
        $revistas = $em->getRepository('FaSiteBundle:Revista')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Revista/index.html.twig', array(
            'usuario' => $user,
            'revistas' => $revistas,
            'formRevista' => $form->createView()
        ));
        
    }
    
    public function formAction($id_revista){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $revista = $em->find('FaSiteBundle:Revista', $id_revista);
        
        if(is_null($revista)){
            $revista = new \Fa\SiteBundle\Entity\Revista();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\RevistaType(), $revista);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Revista/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'revista' => $revista
                ));
    }
    
    public function excluirAction($id_revista){
        $revista = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $revista = $em->find('FaSiteBundle:Revista', $id_revista);
        
        //se nao existir, cria novo objeto
        if(!is_null($revista)){
            $em->remove($revista);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_revistas'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
