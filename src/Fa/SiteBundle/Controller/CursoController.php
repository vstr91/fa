<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of CursoController
 *
 * @author Almir
 */
class CursoController extends Controller {
    
    public function cadastrarAction($id_curso){
        $curso = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $curso = $em->find('FaSiteBundle:Curso', $id_curso);
        
        //se nao existir, cria novo objeto
        if(is_null($curso)){
            $curso = new \Fa\SiteBundle\Entity\Curso();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\CursoType(), $curso);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($curso);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_cursos'));
        }
        
        $cursos = $em->getRepository('FaSiteBundle:Curso')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Curso/index.html.twig', array(
            'usuario' => $user,
            'cursos' => $cursos,
            'formCurso' => $form->createView()
        ));
        
    }
    
    public function formAction($id_curso){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $curso = $em->find('FaSiteBundle:Curso', $id_curso);
        
        if(is_null($curso)){
            $curso = new \Fa\SiteBundle\Entity\Curso();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\CursoType(), $curso);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Curso/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'curso' => $curso
                ));
    }
    
    public function excluirAction($id_curso){
        $curso = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $curso = $em->find('FaSiteBundle:Curso', $id_curso);
        
        //se nao existir, cria novo objeto
        if(!is_null($curso)){
            
            $infoCurso = $em->getRepository('FaSiteBundle:InfoCurso')
                    ->findOneBy(array('curso' => $curso));
            $descCurso = $em->getRepository('FaSiteBundle:DescricaoCurso')
                    ->findOneBy(array('curso' => $curso));
            $perfilCurso = $em->getRepository('FaSiteBundle:PerfilCurso')
                    ->findOneBy(array('curso' => $curso));
            $mercadoCurso = $em->getRepository('FaSiteBundle:MercadoCurso')
                    ->findOneBy(array('curso' => $curso));
            $ingressoCurso = $em->getRepository('FaSiteBundle:IngressoCurso')
                    ->findOneBy(array('curso' => $curso));
            
            if($descCurso != null){
                $em->remove($descCurso);
            }
            
            if($perfilCurso != null){
                $em->remove($perfilCurso);
            }
            
            if($mercadoCurso != null){
                $em->remove($mercadoCurso);
            }
            
            if($ingressoCurso != null){
                $em->remove($ingressoCurso);
            }
            
            if($infoCurso != null){
                $em->remove($infoCurso);
            }
            
            $em->flush();
            
            $em->remove($curso);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_cursos'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
