<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of Menu
 *
 * @author Almir
 */

/**
 * Evento
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\MenuRepository")
 * @ORM\Table(name="menu")
 * @ORM\HasLifecycleCallbacks()
 */
class Menu {
    
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
     * @ORM\Column(name="titulo", type="string", length=50)
     * @Assert\NotBlank()
     */
    private $titulo;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="link", type="string", length=150, nullable=true)
     */
    private $link;
    
    /**
     * @ORM\ManyToOne(targetEntity="Pagina")
     * @ORM\JoinColumn(name="id_pagina", referencedColumnName="id")
     */
    private $pagina;
    
    /**
     * @ORM\ManyToOne(targetEntity="TipoMenu")
     * @ORM\JoinColumn(name="id_tipo_menu", referencedColumnName="id")
     */
    private $tipoMenu;
    
    /**
     * @ORM\ManyToOne(targetEntity="Menu")
     * @ORM\JoinColumn(name="id_menu", referencedColumnName="id")
     */
    private $menuPai;
    

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
     * Set titulo
     *
     * @param string $titulo
     * @return Menu
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Menu
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set pagina
     *
     * @param \RF\SiteBundle\Entity\Pagina $pagina
     * @return Menu
     */
    public function setPagina(\RF\SiteBundle\Entity\Pagina $pagina = null)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return \RF\SiteBundle\Entity\Pagina 
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set tipoMenu
     *
     * @param \RF\SiteBundle\Entity\TipoMenu $tipoMenu
     * @return Menu
     */
    public function setTipoMenu(\RF\SiteBundle\Entity\TipoMenu $tipoMenu = null)
    {
        $this->tipoMenu = $tipoMenu;

        return $this;
    }

    /**
     * Get tipoMenu
     *
     * @return \RF\SiteBundle\Entity\TipoMenu 
     */
    public function getTipoMenu()
    {
        return $this->tipoMenu;
    }
    
    /**
     * @Assert\IsTrue(message = "Informe a página interna no campo página ou um link externo no campo link")
     */
    public function isDestinoPreenchido()
    {
        return $this->getPagina() != null || $this->getLink() != null;
    }
    

    /**
     * Set menuPai
     *
     * @param \Fa\SiteBundle\Entity\Menu $menuPai
     * @return Menu
     */
    public function setMenuPai(\Fa\SiteBundle\Entity\Menu $menuPai = null)
    {
        $this->menuPai = $menuPai;

        return $this;
    }

    /**
     * Get menuPai
     *
     * @return \Fa\SiteBundle\Entity\Menu 
     */
    public function getMenuPai()
    {
        return $this->menuPai;
    }
}
