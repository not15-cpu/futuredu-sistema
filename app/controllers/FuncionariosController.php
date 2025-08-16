<?php


class FuncionariosController extends Controller
{
    private $funcModel;

    public function __construct()
    {
        $this->funcModel = new Empresa();
    }

    public function listar()
    {
        $dados = array();
        $dados['titulo'] = 'Listar Funcionários - FuturEdu';
        $dados['conteudo'] = 'admin/funcionario/listar';
        $dados['func'] = $this->funcModel->getFuncionario();

        $this->carregarViews('admin/dash', $dados);
    }
}
