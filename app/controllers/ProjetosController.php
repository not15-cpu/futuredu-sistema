<?php


class ProjetosController extends Controller
{
    private $projetosModel;

    public function __construct()
    {
        $this->projetosModel = new Projeto();
    }

    public function listar()
    {
        $dados = array();
        $dados['titulo'] = 'Listar Projetos - FuturEdu';
        $dados['conteudo'] = 'admin/projeto/listar';
        $dados['projetos'] = $this->projetosModel->getProjects();

        $this->carregarViews('admin/dash', $dados);
    }
    public function participantes()
    {
        $dados = array();
        $dados['titulo'] = 'Listar Participantes dos Projetos - FuturEdu';
        $dados['conteudo'] = 'admin/participacao/listar';
        $dados['participa'] = $this->projetosModel->getProjectParticipantes();

        $this->carregarViews('admin/dash', $dados);
    }
}
