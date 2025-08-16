<?php

class CursoController extends Controller
{

    private $modelCurso;

    //Construir algo automaticamente - executa todos os dados | Instanciou uma classe e será executado 
    public function __construct()
    {

        $this->modelCurso = new Curso();
    }

    public function index()
    {

        $dados = array();


        $todosOsCursos = $this->modelCurso->getTodosCurso();
        $dados['cursos'] = $todosOsCursos;

        // var_dump($todosOsCursos);

        //
        $this->carregarViews('servicos', $dados);
    }

    public function detalhe($link)
    {

        $dados = array();

        $curso = $this->modelCurso->getTodosCurso();

        foreach ($curso as $linha) {

            if ($this->gerarLinkCurso($linha['nome_curso']) == $link) {

                //linha contem todos dos dados
                $dados['curso'] = $linha;
                $dados['titulo'] = $linha['nome_curso'];
                $this->carregarViews('detalhe-curso', $dados);
                return;
            } else {
            }
        }
    }

    function gerarLinkCurso($link)
    {

        $link = mb_strtolower($link, 'UTF-8');
        $caracter = [


            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ä' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ö' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            ' ' => '-',
            '!' => '',
            '"' => '',
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            "'" => '',
            '(' => '',
            ')' => '',
            '*' => '',
            '+' => '',
            ',' => '',
            '.' => '',
            '/' => '',
            ':' => '',
            ';' => '',
            '<' => '',
            '=' => '',
            '>' => '',
            '?' => '',
            '@' => '',
            '[' => '',
            ']' => '',
            '^' => '',
            '`' => '',
            '{' => '',
            '|' => '',
            '}' => '',
            '~' => '',
            '\\' => '',
            '–' => '-',
            '—' => '-',
            '“' => '',
            '”' => '',
            '´' => '',
        ];

        $link = strtr($link, $caracter);

        return $link;
    }

    // --------------------------------------
    // --------------DASHBOARD---------------
    // --------------------------------------

    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/curso/listar';

        $cursos = $this->modelCurso->getTodosCursoDash();

        $dados['cursos'] = $cursos;



        // var_dump($cursos); caso queire testar o que o cursos irá trazer do banco

        $this->carregarViews('admin/dash', $dados);
    }

    // método para adicionar novo curso

    public function adicionar()
    {

        $dados = array();



        // 1º = A chamada vem do botão Cadastrar Curso? | Verificar

        // 2º = Pegar os dados do Formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {



            $nome_curso = filter_input(INPUT_POST, 'nome_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $nivel_curso = filter_input(INPUT_POST, 'nivel_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $carga_horaria_curso = filter_input(INPUT_POST, 'carga_horaria_curso', FILTER_SANITIZE_NUMBER_INT);
            $descricao_curso = filter_input(INPUT_POST, 'descricao_curso', FILTER_SANITIZE_SPECIAL_CHARS);   // Verificação para ver se esta chegando no 'if'
            $modalidade_curso = filter_input(INPUT_POST, 'modalidade_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $area_curso = filter_input(INPUT_POST, 'area_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $pre_requisito_curso = filter_input(INPUT_POST, 'pre_requisito_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $valor_curso = filter_input(INPUT_POST, 'valor_curso', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $alt_curso = $nome_curso;

            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao_curso = date('Y-m-d H:i:s');
            $data_atualizacao_curso = date('Y-m-d H:i:s');
            $status_curso = 'Pendente';

            // 3º = Inserir os dados do banco na tbl_curso

            if ($nome_curso && $nivel_curso && $carga_horaria_curso) {

                $dadosCurso = array(

                    'nome_curso'             => $nome_curso,
                    'nivel_curso'            => $nivel_curso,
                    'carga_horaria_curso'    => $carga_horaria_curso,
                    'descricao_curso'        => $descricao_curso,
                    'modalidade_curso'       => $modalidade_curso,
                    'area_curso'             => $area_curso,
                    'pre_requisito_curso'    => $pre_requisito_curso,
                    'valor_curso'            => $valor_curso,
                    'alt_curso'              => $nome_curso,
                    'data_criacao_curso'     => $data_criacao_curso,
                    'data_atualizacao_curso' => $data_atualizacao_curso,
                    'status_curso'           => $status_curso

                );

                $id_curso = $this->modelCurso->addCurso($dadosCurso);

                if ($id_curso) {

                    // 5º = Atualizar o reagistro do curso com a foto com o novo nome


                    if (isset($_FILES['foto_curso']) && $_FILES['foto_curso']['error'] == 0) {

                        $arquivo = $this->uploadFoto($_FILES['foto_curso'], $id_curso, $nome_curso);

                        // var_dump($_FILES['foto_curso']);

                        if ($arquivo) {
                            // atualizar a foto no banco de dados do curso adicionar no ultimo id Curso adicionar

                            $this->modelCurso->atualizarFoto($id_curso, $arquivo);
                        } else {
                            //(MSG mensagen) informando que a foto nao foi salva

                            $dados['Mensagem'] = 'Erro ao fazer upload da foto.';
                            $dados['tipoMsg'] = 'erro';
                        }
                    }

                    // 6º = Alerta na pagina Listar/Curso

                    $_SESSION['Mensagem'] = "Curso adicionado com sucesso!";
                    $_SESSION['tipoMsg']  = "Sucesso!";
                    header('Location: ' . URL_BASE . 'curso/listar');
                    exit;
                }
            }
        }

        $dados['conteudo'] = 'admin/curso/adicionar';
        $this->carregarViews('admin/dash', $dados);
    } // Adicionar Acaba aqui o Método

    // método para realizar o upload da foto com o tratamento do nome
    public function uploadFoto($file, $id, $nome)
    {

        $dir = 'uploads/curso/';

        if (file_exists(!$dir)) { //comando para criar um diretorio caso nao exista

            mkdir($dir, 0755, true);
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);


        $novoNome = $id . '_' . $this->gerarLinkCurso($nome) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $novoNome)) {

            var_dump($novoNome);

            return $novoNome;
        } else {
            $novoNome = 'sem_imagem.png';
            return $novoNome;
        }
    }

    public function editar($id)
    {

        $dados = array();


        /** 1º Carregar as informações atuais do curso */
        $carregarDadosCurso = $this->modelCurso->carregarDados($id);


        $dados['carregarDadosCurso'] = $carregarDadosCurso;

        // echo'estou aqui';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $nome_curso = filter_input(INPUT_POST, 'nome_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $nivel_curso = filter_input(INPUT_POST, 'nivel_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $carga_horaria_curso = filter_input(INPUT_POST, 'carga_horaria_curso', FILTER_SANITIZE_NUMBER_INT);
            $descricao_curso = filter_input(INPUT_POST, 'descricao_curso', FILTER_SANITIZE_SPECIAL_CHARS);   // Verificação para ver se esta chegando no 'if'
            $modalidade_curso = filter_input(INPUT_POST, 'modalidade_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $area_curso = filter_input(INPUT_POST, 'area_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $pre_requisito_curso = filter_input(INPUT_POST, 'pre_requisito_curso', FILTER_SANITIZE_SPECIAL_CHARS);
            $valor_curso = filter_input(INPUT_POST, 'valor_curso', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $alt_curso = $nome_curso;

            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao_curso = $carregarDadosCurso['data_criacao_curso'];
            $data_atualizacao_curso = date('Y-m-d H:i:s');
            $status_curso = $carregarDadosCurso['status_curso'];

            // 3º = Atualizar os dados na banco na tbl_curso

            if ($nome_curso && $nivel_curso && $carga_horaria_curso) {

                if (isset($_FILES['foto_curso']) && $_FILES['foto_curso']['error'] == 0) {

                    $arquivo = $this->uploadFoto($_FILES['foto_curso'], $id, $nome_curso);

                    // var_dump($_FILES['foto_curso']);


                } else {

                    $arquivo = $carregarDadosCurso['foto_curso'];
                }


                $dadosCurso = array(

                    'id_curso'               => $id,
                    'nome_curso'             => $nome_curso,
                    'nivel_curso'            => $nivel_curso,
                    'carga_horaria_curso'    => $carga_horaria_curso,
                    'descricao_curso'        => $descricao_curso,
                    'modalidade_curso'       => $modalidade_curso,
                    'area_curso'             => $area_curso,
                    'pre_requisito_curso'    => $pre_requisito_curso,
                    'valor_curso'            => $valor_curso,
                    'alt_curso'              => $nome_curso,
                    'data_criacao_curso'     => $data_criacao_curso,
                    'data_atualizacao_curso' => $data_atualizacao_curso,
                    'status_curso'           => $status_curso,
                    'foto_curso'             => $arquivo

                );

                $resultado = $this->modelCurso->editarCurso($dadosCurso);

                if ($resultado) {



                    // 6º = Alerta na pagina Listar/Curso

                    $_SESSION['Mensagem'] = "Curso adicionado com sucesso!";
                    $_SESSION['tipoMsg']  = "Sucesso!";
                    header('Location: ' . URL_BASE . 'curso/listar');
                    exit;
                } else {
                    $_SESSION['Mensagem'] = "Curso não atualizado!";
                    $_SESSION['tipoMsg']  = "erro!";
                    header('Location: ' . URL_BASE . 'curso/listar');
                    exit;
                }
            }
        }

        $dados['conteudo'] = 'admin/curso/editar';
        $this->carregarViews('admin/dash', $dados);

        /** 2º A chamada vem do botão Editar Curso */
        /** 3º Pegar os dados do form */
        /** 4º Atualizar os dados na tabela curso */
        /** 5º Tratar o nome da imagem e salvar na pasta UPLOAD */
        /** 6º Atualizar a campo foto_curso com o novo nome da foto */
        /** 7º Alerta na página de Listar Curso */
    }
    // método para desativar o curso
    public function desativar($id){
    
        $resultado = $this->modelCurso->desativarCurso($id);

        if ($resultado) {
            //Retornar a resposta do AJAX
            echo json_encode(['sucesso' => true]);
        }else{
            echo json_encode(['sucesso'=> false, 'mensagem' => 'Erro ao desativar o curso.']);
        }
    
    }

    // Método para atualizar os status do curso
    public function atualizarStatus() {
        
        $dados = json_decode(file_get_contents('php://input'), true);

        $sucesso = $this->modelCurso->atualizarStatus($dados['id_curso'], $dados['status_curso']);

        echo json_encode(['sucesso' => $sucesso]);
    }
}
