<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of PerfilCurso
 *
 * @author Almir
 */

/**
 * PerfilCurso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\PerfilCursoRepository")
 * @ORM\Table(name="perfil_curso")
 * @ORM\HasLifecycleCallbacks()
 */
class PerfilCurso {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="perfil", type="text")
     * @Assert\NotBlank()
     */
    private $perfil;
    
    /**
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumn(name="id_curso", referencedColumnName="id")
     */
    private $curso;
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set perfil
     *
     * @param string $perfil
     * @return PerfilCurso
     */
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;

        return $this;
    }

    /**
     * Get perfil
     *
     * @return string 
     */
    public function getPerfil()
    {
        return $this->perfil;
    }

    /**
     * Set curso
     *
     * @param \Fa\SiteBundle\Entity\Curso $curso
     * @return PerfilCurso
     */
    public function setCurso(\Fa\SiteBundle\Entity\Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get curso
     *
     * @return \Fa\SiteBundle\Entity\Curso 
     */
    public function getCurso()
    {
        return $this->curso;
    }
    
    public function __toString() {
        return $this->getPerfil();
    }
    
}
