<?php


class EmpresasController extends Controller
{
    private $empresaModel;

    public function __construct()
    {
        $this->empresaModel = new Empresa();
    }
    public function listar()
    {
        $dados = array();
        $dados['titulo'] = 'Listar Empresas - FuturEdu';
        $dados['conteudo'] = 'admin/empresa/listar';
        $dados['empresas'] = $this->empresaModel->getEmpresasInfo();

        $this->carregarViews('admin/dash', $dados);
    }
}
