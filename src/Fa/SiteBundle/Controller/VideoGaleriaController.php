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
 * Description of VideoGaleriaController
 *
 * @author Almir
 */
class VideoGaleriaController extends Controller {
    
    public function cadastrarAction($id_video_galeria){
        $videoGaleria = null;
        $request = $this->getRequest();
        
        $user = $this->getUser();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $videoGaleria = $em->find('FaSiteBundle:VideoGaleria', $id_video_galeria);
        
        //se nao existir, cria novo objeto
        if(is_null($videoGaleria)){
            
            $videoGaleria = new \Fa\SiteBundle\Entity\VideoGaleria();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\VideoGaleriaType(), $videoGaleria);
        $form->bind($request);
        
        if($form->isValid()){
            
            $em->persist($videoGaleria);
            $em->flush();
            
            $ffmpeg = $this->get('dubture_ffmpeg.ffmpeg');

            // Open video
            $umVideo = $ffmpeg->open($this->get('kernel')->getRootDir().'/../web'."/uploads/video/galeria/".
                    $videoGaleria->getArquivo());

            $umVideo
              ->frame(TimeCode::fromSeconds(15))
              ->save($this->get('kernel')->getRootDir().'/../web'.'/uploads/video/galeria/frame/'.$videoGaleria->getId().'.png');
            
            return $this->redirect($this->generateUrl('fa_site_admin_videos_galeria'));
        }
        
        $videos = $em->getRepository('FaSiteBundle:VideoGaleria')
                ->findAll();
        
        return $this->render('FaSiteBundle:Admin:VideoGaleria/index.html.twig', array(
            'usuario' => $user,
            'videos' => $videos,
            'formVideoGaleria' => $form->createView()
        ));
        
    }
    
    public function formAction($id_video_galeria){
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $videoGaleria = $em->find('FaSiteBundle:VideoGaleria', $id_video_galeria);
        
        if(is_null($videoGaleria)){
            $videoGaleria = new \Fa\SiteBundle\Entity\VideoGaleria();
        }
        
        $form = $this->createForm(new \Fa\SiteBundle\Form\VideoGaleriaType(), $videoGaleria);
        
//        $form->bind($request);
        
        return $this->render('FaSiteBundle:Admin:VideoGaleria/form.html.twig',
                array(
                    'form' => $form->createView(),
                    'video' => $videoGaleria
                ));
    }
    
    public function excluirAction($id_video_galeria){
        $videoGaleria = null;
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        
        //verifica se ja existe registro
        $videoGaleria = $em->find('FaSiteBundle:VideoGaleria', $id_video_galeria);
        
        //se nao existir, cria novo objeto
        if(!is_null($videoGaleria)){
            $em->remove($videoGaleria);
            $em->flush();
            
            return $this->redirect($this->generateUrl('fa_site_admin_videos_galeria'));
            
        } else{
            return new Response('Registro não encontrado', 404);
        }
        
    }
    
}
