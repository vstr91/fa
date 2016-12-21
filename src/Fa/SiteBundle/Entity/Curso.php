<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Entity;

/**
 * Description of Curso
 *
 * @author Almir
 */

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Curso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\CursoRepository")
 * @ORM\Table(name="curso")
 * @ORM\HasLifecycleCallbacks()
 */
class Curso {
    
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
     * @ORM\Column(name="nome", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $nome;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoCurso")
     * @ORM\JoinColumn(name="id_tipo_curso", referencedColumnName="id")
     */
    private $tipoCurso;
    
    /**
     * @ORM\ManyToOne(targetEntity="PeriodoCurso")
     * @ORM\JoinColumn(name="id_periodo_curso", referencedColumnName="id")
     */
    private $periodoCurso;
    
    /**
     * @var string
     * 
     * @Gedmo\Slug(fields={"nome"})
     * @ORM\Column(name="slug", type="string", length=50, nullable=true)
     */
    private $slug;
    
    /**
     *
     * @ORM\Column(name="dataCadastro", type="datetime")
     */
    private $dataCadastro;
    
    /**
     *
     * @ORM\Column(name="ultimaAlteracao", type="datetime")
     */
    private $ultimaAlteracao;
    
    /**
     * @ORM\PrePersist()
     */
    public function prePersist()
    {
        $this->setDataCadastro(new \DateTime());
        $this->setUltimaAlteracao(new \DateTime());
    }
    
    /**
     * @ORM\PreUpdate()
     */
    public function preUpdate()
    {
        $this->setUltimaAlteracao(new \DateTime());
    }
    
    public function __toString() {
        return $this->getNome();
    }
    

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
     * Set nome
     *
     * @param string $nome
     *
     * @return Curso
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     *
     * @return Curso
     */
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    /**
     * Get dataCadastro
     *
     * @return \DateTime
     */
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    /**
     * Set ultimaAlteracao
     *
     * @param \DateTime $ultimaAlteracao
     *
     * @return Curso
     */
    public function setUltimaAlteracao($ultimaAlteracao)
    {
        $this->ultimaAlteracao = $ultimaAlteracao;

        return $this;
    }

    /**
     * Get ultimaAlteracao
     *
     * @return \DateTime
     */
    public function getUltimaAlteracao()
    {
        return $this->ultimaAlteracao;
    }

    /**
     * Set tipoCurso
     *
     * @param \FaSiteBundle\Entity\TipoCurso $tipoCurso
     *
     * @return Curso
     */
    public function setTipoCurso(TipoCurso $tipoCurso = null)
    {
        $this->tipoCurso = $tipoCurso;

        return $this;
    }

    /**
     * Get tipoCurso
     *
     * @return TipoCurso
     */
    public function getTipoCurso()
    {
        return $this->tipoCurso;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Curso
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set periodoCurso
     *
     * @param \Fa\SiteBundle\Entity\PeriodoCurso $periodoCurso
     * @return Curso
     */
    public function setPeriodoCurso(\Fa\SiteBundle\Entity\PeriodoCurso $periodoCurso = null)
    {
        $this->periodoCurso = $periodoCurso;

        return $this;
    }

    /**
     * Get periodoCurso
     *
     * @return \Fa\SiteBundle\Entity\PeriodoCurso 
     */
    public function getPeriodoCurso()
    {
        return $this->periodoCurso;
    }
}
