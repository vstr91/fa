<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of NoticiaController
 *
 * @author Almir
 */
class NoticiaController extends Controller {
    
    public function cadastrarAction($id_noticia){
        $noticia = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $noticia = $em->find('FaSiteBundle:Noticia', $id_noticia);
        
        //se nao existir, cria novo objeto
        if(is_null($noticia)){
            $noticia = new \Fa\SiteBundle\Entity\Noticia();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\NoticiaType(), $noticia);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            $noticia->setSlug($noticia->getTitulo());
            
            $em->persist($noticia);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_noticias'));
        }
        
        $noticias = $em->getRepository('FaSiteBundle:Noticia')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Noticia/index.html.twig', array(
            'usuario' => $user,
            'noticias' => $noticias,
            'formNoticia' => $form->createView()
        ));
        
    }
    
    public function formAction($id_noticia){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $noticia = $em->find('FaSiteBundle:Noticia', $id_noticia);
        
        if(is_null($noticia)){
            $noticia = new \Fa\SiteBundle\Entity\Noticia();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\NoticiaType(), $noticia);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Noticia/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'noticia' => $noticia
                ));
    }
    
    public function excluirAction($id_noticia){
        $noticia = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $noticia = $em->find('FaSiteBundle:Noticia', $id_noticia);
        
        //se nao existir, cria novo objeto
        if(!is_null($noticia)){
            $em->remove($noticia);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_noticias'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
