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
 * Description of Pagina
 *
 * @author Almir
 */

/**
 * Pagina
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\PaginaRepository")
 * @ORM\Table(name="pagina")
 * @ORM\HasLifecycleCallbacks()
 */
class Pagina {
    
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
     * @ORM\Column(name="conteudo", type="text")
     * @Assert\NotBlank()
     */
    private $conteudo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagem", type="string", length=100, nullable=true)
     */
    private $imagem;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagemTopo", type="string", length=100, nullable=true)
     */
    private $imagemTopo;
    
    /**
     * @var string
     * 
     * @Gedmo\Slug(fields={"titulo"})
     * @ORM\Column(name="slug", type="string", length=100, nullable=true)
     */
    private $slug;
    
    /**
     * @ORM\OneToOne(targetEntity="Template")
     * @ORM\JoinColumn(name="id_template", referencedColumnName="id")
     */
    private $template;
    
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
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $fileTopo;
    
    private $temp;
    
    private $tempTopo;
    
    ################## INICIO METODOS MANIPULACAO IMAGENS ###################
    
    public function getAbsolutePath()
    {
        return null === $this->imagem
            ? null
            : $this->getUploadRootDir().'/'.$this->imagem;
    }

    public function getWebPath()
    {
        return null === $this->imagem
            ? null
            : $this->getUploadDir().'/'.$this->imagem;
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
        return 'uploads/pagina';
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
        if (isset($this->imagem)) {
            // store the old name to delete after the update
            $this->temp = $this->imagem;
            $this->imagem = null;
        } else {
            $this->imagem = 'initial';
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
            $this->imagem = $filename.'.'.$this->getFile()->guessExtension();
        }
        
        if (null !== $this->getFileTopo()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->imagemTopo = $filename.'.'.$this->getFileTopo()->guessExtension();
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
        if (null === $this->getFile() && null === $this->getFileTopo()) {
            return;
        }
        
        if (null !== $this->getFile()){
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFile()->move($this->getUploadRootDir(), $this->imagem);

            // check if we have an old image
            if (isset($this->temp)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->temp);
                // clear the temp image path
                $this->temp = null;
            }
            $this->file = null;
        }
        
        if (null !== $this->getFileTopo()) {
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFileTopo()->move($this->getUploadRootDirTopo(), $this->imagemTopo);

            // check if we have an old image
            if (isset($this->tempTopo)) {
                // delete the old image
                unlink($this->getUploadRootDir().'/'.$this->tempTopo);
                // clear the temp image path
                $this->tempTopo = null;
            }
            $this->fileTopo = null;
        }
        
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
        
        if ($file = $this->getAbsolutePathTopo()) {
            unlink($file);
        }
        
    }
    
    ################## FIM METODOS MANIPULACAO IMAGENS ###################
    
    ################## INICIO METODOS MANIPULACAO IMAGENS TOPO ###################
    
    public function getAbsolutePathTopo()
    {
        return null === $this->imagemTopo
            ? null
            : $this->getUploadRootDirTopo().'/'.$this->imagemTopo;
    }

    public function getWebPathTopo()
    {
        return null === $this->imagemTopo
            ? null
            : $this->getUploadDirTopo().'/'.$this->imagemTopo;
    }

    protected function getUploadRootDirTopo()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirTopo();
    }

    protected function getUploadDirTopo()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/pagina/topo';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFileTopo(UploadedFile $file = null)
    {
        $this->fileTopo = $file;
        // check if we have an old image path
        if (isset($this->imagemTopo)) {
            // store the old name to delete after the update
            $this->tempTopo = $this->imagemTopo;
            $this->imagemTopo = null;
        } else {
            $this->imagemTopo = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileTopo()
    {
        return $this->fileTopo;
    }
    
    ################## FIM METODOS MANIPULACAO IMAGENS TOPO ###################
    
    public function __toString() {
        return $this->getTitulo();
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
     * Set titulo
     *
     * @param string $titulo
     * @return Pagina
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
     * Set conteudo
     *
     * @param string $conteudo
     * @return Pagina
     */
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;

        return $this;
    }

    /**
     * Get conteudo
     *
     * @return string 
     */
    public function getConteudo()
    {
        return $this->conteudo;
    }

    /**
     * Set imagem
     *
     * @param string $imagem
     * @return Pagina
     */
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get imagem
     *
     * @return string 
     */
    public function getImagem()
    {
        return $this->imagem;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Pagina
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
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     * @return Pagina
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
     * @return Pagina
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
     * Set template
     *
     * @param \Fa\SiteBundle\Entity\Template $template
     * @return Pagina
     */
    public function setTemplate(\Fa\SiteBundle\Entity\Template $template = null)
    {
        $this->template = $template;

        return $this;
    }

    /**
     * Get template
     *
     * @return \Fa\SiteBundle\Entity\Template 
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set imagemTopo
     *
     * @param string $imagemTopo
     * @return Pagina
     */
    public function setImagemTopo($imagemTopo)
    {
        $this->imagemTopo = $imagemTopo;

        return $this;
    }

    /**
     * Get imagemTopo
     *
     * @return string 
     */
    public function getImagemTopo()
    {
        return $this->imagemTopo;
    }
}
