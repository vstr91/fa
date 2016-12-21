<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use FFMpeg\Coordinate\TimeCode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of VideoController
 *
 * @author Almir
 */
class VideoController extends Controller {
    
    public function cadastrarAction($id_video){
        $video = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $video = $em->find('FaSiteBundle:Video', $id_video);
        
        //se nao existir, cria novo objeto
        if(is_null($video)){
            
            $video = new \Fa\SiteBundle\Entity\Video();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\VideoType(), $video);
        $form->bind($request);
        
        if($form->isValid()){
            
            $em->persist($video);
            $em->flush();
            
            $ffmpeg = $this->get('dubture_ffmpeg.ffmpeg');

            // Open video
            $umVideo = $ffmpeg->open($this->get('kernel')->getRootDir().'/../web'."/uploads/video/".$video->getArquivo());

            $umVideo
              ->frame(TimeCode::fromSeconds(15))
              ->save($this->get('kernel')->getRootDir().'/../web'.'/uploads/video/frame/frame.png');
            
            return $this->redirect($this->generateUrl('fa_site_admin_videos'));
        }
        
        $videos = $em->getRepository('FaSiteBundle:Video')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:Video/index.html.twig', array(
            'usuario' => $user,
            'videos' => $videos,
            'formVideo' => $form->createView()
        ));
        
    }
    
    public function formAction($id_video){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $video = $em->find('FaSiteBundle:Video', $id_video);
        
        if(is_null($video)){
            $video = new \Fa\SiteBundle\Entity\Video();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\VideoType(), $video);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:Video/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'video' => $video
                ));
    }
    
    public function excluirAction($id_video){
        $video = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $video = $em->find('FaSiteBundle:Video', $id_video);
        
        //se nao existir, cria novo objeto
        if(!is_null($video)){
            $em->remove($video);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_videos'));
            
        } else{
            return new Response('Registro não encontrado', 404);
        }
        
    }
    
}
