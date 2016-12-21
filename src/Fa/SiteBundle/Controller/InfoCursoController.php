<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of InfoCursoController
 *
 * @author Almir
 */
class InfoCursoController extends Controller {
    
    public function cadastrarAction($id_curso){
        $infoCurso = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        $curso = $em->getRepository('FaSiteBundle:Curso')->findOneBy(array('id' => $id_curso));
        
        //verifica se ja existe registro
        $infoCurso = $em->getRepository('FaSiteBundle:InfoCurso')->findOneBy(array('curso' => $id_curso));
        
        //se nao existir, cria novo objeto
        if(is_null($infoCurso)){
            $infoCurso = new \Fa\SiteBundle\Entity\InfoCurso();
            $infoCurso->setCurso($curso);
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\InfoCursoType(), $infoCurso);
        $form->bind($request);
        
        if($form->isValid()){
            
            $dados = $request->request->get('info_curso');
            
            $descricao = $dados['descricao'];
            $ingresso = $dados['ingresso'];
            $mercado = $dados['mercado'];
            $perfil = $dados['perfil'];
//            $corpoDocente = $dados['corpoDocente'];
            
            $descricaoCurso = $em->getRepository('FaSiteBundle:DescricaoCurso')->findOneBy(array('curso' => $id_curso));
            $ingressoCurso = $em->getRepository('FaSiteBundle:IngressoCurso')->findOneBy(array('curso' => $id_curso));
            $mercadoCurso = $em->getRepository('FaSiteBundle:MercadoCurso')->findOneBy(array('curso' => $id_curso));
            $perfilCurso = $em->getRepository('FaSiteBundle:PerfilCurso')->findOneBy(array('curso' => $id_curso));
//            $corpoDocenteCurso = $em->getRepository('FaSiteBundle:CorpoDocenteCurso')->findOneBy(array('curso' => $id_curso));
            
            if($descricaoCurso == null){
                $descricaoCurso = new \Fa\SiteBundle\Entity\DescricaoCurso();
            }
            
            if($ingressoCurso == null){
                $ingressoCurso = new \Fa\SiteBundle\Entity\IngressoCurso();
            }
            
            if($mercadoCurso == null){
                $mercadoCurso = new \Fa\SiteBundle\Entity\MercadoCurso();
            }
            
            if($perfilCurso == null){
                $perfilCurso = new \Fa\SiteBundle\Entity\PerfilCurso();
            }
            
//            if($corpoDocenteCurso == null){
//                $corpoDocenteCurso = new \Fa\SiteBundle\Entity\CorpoDocenteCurso();
//            }
            
            // descricao
            $descricaoCurso->setDescricao($descricao);
            $descricaoCurso->setCurso($curso);
            $em->persist($descricaoCurso);
            
            $infoCurso->setDescricao($descricaoCurso);
            
            // ingresso
            $ingressoCurso->setIngresso($ingresso);
            $ingressoCurso->setCurso($curso);
            $em->persist($ingressoCurso);
            
            $infoCurso->setIngresso($ingressoCurso);
            
            // mercado
            $mercadoCurso->setMercado($mercado);
            $mercadoCurso->setCurso($curso);
            $em->persist($mercadoCurso);
            
            $infoCurso->setMercado($mercadoCurso);
            
            // perfil
            $perfilCurso->setPerfil($perfil);
            $perfilCurso->setCurso($curso);
            $em->persist($perfilCurso);
            
            $infoCurso->setPerfil($perfilCurso);
            
            // corpo docente
//            $corpoDocenteCurso->setCorpoDocente($corpoDocente);
//            $corpoDocenteCurso->setCurso($curso);
//            $em->persist($corpoDocenteCurso);
//            
//            $infoCurso->setCorpoDocente($corpoDocenteCurso);
            
            
            //dump($request->request->get('info_curso')['descricao']);
            
            //cadastra ou edita objeto
            
            $em->persist($infoCurso);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_cursos'));
            
        }
        
        $cursos = $em->getRepository('FaSiteBundle:Curso')->findAll();
        
        return $this->render('FaSiteBundle:Admin:Curso/index.html.twig', array(
                'usuario' => $user,
                'cursos' => $cursos,
                'formCurso' => $form->createView()
            ));
        
    }
    
    public function formAction($id_curso){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $infoCurso = $em->getRepository('FaSiteBundle:InfoCurso')->findOneBy(array('curso' => $id_curso));
        
        if(is_null($infoCurso)){
            $infoCurso = new \Fa\SiteBundle\Entity\InfoCurso();
            $curso = $em->getRepository('FaSiteBundle:Curso')->findOneBy(array('id' => $id_curso));
            
            $infoCurso->setCurso($curso);
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\InfoCursoType(), $infoCurso);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:InfoCurso/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'infoCurso' => $infoCurso
                ));
    }
    
}
