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
 * Description of IngressoCurso
 *
 * @author Almir
 */

/**
 * IngressoCurso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\IngressoCursoRepository")
 * @ORM\Table(name="ingresso_curso")
 * @ORM\HasLifecycleCallbacks()
 */
class IngressoCurso {
    
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
     * @ORM\Column(name="ingresso", type="text")
     * @Assert\NotBlank()
     */
    private $ingresso;
    
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
     * Set ingresso
     *
     * @param string $ingresso
     * @return IngressoCurso
     */
    public function setIngresso($ingresso)
    {
        $this->ingresso = $ingresso;

        return $this;
    }

    /**
     * Get ingresso
     *
     * @return string 
     */
    public function getIngresso()
    {
        return $this->ingresso;
    }

    /**
     * Set curso
     *
     * @param \Fa\SiteBundle\Entity\Curso $curso
     * @return IngressoCurso
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
        return $this->getIngresso();
    }
    
}
