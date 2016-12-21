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
 * Description of InfoCurso
 *
 * @author Almir
 */

/**
 * InfoCurso
 *
 * @ORM\Entity(repositoryClass="Fa\SiteBundle\Entity\Repository\InfoCursoRepository")
 * @ORM\Table(name="info_curso")
 * @ORM\HasLifecycleCallbacks()
 */
class InfoCurso {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\OneToOne(targetEntity="DescricaoCurso")
     * @ORM\JoinColumn(name="id_descricao", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $descricao;
    
    /**
     * @ORM\OneToOne(targetEntity="PerfilCurso")
     * @ORM\JoinColumn(name="id_perfil", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $perfil;
    
    /**
     * @ORM\OneToOne(targetEntity="MercadoCurso")
     * @ORM\JoinColumn(name="id_mercado", referencedColumnName="id", nullable=true, onDelete="SET NULL", nullable=true, onDelete="SET NULL")
     */
    private $mercado;
    
    /**
     * @ORM\OneToOne(targetEntity="IngressoCurso")
     * @ORM\JoinColumn(name="id_ingresso", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     */
    private $ingresso;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="ato", type="text")
     * @Assert\NotBlank()
     */
    private $ato;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="contato", type="text")
     * @Assert\NotBlank()
     */
    private $contato;
    
    /**
     * @var string
     *
     * @ORM\Column(name="arquivoDocentes", type="string", length=100, nullable=true)
     */
    private $arquivoDocentes;
    
    /**
     * @Assert\File(maxSize="9000000", mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Por favor indique um arquivo PDF válido")
     */
    private $fileDocentes;
    
    private $tempDocentes;
    
    /**
     * @var string
     *
     * @ORM\Column(name="arquivo_matriz", type="string", length=100, nullable=true)
     */
    private $arquivoMatriz;
    
    /**
     * @Assert\File(maxSize="9000000", mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Por favor indique um arquivo PDF válido")
     */
    private $fileMatriz;
    
    private $tempMatriz;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="resultadoMec", type="text")
     * @Assert\NotBlank()
     */
    private $resultadoMec;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="mensalidades", type="text")
     * @Assert\NotBlank()
     */
    private $mensalidades;
    
    /**
     * @var string
     *
     * @ORM\Column(name="arquivoConvenios", type="string", length=100, nullable=true)
     */
    private $arquivoConvenios;
    
    /**
     * @Assert\File(maxSize="9000000", mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Por favor indique um arquivo PDF válido")
     */
    private $fileConvenios;
    
    private $tempConvenios;
    
    /**
     * @var int
     * 
     * @ORM\Column(name="duracao", type="integer")
     * @Assert\NotBlank()
     */
    private $duracao;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="mensalidadeMatutino", type="float", nullable=true)
     */
    private $mensalidadeMatutino;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="mensalidadeNoturno", type="float", nullable=true)
     */
    private $mensalidadeNoturno;
    
    /**
     * @var float
     * 
     * @ORM\Column(name="mensalidadeIntegral", type="float", nullable=true)
     */
    private $mensalidadeIntegral;
    
    /**
     * @var string
     *
     * @ORM\Column(name="imagem", type="string", length=50)
     */
    private $imagem;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    private $temp;
    
    /**
     * @ORM\ManyToOne(targetEntity="Curso")
     * @ORM\JoinColumn(name="id_curso", referencedColumnName="id")
     */
    private $curso;
    
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
        return 'uploads/cursos/banner';
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
        
        if (null !== $this->getFileMatriz()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->arquivoMatriz = $filename.'.'.$this->getFileMatriz()->guessExtension();
        }
        
        if (null !== $this->getFileConvenios()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->arquivoConvenios = $filename.'.'.$this->getFileConvenios()->guessExtension();
        }
        
        if (null !== $this->getFileDocentes()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->arquivoDocentes = $filename.'.'.$this->getFileDocentes()->guessExtension();
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
        if (null === $this->getFile() && null === $this->getFileMatriz() && 
                null === $this->getFileConvenios() && null === $this->getFileDocentes()) {
            return;
        }

        if($this->getFile() != null){
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
        
        if($this->getFileMatriz() != null){
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFileMatriz()->move($this->getUploadRootDirMatriz(), $this->arquivoMatriz);

            // check if we have an old image
            if (isset($this->tempMatriz)) {
                // delete the old image
                unlink($this->getUploadRootDirMatriz().'/'.$this->tempMatriz);
                // clear the temp image path
                $this->tempMatriz = null;
            }
            $this->fileMatriz = null;
        }
        
        if($this->getFileConvenios() != null){
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFileConvenios()->move($this->getUploadRootDirConvenios(), $this->arquivoConvenios);

            // check if we have an old image
            if (isset($this->tempConvenios)) {
                // delete the old image
                unlink($this->getUploadRootDirConvenios().'/'.$this->tempConvenios);
                // clear the temp image path
                $this->tempConvenios = null;
            }
            $this->fileConvenios = null;
        }
        
        if($this->getFileDocentes() != null){
            // if there is an error when moving the file, an exception will
            // be automatically thrown by move(). This will properly prevent
            // the entity from being persisted to the database on error
            $this->getFileDocentes()->move($this->getUploadRootDirDocentes(), $this->arquivoDocentes);

            // check if we have an old image
            if (isset($this->tempDocentes)) {
                // delete the old image
                unlink($this->getUploadRootDirDocentes().'/'.$this->tempDocentes);
                // clear the temp image path
                $this->tempDocentes = null;
            }
            $this->fileDocentes = null;
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
        
        if ($fileMatriz = $this->getAbsolutePathMatriz()) {
            unlink($fileMatriz);
        }
        
        if ($fileConvenios = $this->getAbsolutePathConvenios()) {
            unlink($fileConvenios);
        }
        
        if ($fileDocentes = $this->getAbsolutePathDocentes()) {
            unlink($fileDocentes);
        }
        
    }
    
    ################## FIM METODOS MANIPULACAO IMAGENS ###################
    
    ################## INICIO METODOS MANIPULACAO MATRIZ ###################
    
    public function getAbsolutePathMatriz()
    {
        return null === $this->arquivoMatriz
            ? null
            : $this->getUploadRootDirMatriz().'/'.$this->arquivoMatriz;
    }

    public function getWebPathMatriz()
    {
        return null === $this->arquivoMatriz
            ? null
            : $this->getUploadDirMatriz().'/'.$this->arquivoMatriz;
    }

    protected function getUploadRootDirMatriz()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirMatriz();
    }

    protected function getUploadDirMatriz()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/matriz';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFileMatriz(UploadedFile $file = null)
    {
        $this->fileMatriz = $file;
        // check if we have an old image path
        if (isset($this->arquivoMatriz)) {
            // store the old name to delete after the update
            $this->tempMatriz = $this->arquivoMatriz;
            $this->arquivoMatriz = null;
        } else {
            $this->arquivoMatriz = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileMatriz()
    {
        return $this->fileMatriz;
    } 
    
    ################## FIM METODOS MANIPULACAO MATRIZ ###################
    
    ################## INICIO METODOS MANIPULACAO CONVENIOS ###################
    
    public function getAbsolutePathConvenios()
    {
        return null === $this->arquivoConvenios
            ? null
            : $this->getUploadRootDirConvenios().'/'.$this->arquivoConvenios;
    }

    public function getWebPathConvenios()
    {
        return null === $this->arquivoConvenios
            ? null
            : $this->getUploadDirConvenios().'/'.$this->arquivoConvenios;
    }

    protected function getUploadRootDirConvenios()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirConvenios();
    }

    protected function getUploadDirConvenios()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/convenios';
    }
    
    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFileConvenios(UploadedFile $file = null)
    {
        $this->fileConvenios = $file;
        // check if we have an old image path
        if (isset($this->arquivoConvenios)) {
            // store the old name to delete after the update
            $this->tempConvenios = $this->arquivoConvenios;
            $this->arquivoConvenios = null;
        } else {
            $this->arquivoConvenios = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileConvenios()
    {
        return $this->fileConvenios;
    } 
    
    ################## FIM METODOS MANIPULACAO CONVENIOS ###################
    
    ################## INICIO METODOS MANIPULACAO DOCENTES ###################
    
    public function getAbsolutePathDocentes()
    {
        return null === $this->arquivoDocentes
            ? null
            : $this->getUploadRootDirDocentes().'/'.$this->arquivoDocentes;
    }

    public function getWebPathDocentes()
    {
        return null === $this->arquivoDocentes
            ? null
            : $this->getUploadDirDocentes().'/'.$this->arquivoDocentes;
    }

    protected function getUploadRootDirDocentes()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDirDocentes();
    }

    protected function getUploadDirDocentes()
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
    public function setFileDocentes(UploadedFile $file = null)
    {
        $this->fileDocentes = $file;
        // check if we have an old image path
        if (isset($this->arquivoDocentes)) {
            // store the old name to delete after the update
            $this->tempDocentes = $this->arquivoDocentes;
            $this->arquivoDocentes = null;
        } else {
            $this->arquivoDocentes = 'initial';
        }
    }
    
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileDocentes()
    {
        return $this->fileDocentes;
    } 
    
    ################## FIM METODOS MANIPULACAO DOCENTES ###################

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
     * Set descricao
     *
     * @param string $descricao
     * @return InfoCurso
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set perfil
     *
     * @param string $perfil
     * @return InfoCurso
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
     * Set mercado
     *
     * @param string $mercado
     * @return InfoCurso
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
     * Set ingresso
     *
     * @param string $ingresso
     * @return InfoCurso
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
     * Set ato
     *
     * @param string $ato
     * @return InfoCurso
     */
    public function setAto($ato)
    {
        $this->ato = $ato;

        return $this;
    }

    /**
     * Get ato
     *
     * @return string 
     */
    public function getAto()
    {
        return $this->ato;
    }

    /**
     * Set contato
     *
     * @param string $contato
     * @return InfoCurso
     */
    public function setContato($contato)
    {
        $this->contato = $contato;

        return $this;
    }

    /**
     * Get contato
     *
     * @return string 
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set resultadoMec
     *
     * @param string $resultadoMec
     * @return InfoCurso
     */
    public function setResultadoMec($resultadoMec)
    {
        $this->resultadoMec = $resultadoMec;

        return $this;
    }

    /**
     * Get resultadoMec
     *
     * @return string 
     */
    public function getResultadoMec()
    {
        return $this->resultadoMec;
    }

    /**
     * Set mensalidades
     *
     * @param string $mensalidades
     * @return InfoCurso
     */
    public function setMensalidades($mensalidades)
    {
        $this->mensalidades = $mensalidades;

        return $this;
    }

    /**
     * Get mensalidades
     *
     * @return string 
     */
    public function getMensalidades()
    {
        return $this->mensalidades;
    }

    /**
     * Set duracao
     *
     * @param integer $duracao
     * @return InfoCurso
     */
    public function setDuracao($duracao)
    {
        $this->duracao = $duracao;

        return $this;
    }

    /**
     * Get duracao
     *
     * @return integer 
     */
    public function getDuracao()
    {
        return $this->duracao;
    }

    /**
     * Set mensalidadeMatutino
     *
     * @param float $mensalidadeMatutino
     * @return InfoCurso
     */
    public function setMensalidadeMatutino($mensalidadeMatutino)
    {
        $this->mensalidadeMatutino = $mensalidadeMatutino;

        return $this;
    }

    /**
     * Get mensalidadeMatutino
     *
     * @return float 
     */
    public function getMensalidadeMatutino()
    {
        return $this->mensalidadeMatutino;
    }

    /**
     * Set mensalidadeNoturno
     *
     * @param float $mensalidadeNoturno
     * @return InfoCurso
     */
    public function setMensalidadeNoturno($mensalidadeNoturno)
    {
        $this->mensalidadeNoturno = $mensalidadeNoturno;

        return $this;
    }

    /**
     * Get mensalidadeNoturno
     *
     * @return float 
     */
    public function getMensalidadeNoturno()
    {
        return $this->mensalidadeNoturno;
    }
    
    /**
     * Set mensalidadeIntegral
     *
     * @param float $mensalidadeIntegral
     * @return InfoCurso
     */
    public function setMensalidadeIntegral($mensalidadeIntegral)
    {
        $this->mensalidadeIntegral = $mensalidadeIntegral;

        return $this;
    }

    /**
     * Get mensalidadeIntegral
     *
     * @return float 
     */
    public function getMensalidadeIntegral()
    {
        return $this->mensalidadeIntegral;
    }

    /**
     * Set imagem
     *
     * @param string $imagem
     * @return InfoCurso
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
     * Set dataCadastro
     *
     * @param \DateTime $dataCadastro
     * @return InfoCurso
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
     * @return InfoCurso
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
     * Set curso
     *
     * @param \Fa\SiteBundle\Entity\Curso $curso
     * @return InfoCurso
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
     * Set arquivoMatriz
     *
     * @param string $arquivoMatriz
     * @return InfoCurso
     */
    public function setArquivoMatriz($arquivoMatriz)
    {
        $this->arquivoMatriz = $arquivoMatriz;

        return $this;
    }

    /**
     * Get arquivoMatriz
     *
     * @return string 
     */
    public function getArquivoMatriz()
    {
        return $this->arquivoMatriz;
    }

    /**
     * Set arquivoConvenios
     *
     * @param string $arquivoConvenios
     * @return InfoCurso
     */
    public function setArquivoConvenios($arquivoConvenios)
    {
        $this->arquivoConvenios = $arquivoConvenios;

        return $this;
    }

    /**
     * Get arquivoConvenios
     *
     * @return string 
     */
    public function getArquivoConvenios()
    {
        return $this->arquivoConvenios;
    }

    /**
     * Set arquivoDocentes
     *
     * @param string $arquivoDocentes
     * @return InfoCurso
     */
    public function setArquivoDocentes($arquivoDocentes)
    {
        $this->arquivoDocentes = $arquivoDocentes;

        return $this;
    }

    /**
     * Get arquivoDocentes
     *
     * @return string 
     */
    public function getArquivoDocentes()
    {
        return $this->arquivoDocentes;
    }
}
