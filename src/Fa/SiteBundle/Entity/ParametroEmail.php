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
 * Description of ParametroEmail
 *
 * @author Almir
 */

/**
 * ParametroEmail
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\ParametroEmailRepository")
 * @ORM\Table(name="parametro_email")
 * @ORM\HasLifecycleCallbacks()
 */
class ParametroEmail {
    
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
     * @ORM\Column(name="destinatario", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $destinatario;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="destinatario_ouvidoria", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $destinatarioOuvidoria;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="destinatario_docente", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $destinatarioDocente;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="destinatario_tecnico", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $destinatarioTecnico;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="destinatario_estagiario", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $destinatarioEstagiario;
    

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
     * Set destinatario
     *
     * @param string $destinatario
     * @return ParametroEmail
     */
    public function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;

        return $this;
    }

    /**
     * Get destinatario
     *
     * @return string 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }

    /**
     * Set destinatarioOuvidoria
     *
     * @param string $destinatarioOuvidoria
     * @return ParametroEmail
     */
    public function setDestinatarioOuvidoria($destinatarioOuvidoria)
    {
        $this->destinatarioOuvidoria = $destinatarioOuvidoria;

        return $this;
    }

    /**
     * Get destinatarioOuvidoria
     *
     * @return string 
     */
    public function getDestinatarioOuvidoria()
    {
        return $this->destinatarioOuvidoria;
    }

    /**
     * Set destinatarioDocente
     *
     * @param string $destinatarioDocente
     * @return ParametroEmail
     */
    public function setDestinatarioDocente($destinatarioDocente)
    {
        $this->destinatarioDocente = $destinatarioDocente;

        return $this;
    }

    /**
     * Get destinatarioDocente
     *
     * @return string 
     */
    public function getDestinatarioDocente()
    {
        return $this->destinatarioDocente;
    }

    /**
     * Set destinatarioTecnico
     *
     * @param string $destinatarioTecnico
     * @return ParametroEmail
     */
    public function setDestinatarioTecnico($destinatarioTecnico)
    {
        $this->destinatarioTecnico = $destinatarioTecnico;

        return $this;
    }

    /**
     * Get destinatarioTecnico
     *
     * @return string 
     */
    public function getDestinatarioTecnico()
    {
        return $this->destinatarioTecnico;
    }

    /**
     * Set destinatarioEstagiario
     *
     * @param string $destinatarioEstagiario
     * @return ParametroEmail
     */
    public function setDestinatarioEstagiario($destinatarioEstagiario)
    {
        $this->destinatarioEstagiario = $destinatarioEstagiario;

        return $this;
    }

    /**
     * Get destinatarioEstagiario
     *
     * @return string 
     */
    public function getDestinatarioEstagiario()
    {
        return $this->destinatarioEstagiario;
    }
}
