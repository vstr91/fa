<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of MenuController
 *
 * @author Almir
 */
class MenuController extends Controller {
    
    public function cadastrarAction($id_menu){
        $menu = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $menu = $em->find('FaSiteBundle:Menu', $id_menu);
        
        //se nao existir, cria novo objeto
        if(is_null($menu)){
            $menu = new \RF\SiteBundle\Entity\Menu();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\MenuType(), $menu);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($menu);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_menus'));
        }
        
        $menus = $em->getRepository('FaSiteBundle:Menu')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Menu/index.html.twig', array(
            'usuario' => $user,
            'menus' => $menus,
            'formMenu' => $form->createView()
        ));
        
    }
    
    public function formAction($id_menu){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $menu = $em->find('FaSiteBundle:Menu', $id_menu);
        
        if(is_null($menu)){
            $menu = new \Fa\SiteBundle\Entity\Menu();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\MenuType(), $menu);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Menu/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'menu' => $menu
                ));
    }
    
    public function excluirAction($id_menu){
        $menu = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $menu = $em->find('FaSiteBundle:Menu', $id_menu);
        
        //se nao existir, cria novo objeto
        if(!is_null($menu)){
            $em->remove($menu);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_menus'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
