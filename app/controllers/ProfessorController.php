
<?php

class ProfessorController extends Controller
{

    private $modelProfessor;

    public function __construct()
    {

        $this->modelProfessor = new Professor();
    }

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/professor/listar';

        $todosProfessores = $this->modelProfessor->getFuncionarios();

        $dados['professor'] = $todosProfessores;

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }
}
