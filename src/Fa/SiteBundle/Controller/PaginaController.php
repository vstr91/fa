<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this pagina file, choose Tools | Paginas
 * and open the pagina in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of PaginaController
 *
 * @author Almir
 */
class PaginaController extends Controller {
    
    public function cadastrarAction($id_pagina){
        $pagina = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $pagina = $em->find('FaSiteBundle:Pagina', $id_pagina);
        
        //se nao existir, cria novo objeto
        if(is_null($pagina)){
            $pagina = new \Fa\SiteBundle\Entity\Pagina();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\PaginaType(), $pagina);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($pagina);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_paginas'));
        }
        
        $paginas = $em->getRepository('FaSiteBundle:Pagina')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Pagina/index.html.twig', array(
            'usuario' => $user,
            'paginas' => $paginas,
            'formPagina' => $form->createView()
        ));
        
    }
    
    public function formAction($id_pagina){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $pagina = $em->find('FaSiteBundle:Pagina', $id_pagina);
        
        if(is_null($pagina)){
            $pagina = new \Fa\SiteBundle\Entity\Pagina();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\PaginaType(), $pagina);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Pagina/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'pagina' => $pagina
                ));
    }
    
    public function excluirAction($id_pagina){
        $pagina = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $pagina = $em->find('FaSiteBundle:Pagina', $id_pagina);
        
        //se nao existir, cria novo objeto
        if(!is_null($pagina)){
            $em->remove($pagina);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_paginas'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
