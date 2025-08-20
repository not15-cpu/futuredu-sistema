<?php

class FuncionarioController extends Controller
{

    private $modelFuncionario;

    public function __construct()
    {

        $this->modelFuncionario = new Funcionario();
    }
    public function listar(){
        
        $dados = array();

        $dados['conteudo'] = 'admin/funcionario/listar';

        $todosFuncionarios = $this->modelFuncionario->getFuncionarios();

        $dados['funcionarios'] = $todosFuncionarios;

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);

    }
}

