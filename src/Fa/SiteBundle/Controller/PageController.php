<?php

namespace Fa\SiteBundle\Controller;

use FFMpeg\Coordinate\TimeCode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    
    private $noticiasMenu = null;
    private $cursos = null;
    private $destaque = null;
    private $destaqueContato = null;
    private $videosGaleria = null;
    
    
    private function carregaDadosComuns($em){
        $this->noticiasMenu = $em->getRepository('FaSiteBundle:Noticia')
                ->listarTodos(4);
        
        $this->cursos = $em->getRepository('FaSiteBundle:Curso')
                ->listarTodosVinculados(null, 1);
        
        $this->destaque = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findOneBy(array('menu' => 'instituicao'));
        
        $this->destaqueContato = $em->getRepository('FaSiteBundle:DestaqueMenu')
                ->findOneBy(array('menu' => 'contato'));
        
        $this->videosGaleria = $em->getRepository('FaSiteBundle:VideoGaleria')
                ->listarTodos(2);
        
    }


    public function indexAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $this->carregaDadosComuns($em);

        $banners = $em->getRepository('FaSiteBundle:Banner')
                ->findAll();
        
        $noticias = $em->getRepository('FaSiteBundle:Noticia')
                ->listarTodos(2);
        
        $eventos = $em->getRepository('FaSiteBundle:Evento')
                ->listarTodos(1);
        
        $videos = $em->getRepository('FaSiteBundle:Video')
                ->listarTodos(1);
        
        return $this->render('FaSiteBundle:Page:index.html.twig', array(
            'banners' => $banners,
            'noticias' => $noticias,
            'eventos' => $eventos,
            'videos' => $videos,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function centralAction()
    {
        return $this->render('FaSiteBundle:Page:central.html.twig');
    }
    
    public function instituicaoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:instituicao.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cpaAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:cpa.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cappAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:capp.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function infraestruturaAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:infraestrutura.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function natAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:nat.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function pronapAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:pronap.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function extensaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:extensao.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function atendimentoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:atendimento.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function iniciacaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:iniciacao.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function semicAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:semic.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cepAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:cep.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function ceuaAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:ceua.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function monitoriaAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:monitoria.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function fundamentalAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:fundamental.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function faleAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:fale.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cursoAction($slug)
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $curso = $em->getRepository('FaSiteBundle:Curso')
                ->findOneBy(array('slug' => $slug));
        
        $infoCurso = $em->getRepository('FaSiteBundle:InfoCurso')
                ->findOneBy(array('curso' => $curso->getId()));
        
        return $this->render('FaSiteBundle:Page:curso.html.twig', array(
            'curso' => $curso,
            'infoCurso' => $infoCurso,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function revistasAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $revistas = $em->getRepository('FaSiteBundle:Revista')
                ->findAll();
        
        return $this->render('FaSiteBundle:Page:revistas.html.twig', array(
            'revistas' => $revistas,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function processaContatoAction() {

        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        $dados = $request->request;

        $nome = $dados->get('nome');
        $email = $dados->get('email');
        $telefone = $dados->get('telefone');
        $setor = $dados->get('setor');
        $descricao = $dados->get('descricao');

        if ($nome && $email && $telefone && $setor && $descricao) {
            
            switch ($setor){
                case 1:
                    $setor = "Secretaria";
                    break;
            }
            
            $parametros = $em->getRepository('FaSiteBundle:ParametroEmail')
                ->findOneBy(array('id' => 1));
            
            $email = \Swift_Message::newInstance()
                        ->setSubject("Contato: ".$nome)
                        ->setFrom($email)
                        ->setTo($parametros->getDestinatario())
                        ->setBody($this->renderView('FaSiteBundle:Component:email.html.twig', 
                                array('nome' => $nome, 'email' => $email, 
                                    'telefone' => $telefone, 'setor' => $setor, 'descricao' => $descricao)))
                        ->setContentType("text/html");
                        //->setBody($form->get('mensagem')->getData());
                $this->get('mailer')->send($email);
        } else {
            echo "Dados inválidos. Por favor, preencha corretamente o formulário";
        }

        return new Response();
    }
    
    public function hoteisAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:hoteis.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cidadeAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:cidade.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }

    public function noticiaAction($slug)
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $noticia = $em->getRepository('FaSiteBundle:Noticia')
                ->findOneBy(array('slug' => $slug));
        
        return $this->render('FaSiteBundle:Page:noticia.html.twig', array(
            'noticia' => $noticia,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function eventoAction($slug)
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $evento = $em->getRepository('FaSiteBundle:Evento')
                ->findOneBy(array('slug' => $slug));
        
        return $this->render('FaSiteBundle:Page:evento.html.twig', array(
            'evento' => $evento,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function construcaoAction($titulo)
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:construcao.html.twig', array(
            'titulo' => $titulo,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cursosGraduacaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $cursosCadastrados = $em->getRepository('FaSiteBundle:Curso')->listarTodosVinculados(null, 1);
                //->findBy(array('tipoCurso' => 1), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:cursos.html.twig', array(
            'cursosCadastrados' => $cursosCadastrados,
            'tipo' => 'Graduação',
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cursosPosGraduacaoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $cursosCadastrados = $em->getRepository('FaSiteBundle:Curso')->listarTodosVinculados(null, 2);
                //->findBy(array('tipoCurso' => 2), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:cursos.html.twig', array(
            'cursosCadastrados' => $cursosCadastrados,
            'tipo' => 'Pós-Graduação',
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function cursosLivresAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $cursosCadastrados = $em->getRepository('FaSiteBundle:Curso')->listarTodosVinculados(null, 3);
                //->findBy(array('tipoCurso' => 1), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:cursos.html.twig', array(
            'cursosCadastrados' => $cursosCadastrados,
            'tipo' => 'Livres',
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function formulariosAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:formularios.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function regulamentoAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:regulamento.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function ouvidoriaAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        $cursosCadastrados = $em->getRepository('FaSiteBundle:Curso')
                ->findBy(array(), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:ouvidoria.html.twig', array(
            'cursosCadastrados' => $cursosCadastrados,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function processaOuvidoriaAction() {

        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();
        
        $dados = $request->request;

        $nome = $dados->get('nome');
        $assunto = $dados->get('assunto');
        $curso = $dados->get('curso');
        $descricao = $dados->get('descricao');

        if ($descricao) {
            
            if($curso > 0){
                $umCurso = $em->getRepository('FaSiteBundle:Curso')
                ->findOneBy(array('id' => $curso));
                $curso = $umCurso->getNome();
            } else{
                $curso = 'Não Informado';
            }
            
            $nome = $nome == null || trim($nome) == '' ? 'Nome Não Informado' : $nome;
            $assunto = $assunto == null || trim($assunto) == '' ? 'Assunto Não Informado' : $assunto;
            
            $parametros = $em->getRepository('FaSiteBundle:ParametroEmail')
                ->findOneBy(array('id' => 1));
            
            $email = \Swift_Message::newInstance()
                        ->setSubject("Contato Ouvidoria: ".$nome)
                        ->setFrom($parametros->getDestinatarioOuvidoria())
                        ->setTo($parametros->getDestinatarioOuvidoria())
                        ->setBody($this->renderView('FaSiteBundle:Component:email-ouvidoria.html.twig', 
                                array('nome' => $nome, 'curso' => $curso, 
                                    'assunto' => $assunto,
                                    'descricao' => $descricao)))
                        ->setContentType("text/html");
                        //->setBody($form->get('mensagem')->getData());
                $this->get('mailer')->send($email);
        } else {
            echo "Dados inválidos. Por favor, preencha corretamente o formulário";
        }

        return new Response();
    }
    
    public function trabalheAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:trabalhe.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function processaTrabalheAction() {

        $request = $this->getRequest();

        $em = $this->getDoctrine()->getManager();
        
        $dados = $request->request;

        $nome = $dados->get('nome');
        $telefone = $dados->get('telefone');
        $cidade = $dados->get('cidade');
        $cpf = $dados->get('cpf');
        $data = $dados->get('data-nascimento');
        $tipo = $dados->get('tipo-vaga');
        
        $arquivo = $request->files->get('curriculo');
        
        if($arquivo){
            $arquivo->move('curriculos', $arquivo->getClientOriginalName());
        }

        $parametros = $em->getRepository('FaSiteBundle:ParametroEmail')
                ->findOneBy(array('id' => 1));
        
        if ($nome) {
            
            switch($tipo){
                case 1:
                    $tipo = 'Docente';
                    $destinatario = $parametros->getDestinatarioDocente();
                    break;
                case 2:
                    $tipo = 'Técnico-Administrativo';
                    $destinatario = $parametros->getDestinatarioTecnico();
                    break;
                case 3:
                    $tipo = 'Estagiário';
                    $destinatario = $parametros->getDestinatarioEstagiario();
                    break;
            }
            
            $telefone = $telefone == null || trim($telefone) == '' ? 'Telefone Não Informado' : $telefone;
            $cidade = $cidade == null || trim($cidade) == '' ? 'Cidade Não Informada' : $cidade;
            $cpf = $cpf == null || trim($cpf) == '' ? 'CPF Não Informado' : $cpf;
            $data = $data == null || trim($data) == '' ? 'Data de Nascimento Não Informada' : $data;
            
            if($arquivo){
                $email = \Swift_Message::newInstance()
                        ->setSubject("Contato Trabalhe Conosco: ".$nome)
                        ->setFrom($destinatario)
                        ->setTo($destinatario)
                        ->attach(\Swift_Attachment::fromPath('curriculos/'.$arquivo->getClientOriginalName()))
                        ->setBody($this->renderView('FaSiteBundle:Component:email-trabalhe.html.twig', 
                                array('nome' => $nome, 'telefone' => $telefone, 
                                    'cidade' => $cidade,
                                    'cpf' => $cpf,
                                    'data' => $data,
                                    'tipo' => $tipo
                                )
                        ))
                        ->setContentType("text/html");
            } else{
                $email = \Swift_Message::newInstance()
                        ->setSubject("Contato Trabalhe Conosco: ".$nome)
                        ->setFrom($destinatario)
                        ->setTo($destinatario)
                        ->setBody($this->renderView('FaSiteBundle:Component:email-trabalhe.html.twig', 
                                array('nome' => $nome, 'telefone' => $telefone, 
                                    'cidade' => $cidade,
                                    'cpf' => $cpf,
                                    'data' => $data,
                                    'tipo' => $tipo
                                )
                        ))
                        ->setContentType("text/html");
            }
            
            
                        //->setBody($form->get('mensagem')->getData());
                $this->get('mailer')->send($email);
                
                if($arquivo){
                    unlink('curriculos/'.$arquivo->getClientOriginalName());
                }  
                
        } else {
            echo "Dados inválidos. Por favor, preencha corretamente o formulário";
        }

        return new Response();
    }
    
    public function mapasAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:mapas.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function videosAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        $videos = $em->getRepository('FaSiteBundle:VideoGaleria')
                ->listarTodos();
        
        return $this->render('FaSiteBundle:Page:videos.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria,
            'videos' => $videos
        ));
    }
    
    public function responsabilidadeAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);
        
        return $this->render('FaSiteBundle:Page:responsabilidade.html.twig', array(
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function noticiasAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $noticias = $em->getRepository('FaSiteBundle:Noticia')->listarTodos();
                //->findBy(array('tipoCurso' => 1), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:noticias.html.twig', array(
            'noticias' => $noticias,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
    public function eventosAction()
    {
        
        $em = $this->getDoctrine()->getManager();
        $this->carregaDadosComuns($em);

        $eventos = $em->getRepository('FaSiteBundle:Evento')->listarTodos();
                //->findBy(array('tipoCurso' => 1), array('nome' => 'ASC'));
        
        return $this->render('FaSiteBundle:Page:eventos.html.twig', array(
            'eventos' => $eventos,
            'cursos' => $this->cursos,
            'noticiasMenu' => $this->noticiasMenu,
            'destaque' => $this->destaque,
            'destaqueContato' => $this->destaqueContato,
            'videosGaleria' => $this->videosGaleria
        ));
    }
    
}
