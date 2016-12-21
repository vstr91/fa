<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of Submenu
 *
 * @author Almir
 */
class SubmenuController extends Controller {
    
    public function instituicaoAction()
    {
        return $this->render('FaSiteBundle:Submenu:instituicao.html.twig');
    }
    
    public function cursosAction()
    {
        return $this->render('FaSiteBundle:Submenu:cursos.html.twig');
    }
    
    public function noticiasAction()
    {
        return $this->render('FaSiteBundle:Submenu:noticias.html.twig');
    }
    
    public function contatoAction()
    {
        return $this->render('FaSiteBundle:Submenu:contato.html.twig');
    }
    
    public function quemSomosAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:quem-somos.html.twig');
    }
    
    public function extensaoAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:extensao.html.twig');
    }
    
    public function pesquisaAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:pesquisa.html.twig');
    }
    
    public function localizacaoAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:localizacao.html.twig');
    }
    
    public function graduacaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $cursos = $em->getRepository('FaSiteBundle:Curso')->listarTodosVinculados(null, 1);
                //->findBy(array('tipoCurso' => 1), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:SubmenuSecundario:graduacao.html.twig', array(
            'cursos' => $cursos
        ));
    }
    
    public function posGraduacaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $cursos = $em->getRepository('FaSiteBundle:Curso')->listarTodosVinculados(null, 2);
                //->findBy(array('tipoCurso' => 2), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:SubmenuSecundario:pos-graduacao.html.twig', array(
            'cursos' => $cursos
        ));
    }
    
    public function noticiasSubAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:noticias.html.twig');
    }
    
    public function eventosAction()
    {
        return $this->render('FaSiteBundle:SubmenuSecundario:eventos.html.twig');
    }
    
    public function instituicaoDestaqueAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $destaque = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findOneBy(array('menu' => 'instituicao'));
        
        return $this->render('FaSiteBundle:SubmenuSecundario:instituicaoDestaque.html.twig', array(
            'destaque' => $destaque
        ));
    }
    
    public function noticiasDestaqueAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $noticias = $em->getRepository('FaSiteBundle:Noticia')
                ->listarTodos(4);
        
        return $this->render('FaSiteBundle:SubmenuSecundario:noticiasDestaque.html.twig', array(
            'noticias' => $noticias
        ));
    }
    
    public function contatoDestaqueAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $destaque = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findOneBy(array('menu' => 'contato'));
        
        return $this->render('FaSiteBundle:SubmenuSecundario:instituicaoDestaque.html.twig', array(
            'destaque' => $destaque
        ));
    }
    
    public function videosAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $videosGaleria = $em->getRepository('FaSiteBundle:VideoGaleria')
                ->listarTodos(4);
        
        return $this->render('FaSiteBundle:SubmenuSecundario:videos.html.twig', array(
            'videosGaleria' => $videosGaleria
        ));
    }
    
}
