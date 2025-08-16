<?php


class AuthController extends Controller{

    private $funcModel;
    private $alunoModel;

    public function __construct()
    {
        $this->funcModel = new Instrutores();
        $this->alunoModel = new Aluno();
    }

    public function index(){
        $dados = array();

        $dados['titulo'] = 'Login - FuturEdu';
        $this->carregarViews('login', $dados);
    }

    public function login(){
        if($_SERVER["REQUEST_METHOD"] === "POST"){

            $email = filter_input(INPUT_POST, 'user_email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'user_pass');

            $usuario = $this->funcModel->buscarFunc($email, $senha);

            
            if($usuario){
                $tipo       = 'funcionario';
                $tipo_id    = $usuario['id_funcionario'];
                $tipo_nome  = $usuario['nome_funcionario'];
                $tipo_email = $usuario['email_funcionario'];
                $tipo_cargo = $usuario['cargo_funcionario'];
            }else{
                $usuario = $this->alunoModel->postLoginAluno($email, $senha);
                if($usuario){
                    $tipo       = 'aluno';
                    $tipo_id    = $usuario['id_aluno'];
                    $tipo_nome  = $usuario['nome_aluno'];
                    $tipo_email = $usuario['email_aluno'];
                }else{
                    $usuario = null;
                }
            }

            if($usuario){
                $_SESSION['tipo']           = $tipo;
                $_SESSION['tipo_id']        = $tipo_id;
                $_SESSION['tipo_nome']      = $tipo_nome;
                $_SESSION['tipo_email']     = $tipo_email;
                
                // Redirecionar para a página do dash

                header("Location: " . URL_BASE . "dash");
                exit;
            }else{
                $_SESSION['erro-login'] = "E-mail ou Senha incorretos";
            }

        } // Fim da verificação do tipo do usuário

    }

    public function register(){
        $dados = array();

        $dados['titulo'] = 'Registro - FuturEdu';
        $this->carregarViews('registro', $dados);
    }
}