<?php

class AlunoController extends Controller
{

    private $modelAluno;

    public function __construct()
    {

        $this->modelAluno = new Aluno();
    }

    public function index()
    {

        $dados = array();

        $todosOsAlunos = $this->modelAluno->getAlunos();
        $dados["alunos"] = $todosOsAlunos;

        $this->carregarViews('admin/aluno/listar', $dados);
    }

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/aluno/listar';

        $alunos = $this->modelAluno->getAlunos();

        $dados['alunos'] = $alunos;



        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }


}
