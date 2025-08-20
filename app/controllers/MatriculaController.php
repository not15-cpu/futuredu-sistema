<?php

class MatriculaController extends Controller
{

    private $modelMatricula;

    public function __construct()
    {

        $this->modelMatricula = new Matricula();
    }

    public function index()
    {

        $dados = array();

        $todasAsMatriculas = $this->modelMatricula->getMatriculas();
        $dados["matriculas"] = $todasAsMatriculas;

        $this->carregarViews('admin/matricula/listar', $dados);

        
    }

    public function listar(){
        
        $dados = array();

        $dados['conteudo'] = 'admin/matricula/listar';

        $matriculas = $this->modelMatricula->getMatriculas();

        $dados['matriculas'] = $matriculas;

        

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);

    }
}
