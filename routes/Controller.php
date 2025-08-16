<?php


class Controller
{
    public function carregarViews($views, $dados = array())
    {
        extract($dados);
        require_once '../app/views/' . $views . '.php';
        // Pegará o endereço e irá exibir o conteúdo do arquivo com base no controller
    }
}
