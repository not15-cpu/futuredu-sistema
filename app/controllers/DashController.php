<?php

class DashController extends Controller{

    public function index(){

            // Fazer um tratamento para lidar com usuario logado

            // Verifica se a sessão já foi iniciada, se não, inicia a sessão
            if(session_status() == PHP_SESSION_NONE){
                session_start();
            }

            if(!isset($_SESSION['tipo']) || !isset($_SESSION['tipo_id'])){

                header('location:' . URL_BASE);

            }

            $dados = array();
            $dados['titulo'] = 'Dashboard | Sistema Escola';
            $this->carregarViews('admin/dash', $dados);
            exit;
    }

    //função para destruir a pagina, apagar as informações e sair da pagina
    public function sair(){
        session_unset();
        session_destroy();
        header('location:' .URL_BASE);
        exit;
    }


}