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
class TipoCursoController extends Controller {
    
    public function cadastrarAction($id_tipo_curso){
        $tipoCurso = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $tipoCurso = $em->find('FaSiteBundle:TipoCurso', $id_tipo_curso);
        
        //se nao existir, cria novo objeto
        if(is_null($tipoCurso)){
            $tipoCurso = new \Fa\SiteBundle\Entity\TipoCurso();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\TipoCursoType(), $tipoCurso);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($tipoCurso);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_tipos_curso'));
        }
        
        $tiposCurso = $em->getRepository('FaSiteBundle:TipoCurso')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:TipoCurso/index.html.twig', array(
            'usuario' => $user,
            'tiposCurso' => $tiposCurso,
            'formTipoCurso' => $form->createView()
        ));
        
    }
    
    public function formAction($id_tipo_curso){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $tipoCurso = $em->find('FaSiteBundle:TipoCurso', $id_tipo_curso);
        
        if(is_null($tipoCurso)){
            $tipoCurso = new \Fa\SiteBundle\Entity\TipoCurso();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\TipoCursoType(), $tipoCurso);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:TipoCurso/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'tipoCurso' => $tipoCurso
                ));
    }
    
    public function excluirAction($id_tipo_curso){
        $tipoCurso = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $tipoCurso = $em->find('FaSiteBundle:TipoCurso', $id_tipo_curso);
        
        //se nao existir, cria novo objeto
        if(!is_null($tipoCurso)){
            $em->remove($tipoCurso);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_tipos_curso'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
