<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Fa\SiteBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Description of Revista
 *
 * @author Almir
 */

/**
 * Revista
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\RevistaRepository")
 * @ORM\Table(name="revista")
 * @ORM\HasLifecycleCallbacks()
 */
class Revista {
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
     * @ORM\Column(name="titulo", type="string", length=100)
     * @Assert\NotBlank()
     */
    private $titulo;
    
    /**
     * @var string
     * 
     * @Gedmo\Slug(fields={"titulo"})
     * @ORM\Column(name="slug", type="string", length=100, nullable=true)
     */
    private $slug;
    
    /**
     * @var string
     *
     * @ORM\Column(name="arquivo", type="string", length=100, nullable=true)
     */
    private $arquivo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="capa", type="string", length=100, nullable=true)
     */
    private $capa;
    
    /**
     * @Assert\File(maxSize = "6000000",
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Por favor indique um arquivo PDF válido")
     */
    private $file;
    
    /**
     * @Assert\File(maxSize = "6000000")
     */
    private $fileCapa;
    
    private $temp;
    
    private $tempCapa;
    
    ################## INICIO METODOS MANIPULACAO ARQUIVO ###################
    
    public function getAbsolutePath()
    {
        return null === $this->arquivo
            ? null
            : $this->getUploadRootDir().'/'.$this->arquivo;
    }

    public function getWebPath()
    {
        return null === $this->arquivo
            ? null
            : $this->getUploadDir().'/'.$this->arquivo;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/revista';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->arquivo)) {
            // store the old name to delete after the update
            $this->temp = $this->arquivo;
            $this->arquivo = null;
        } else {
            $this->arquivo = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->arquivo = $filename.'.'.$this->getFile()->guessExtension();
        }
        
        if (null !== $this->getFileCapa()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->capa = $filename.'.'.$this->getFileCapa()->guessExtension();
        }
        
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile() && null === $this->getFileCapa()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->arquivo);
        
        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFileCapa()->move($this->getUploadRootDirCapa(), $this->capa);
        
        // check if we have an old image
        if (isset($this->tempCapa)) {
            // delete the old image
            unlink($this->getUploadRootDirCapa().'/'.$this->tempCapa);
            // clear the temp image path
            $this->tempCapa = null;
        }
        $this->fileCapa = null;
        
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
        
        if ($fileCapa = $this->getAbsolutePathCapa()) {
            unlink($fileCapa);
        }
    }
    
    ################## FIM METODOS MANIPULACAO ARQUIVO ###################
    
    
    ################## INICIO METODOS MANIPULACAO CAPA ###################
    
    public function getAbsolutePathCapa()
    {
        return null === $this->capa
            ? null
            : $this->getUploadRootDirCapa().'/'.$this->capa;
    }

    public function getWebPathCapa()
    {
        return null === $this->capa
            ? null
            : $this->getUploadDirCapa().'/'.$this->capa;
    }

    protected function getUploadRootDirCapa()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirCapa();
    }

    protected function getUploadDirCapa()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/revista/capa';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFileCapa(UploadedFile $fileCapa = null)
    {
        $this->fileCapa = $fileCapa;
        // check if we have an old image path
        if (isset($this->capa)) {
            // store the old name to delete after the update
            $this->tempCapa = $this->capa;
            $this->capa = null;
        } else {
            $this->capa = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileCapa()
    {
        return $this->fileCapa;
    }
    
    ################## FIM METODOS MANIPULACAO ARQUIVO ###################
    

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
     * @return Revista
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
     * Set slug
     *
     * @param string $slug
     * @return Revista
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
     * Set arquivo
     *
     * @param string $arquivo
     * @return Revista
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    /**
     * Get arquivo
     *
     * @return string 
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }

    /**
     * Set capa
     *
     * @param string $capa
     * @return Revista
     */
    public function setCapa($capa)
    {
        $this->capa = $capa;

        return $this;
    }

    /**
     * Get capa
     *
     * @return string 
     */
    public function getCapa()
    {
        return $this->capa;
    }
}
