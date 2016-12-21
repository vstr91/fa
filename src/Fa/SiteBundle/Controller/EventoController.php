<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of EventoController
 *
 * @author Almir
 */
class EventoController extends Controller {
    
    public function cadastrarAction($id_evento){
        $evento = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $evento = $em->find('FaSiteBundle:Evento', $id_evento);
        
        //se nao existir, cria novo objeto
        if(is_null($evento)){
            $evento = new \Fa\SiteBundle\Entity\Evento();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\EventoType(), $evento);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $evento->setSlug($evento->getTitulo());
            
            $em->persist($evento);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_eventos'));
        }
        
        $eventos = $em->getRepository('FaSiteBundle:Evento')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Evento/index.html.twig', array(
            'usuario' => $user,
            'eventos' => $eventos,
            'formEvento' => $form->createView()
        ));
        
    }
    
    public function formAction($id_evento){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $evento = $em->find('FaSiteBundle:Evento', $id_evento);
        
        if(is_null($evento)){
            $evento = new \Fa\SiteBundle\Entity\Evento();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\EventoType(), $evento);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Evento/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'evento' => $evento
                ));
    }
    
    public function excluirAction($id_evento){
        $evento = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $evento = $em->find('FaSiteBundle:Evento', $id_evento);
        
        //se nao existir, cria novo objeto
        if(!is_null($evento)){
            $em->remove($evento);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_eventos'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
