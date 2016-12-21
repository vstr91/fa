<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of TipoCursoController
 *
 * @author Almir
 */
class ParametrosEmailController extends Controller {
    
    public function cadastrarAction($id_parametros_email){
        $parametros = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $parametros = $em->find('FaSiteBundle:ParametroEmail', $id_parametros_email);
        
        //se nao existir, cria novo objeto
        if(is_null($parametros)){
            $id_parametros_email = new \Fa\SiteBundle\Entity\ParametroEmail();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\ParametroEmailType(), $parametros);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($parametros);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_parametros_email'));
        }
        
        return $this->render('FaSiteBundle:Admin:TipoCurso/index.html.twig', array(
            'usuario' => $user,
            'formParametros' => $form->createView()
        ));
        
    }
    
    public function formAction($id_parametros_email){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $parametros = $em->find('FaSiteBundle:ParametrosEmail', $id_parametros_email);
        
        if(is_null($parametros)){
            $parametros = new \Fa\SiteBundle\Entity\ParametroEmail();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\ParametroEmailType(), $parametros);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:ParametrosEmail/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'parametros' => $parametros
                ));
    }
    
}
