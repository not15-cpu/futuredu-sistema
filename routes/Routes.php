<?php

class Routes
{
    public function execute()
    {
        $url = '/';

        if (isset($_GET['url'])) {
            // Se a URL tiver algo, concatena com a barra
            $url .= $_GET['url'];
        }

        $parametro = array();

        if (!empty($url) && $url != '/') {
            /**
             * 1 - Controller
             * 2 - Método
             * 3 - Parâmetro(s)
             */

            // Explode a URL e remove o primeiro item vazio
            $url = explode('/', $url);
            array_shift($url); // Remove o primeiro item vazio (barra inicial)

            // 1. Controller
            $controladorAtual = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            // 2. Ação
            if (isset($url[0]) && !empty($url[0])) {
                $acaoAtual = $url[0];
                array_shift($url);
            } else {
                $acaoAtual = 'index';
            }

            // 3. Parâmetros
            if (count($url) > 0) {
                $parametro = $url;
            }
        } else {
            $controladorAtual = 'HomeController';
            $acaoAtual = 'index';
        }

        // Verifica se o controller e o método existem
        if (
            !file_exists('../app/controllers/' . $controladorAtual . '.php') ||
            !method_exists($controladorAtual, $acaoAtual)
        ) {
            echo 'Erro: Não existe o controlador <strong>' . $controladorAtual . '</strong> ou a ação <strong>' . $acaoAtual . '</strong>.';

            $controladorAtual = 'ErrorController';
            $acaoAtual = 'index';
        }

        // Instancia o controller e chama o método com os parâmetros
        $controller = new $controladorAtual();
        call_user_func_array(array($controller, $acaoAtual), $parametro);
    }
}
