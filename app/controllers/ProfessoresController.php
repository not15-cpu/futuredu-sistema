<?php

class ProfessoresController extends Controller
{
    private $professorModel;

    public function __construct()
    {
        $this->professorModel = new Instrutores();
    }
    public function listar()
    {
        $dados = array();

        $dados['titulo'] = 'Listar Professores - FuturEdu';
        $dados['conteudo'] = 'admin/professores/listar';
        $dados['instrutores'] = $this->professorModel->getInstructors();

        $this->carregarViews('admin/dash', $dados);
    }
}
