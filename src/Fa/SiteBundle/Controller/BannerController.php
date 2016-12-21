<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of BannerController
 *
 * @author Almir
 */
class BannerController extends Controller {
    
    public function cadastrarAction($id_banner){
        $banner = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $banner = $em->find('FaSiteBundle:Banner', $id_banner);
        
        //se nao existir, cria novo objeto
        if(is_null($banner)){
            $banner = new \Fa\SiteBundle\Entity\Banner();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\BannerType(), $banner);
        $form->bind($request);
        
        if($form->isValid()){
            
            //cadastra ou edita objeto
            
            $em->persist($banner);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_banners'));
        }
        
        $banners = $em->getRepository('FaSiteBundle:Banner')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Banner/index.html.twig', array(
            'usuario' => $user,
            'banners' => $banners,
            'formBanner' => $form->createView()
        ));
        
    }
    
    public function formAction($id_banner){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $banner = $em->find('FaSiteBundle:Banner', $id_banner);
        
        if(is_null($banner)){
            $banner = new \Fa\SiteBundle\Entity\Banner();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\BannerType(), $banner);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Banner/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'banner' => $banner
                ));
    }
    
    public function excluirAction($id_banner){
        $banner = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $banner = $em->find('FaSiteBundle:Banner', $id_banner);
        
        //se nao existir, cria novo objeto
        if(!is_null($banner)){
            $em->remove($banner);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_banners'));
            
        } else{
            return new \Symfony\Component\HttpFoundation\Response('Registro não encontrado', 404);
        }
        
    }
    
}
