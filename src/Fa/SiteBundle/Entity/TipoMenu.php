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
 * Description of TipoMenu
 *
 * @author Almir
 */

/**
 * Evento
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\TipoMenuRepository")
 * @ORM\Table(name="tipo_menu")
 * @ORM\HasLifecycleCallbacks()
 */
class TipoMenu {
    
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
     * @return TipoMenu
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
    
    public function __toString() {
        return $this->getNome();
    }
}
