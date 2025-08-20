<?php

class EmpresaController extends Controller
{

    private $modelEmpresa;

    public function __construct()
    {

        $this->modelEmpresa = new Empresa();
    }

    public function index()
    {

        $dados = array();

        $todasAsEmpresas = $this->modelEmpresa->getEmpresas();
        $dados["empresas"] = $todasAsEmpresas;

        $this->carregarViews('admin/empresa/listar', $dados);

        
    }

    public function listar(){
        
        $dados = array();

        $dados['conteudo'] = 'admin/empresa/listar';

        $empresas = $this->modelEmpresa->getEmpresas();

        $dados['empresa'] = $empresas;

        

        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);

    }
}
