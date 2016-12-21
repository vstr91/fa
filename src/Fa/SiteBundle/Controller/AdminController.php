<?php

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {

    public function indexAction() {

        $user = $this->getUser();

        return $this->render('FaSiteBundle:Admin:index.html.twig', array(
                    'usuario' => $user
        ));
    }

    public function indexTipoCursoAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $tipoCursoType = new \Fa\SiteBundle\Form\TipoCursoType();
        $formTipoCurso = $this->createForm($tipoCursoType);

        $tiposCurso = $em->getRepository('FaSiteBundle:TipoCurso')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:TipoCurso/index.html.twig', array(
                    'usuario' => $user,
                    'tiposCurso' => $tiposCurso,
                    'formTipoCurso' => $formTipoCurso->createView()
        ));
    }

    public function indexCursoAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $cursoType = new \Fa\SiteBundle\Form\CursoType();
        $formCurso = $this->createForm($cursoType);

        $cursos = $em->getRepository('FaSiteBundle:Curso')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Curso/index.html.twig', array(
                    'usuario' => $user,
                    'cursos' => $cursos,
                    'formCurso' => $formCurso->createView()
        ));
    }

    public function indexNoticiaAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $noticiaType = new \Fa\SiteBundle\Form\NoticiaType();
        $formNoticia = $this->createForm($noticiaType);

        $noticias = $em->getRepository('FaSiteBundle:Noticia')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Noticia/index.html.twig', array(
                    'usuario' => $user,
                    'noticias' => $noticias,
                    'formNoticia' => $formNoticia->createView()
        ));
    }

    public function indexEventoAction() {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $eventoType = new \Fa\SiteBundle\Form\EventoType();
        $formEvento = $this->createForm($eventoType);

        $eventos = $em->getRepository('FaSiteBundle:Evento')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Evento/index.html.twig', array(
                    'usuario' => $user,
                    'eventos' => $eventos,
                    'formEvento' => $formEvento->createView()
        ));
    }

    public function indexBannerAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $bannerType = new \Fa\SiteBundle\Form\BannerType();
        $formBanner = $this->createForm($bannerType);

        $banners = $em->getRepository('FaSiteBundle:Banner')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Banner/index.html.twig', array(
                    'usuario' => $user,
                    'banners' => $banners,
                    'formBanner' => $formBanner->createView()
        ));
    }
    
    public function indexParametroEmailAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        
        $param = $em->getRepository('FaSiteBundle:ParametroEmail')
                ->findOneBy(array('id' => 1));

        $paramType = new \Fa\SiteBundle\Form\ParametroEmailType();
        $formParam = $this->createForm($paramType, $param);

        return $this->render('FaSiteBundle:Admin:ParametroEmail/form.html.twig', array(
                    'usuario' => $user,
                    'parametros' => $param,
                    'form' => $formParam->createView()
        ));
    }
    
    public function indexDestaqueMenuAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $destaqueMenuType = new \Fa\SiteBundle\Form\DestaqueMenuType();
        $formDestaqueMenu = $this->createForm($destaqueMenuType);

        $destaquesMenu = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:DestaqueMenu/index.html.twig', array(
                    'usuario' => $user,
                    'destaques' => $destaquesMenu,
                    'formDestaqueMenu' => $formDestaqueMenu->createView()
        ));
    }
    
    public function indexRevistaAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $revistaType = new \Fa\SiteBundle\Form\RevistaType();
        $formRevista = $this->createForm($revistaType);

        $revistas = $em->getRepository('FaSiteBundle:Revista')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Revista/index.html.twig', array(
                    'usuario' => $user,
                    'revistas' => $revistas,
                    'formRevista' => $formRevista->createView()
        ));
    }
    
    public function indexVideoAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $videoType = new \Fa\SiteBundle\Form\VideoType();
        $formVideo = $this->createForm($videoType);

        $videos = $em->getRepository('FaSiteBundle:Video')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Video/index.html.twig', array(
                    'usuario' => $user,
                    'videos' => $videos,
                    'formVideo' => $formVideo->createView()
        ));
    }
    
    public function indexTemplateAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $templateType = new \Fa\SiteBundle\Form\TemplateType();
        $formTemplate = $this->createForm($templateType);

        $templates = $em->getRepository('FaSiteBundle:Template')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:Template/index.html.twig', array(
                    'usuario' => $user,
                    'templates' => $templates,
                    'formTemplate' => $formTemplate->createView()
        ));
    }
    
    public function indexVideoGaleriaAction() {

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $videoGaleriaType = new \Fa\SiteBundle\Form\VideoGaleriaType();
        $formVideo = $this->createForm($videoGaleriaType);

        $videos = $em->getRepository('FaSiteBundle:VideoGaleria')
                ->findAll();

        return $this->render('FaSiteBundle:Admin:VideoGaleria/index.html.twig', array(
                    'usuario' => $user,
                    'videos' => $videos,
                    'formVideo' => $formVideo->createView()
        ));
    }

}
