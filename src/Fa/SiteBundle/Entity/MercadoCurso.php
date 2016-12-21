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
 * Description of MercadoCurso
 *
 * @author Almir
 */

/**
 * MercadoCurso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\MercadoCursoRepository")
 * @ORM\Table(name="mercado_curso")
 * @ORM\HasLifecycleCallbacks()
 */
class MercadoCurso {
    
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
     * @ORM\Column(name="mercado", type="text")
     * @Assert\NotBlank()
     */
    private $mercado;
    
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
     * Set mercado
     *
     * @param string $mercado
     * @return MercadoCurso
     */
    public function setMercado($mercado)
    {
        $this->mercado = $mercado;

        return $this;
    }

    /**
     * Get mercado
     *
     * @return string 
     */
    public function getMercado()
    {
        return $this->mercado;
    }

    /**
     * Set curso
     *
     * @param \Fa\SiteBundle\Entity\Curso $curso
     * @return MercadoCurso
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
        return $this->getMercado();
    }
    
}
