<?php

class HomeController extends Controller{

    public function index(){

        $dados = array();

        $dados['titulo'] = 'CATEGORIAS POPULARES';
        $dados['palavras'] = 'Escola, Educação, Tecnologia...';

        //carregar 6 cursos - Rand
        $modelCurso = new Curso();

        $dados['cursos'] = $modelCurso->getCursoRand(6);

        //var_dump($cursos);
        
        //var_dump ($dados);

        $this->carregarViews('home', $dados);

        

        // echo '<h1>Cheguei Na Home</h1>';
    }
}