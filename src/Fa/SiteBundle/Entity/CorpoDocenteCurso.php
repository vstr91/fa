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

/**
 * Description of CorpoDocenteCurso
 *
 * @author Almir
 */

/**
 * CorpoDocenteCurso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\CorpoDocenteCursoRepository")
 * @ORM\Table(name="corpo_docente_curso")
 * @ORM\HasLifecycleCallbacks()
 */
class CorpoDocenteCurso {
    
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
     * @ORM\Column(name="arquivo", type="string", length=100, nullable=true)
     */
    private $arquivo;
    
    /**
     * @Assert\File(maxSize="6000000", mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Por favor indique um arquivo PDF válido")
     */
    private $file;
    
    private $temp;
    
    /**
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumn(name="id_curso", referencedColumnName="id")
     */
    private $curso;
    
    
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
        return 'uploads/docentes';
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
        
        if($this->getDataCadastro() == null){
            $this->setDataCadastro(new \DateTime());
        }
        
        $this->setUltimaAlteracao(new \DateTime());
        
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        
        if (null === $this->getFile()) {
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
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    
    ################## FIM METODOS MANIPULACAO IMAGENS ###################
    

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
     * Set corpoDocente
     *
     * @param string $corpoDocente
     * @return CorpoDocenteCurso
     */
    public function setCorpoDocente($corpoDocente)
    {
        $this->corpoDocente = $corpoDocente;

        return $this;
    }

    /**
     * Get corpoDocente
     *
     * @return string 
     */
    public function getCorpoDocente()
    {
        return $this->corpoDocente;
    }

    /**
     * Set curso
     *
     * @param \Fa\SiteBundle\Entity\Curso $curso
     * @return CorpoDocenteCurso
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
    

    /**
     * Set arquivo
     *
     * @param string $arquivo
     * @return CorpoDocenteCurso
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
}
