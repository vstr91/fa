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
class ComponentController extends Controller {
    
    public function selectCursosAction($id_tipo_curso)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $cursos = $em->getRepository('FaSiteBundle:Curso')
                ->findBy(array('tipoCurso' => $id_tipo_curso));
        
        return $this->render('FaSiteBundle:Component:select-cursos.html.twig', array(
            'cursos' => $cursos
        ));
    }
    
}
