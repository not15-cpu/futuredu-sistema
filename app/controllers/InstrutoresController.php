<?php
class InstrutoresController extends Controller
{
    private $instructorsModel;

    public function __construct()
    {
        $this->instructorsModel = new Instrutores();
    }

    // Método para listar todos os instrutores
    public function index()
    {
        $dados = array();
        $instrutores = $this->instructorsModel->getAllInstructors();

        $dados['instrutores'] = $instrutores; // Passando todos os instrutores para a view
        $this->carregarViews('instrutores', $dados);
    }

    // Método para gerar o link amigável do instrutor
    function gerarLinkInstrutor($link)
    {
        $link = mb_strtolower($link, 'UTF-8');
        $caracter = [
            // Minúsculas e caracteres especiais
            'à' => 'a',
            'á' => 'a',
            'â' => 'a',
            'ã' => 'a',
            'ä' => 'a',
            'å' => 'a',
            'ç' => 'c',
            'é' => 'e',
            'ê' => 'e',
            'í' => 'i',
            'ó' => 'o',
            'ô' => 'o',
            'ú' => 'u',
            ' ' => '-'
        ];
        $link = strtr($link, $caracter);
        return $link;
    }

    // Método para exibir detalhes do instrutor
    public function detalhe($link)
    {
        $dados = array();
        $instrutores = $this->instructorsModel->getAllInstructors();  // Obtendo todos os instrutores

        // Verificando se o link do instrutor bate com o parâmetro
        foreach ($instrutores as $instrutor) {
            if ($this->gerarLinkInstrutor($instrutor['nome_funcionario']) == $link) {
                $dados['instrutor'] = $instrutor; // Passando o instrutor encontrado
                $dados['titulo'] = $instrutor['nome_funcionario'];
                $this->carregarViews('detalhe-instrutor', $dados); // Carregando a view do instrutor
                return;
            }
        }

        // Caso não encontre o instrutor:
        $dados['titulo'] = 'Instrutor não encontrado';
        $this->carregarViews('instrutor-nao-encontrado', $dados); // Carregando a view de "instrutor não encontrado"
    }
}
