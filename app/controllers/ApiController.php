<?php

class ApiController extends Controller
{

    private $cursoModel;
    private $empresaModel;
    private $funcionarioModel;
    private $alunoModel;
    private $notasModel;
    private $projetoModel;
    private $matriculaModel;
    private $participacaoModel;

    public function __construct()
    {

        $this->cursoModel = new Curso();
        $this->empresaModel = new Empresa();
        $this->funcionarioModel = new Funcionario();
        $this->projetoModel = new Projeto();
        $this->participacaoModel = new Projeto();
        $this->alunoModel = new Aluno();
        $this->matriculaModel = new Matricula();
        $this->notasModel = new Nota();
    }

    public function index()
    {
        $this->carregarViews('api-doc');
    }

    // ______________Api Cursos________________
    // Lisar todos os cursos em ordem alfabética //
    public function ListarCursos()
    {
        // echo 'teste';

        $cursos = $this->cursoModel->getTodosCurso();

        if (empty($cursos)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum curso encontrado"]);
            return;

        }

        // O json está trazendo a variavel ja codificada |  
        echo json_encode($cursos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
    //-----------Fim Api Cursos------------

    //___________Começo Api Listar cursos aleatorios___________

    public function ListarCursosAleatorios()
    {

        $cursos = $this->cursoModel->getCursoRand();

        if (empty($cursos)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum curso encontrado"]);
            return;

        }

        echo json_encode($cursos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
    //-----------Fim Api Cursos Aleatorios------------

    //___________Api Empresas___________

    public function ListarEmpresas()
    {
        $empresas = $this->empresaModel->getEmpresas();

        if (empty($empresas)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhuma empresa encontrado"]);
            return;

        }

        echo json_encode($empresas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
    //--------fim Api Empresas----------

    //___________Api Funcionarios___________

    public function ListarFuncionarios()
    {
        $funcionarios = $this->funcionarioModel->getFuncionarios();

        if (empty($funcionarios)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum funcionario encontrado"]);
            return;

        }

        echo json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function ListarFuncionariosCargo($cargo)
    {
        $funcionarios = $this->funcionarioModel->getFuncionariosCargo($cargo);

        if (empty($funcionarios)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum funcionario encontrado"]);
            return;

        }

        echo json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }
    //--------fim Api Funcionarios----------

    //_________Api Alunos___________

    public function ListarAlunos(){

        $alunos = $this->alunoModel->getAlunos();

        if (empty($alunos)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhuma empresa encontrado"]);
            return;

        }

        echo json_encode($alunos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
    //------------Fim Api Alunos-------------

    
    public function ListarCursosNome($nomeCurso)
    {

        $cursos = $this->cursoModel->getCursosNome($nomeCurso);

        if (empty($cursos)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum curso encontrado"]);
            return;

        }

        echo json_encode($cursos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function ListarCursosNivel($nivelCurso)
    {

        $cursos = $this->cursoModel->getCursosNivel($nivelCurso);

        if (empty($cursos)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum curso encontrado"]);
            return;

        }

        echo json_encode($cursos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    // ______________API Projetos________________

    public function NovoProjeto(){

        $titulo = $_POST['titulo_projeto'] ?? null;
        $descricao = $_POST['descricao_projeto'] ?? null;
        $cod_professor = $_POST['id_professor'] ?? null;
        $cod_sigla = $_POST['id_sigla'] ?? null;
        $data_inicio = $_POST['data_criacao_projeto'] ?? null;
        $data_entrega = $_POST['data_entrega_projeto'] ?? null;
        $status_projeto = $_POST['status_projeto'] ?? null;
        $url_projeto = $_POST['url_projeto'] ?? null;

        $resposta = $this->projetoModel->postNovoProjeto($titulo, $descricao, $cod_professor,
         $cod_sigla, $data_inicio, $data_entrega, $status_projeto, $url_projeto);

        header('Content-Type: application/json');
        echo json_encode($resposta);
        exit;

    }

    // ________________API Participacao Projeto_________________

     // ______________API Projetos________________

     public function NovaParticipacaoProjeto(){

        $cod_projeto = $_POST['id_projeto'] ?? null;
        $nome_aluno = $_POST['nome_aluno'] ?? null;
        $nota_participacao = $_POST['nota_participacao_projeto'] ?? null;
        $observacao = $_POST['obs_participacao_projeto'] ?? null;

        $resposta = $this->projetoModel->postParticipacaoProjeto($cod_projeto, $nome_aluno, $nota_participacao,
         $observacao);

        header('Content-Type: application/json');
        echo json_encode($resposta);
        exit;

    }

    public function ListarProjetosIncritos($id){
        if(!ctype_digit($id) || (int)$id <= 0){
            http_response_code(400);
            echo json_encode(["erro" => "ID inválido"]);
            return;
        }

        $headers = getallheaders();

        $authHeader =  $headers['Authorization'] ?? '';
        if(!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            http_response_code(401);
            echo json_encode(["erro" => "Token não fornecido ou malformado"]);
            return;
        }

        $payload = AuxiliarToken::validar($matches[1]);

        if(!$payload){
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            return;
        }

        $aluno = $this->projetoModel->ListarProjetosIncritos($id);

        if(empty($aluno)){
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum aluno encontrado."]);
            return;
        }
        http_response_code(200);
        echo json_encode($aluno, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // ______________________Listar Aluno pelo ID________________________________

    public function ListarAlunoId($id){

        if(!ctype_digit($id) || (int)$id <= 0){
            http_response_code(400);
            echo json_encode(["erro" => "ID inválido"]);
            return;
        }

        $headers = getallheaders();

        $authHeader =  $headers['Authorization'] ?? '';
        if(!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            http_response_code(401);
            echo json_encode(["erro" => "Token não fornecido ou malformado"]);
            return;
        }

        $payload = AuxiliarToken::validar($matches[1]);

        if(!$payload){
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            return;
        }

        $aluno = $this->alunoModel->getAlunoId($id);

        if(empty($aluno)){
            http_response_code(404);
            echo json_encode(["erro" => "Nenhum aluno encontrado."]);
            return;
        }
        http_response_code(200);
        echo json_encode($aluno, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

    public function AtualizarAluno($id){
        if($_SERVER ["REQUEST_METHOD"] === 'PATCH'){

            parse_str(file_get_contents("php://input"), $dados);

            if(empty($dados)){

                http_response_code(404);
                echo json_encode(["erro" => "Nenhum dado enviado para atualizar."]);
                return;

            }

            $resultado = $this->alunoModel->patchAtualizarAluno($dados, $id);

            if($resultado){
                http_response_code(200);
                echo json_encode(["Mensagem" => "Aluno Atualizado com sucesso!!!"]);
            }else{

                http_response_code(500);
                echo json_encode(["erro" => "Erro ao atualizar o aluno. Erro de Servidor."]);

            }
        }else{
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido"]);
        }
    }

     // ______________________Listar Funcionario pelo ID________________________________


    public function ListarFuncionarioId($id){

        $funcionario = $this->funcionarioModel->getFuncionarioId($id); 

        if(empty($funcionario)){

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhum funcionario encontrado"]);
            return;

        }

        echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

    }

    public function AtualizarFuncionario($id){

        
        if($_SERVER["REQUEST_METHOD"] === "PATCH" ){

            parse_str(file_get_contents("php://input"), $dados);

            if(empty($dados)){

                http_response_code(404);
                echo json_encode(["erro" => "Nenhum dado foi enviado para a atualização..."]);
                return;

            }

            $resultado = $this->funcionarioModel->patchAtualizarFuncionario($dados, $id);

            if($resultado){
                http_response_code(200);
                echo json_encode(["Mensagem" => "Funcionario atualizado com sucesso!"]);
            }else{
                http_response_code(500);
                echo json_encode(["erro" => "Erro ao atualizar o funcionario | Erro do Servidor..."]);
            }

        }else{
            http_response_code(405);
            echo json_encode(["erro" => "Método não Permitido!"]);
        }

    }

    //________________________login alunos________________________________

    public function LoginAluno(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $email = $_POST['email_aluno'] ?? null;
            $senha = $_POST['senha_aluno'] ?? null;

            if((!$email || !$senha)){

                http_response_code(400);
                echo json_encode(["erro" => "Email e senha são obrigatórios!"]);
                return;
  
            }
     
            $aluno = $this->alunoModel->postLoginAluno($email, $senha);

            if($aluno){

                $dadosToken = [
                    'id' => $aluno['id_aluno'],
                    'email' => $aluno['email_aluno'],
                    'exp' =>  time() + 3600
                ];

                if(!class_exists('AuxiliarToken')){
                    echo 'AuxiliarToken não encontrado';
                }else{
                    $token = AuxiliarToken::gerar($dadosToken);

                    if($token){
                        http_response_code(200);
                        echo json_encode(["mensagem" => "Tudo Certo!", "Token" => $token, "id_aluno" => $aluno['id_aluno']], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                    }
                }

            }else{
                http_response_code(401);
                echo json_encode(["erro" => "Email ou senha invalidos ou aluno inativo!"]);    
            }
            
        }else{
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido!"]);
        }


    }

    public function ListarCursosMatriculados($id){

        if(!ctype_digit($id) || (int)$id <= 0){
            http_response_code(400);
            echo json_encode(["erro" => "ID inválido"]);
            return;
        }

        $headers = getallheaders();

        $authHeader =  $headers['Authorization'] ?? '';
        if(!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            http_response_code(401);
            echo json_encode(["erro" => "Token não fornecido ou malformado"]);
            return;
        }

        $payload = AuxiliarToken::validar($matches[1]);

        if(!$payload){
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            return;
        }
        
        $matriculas = $this->matriculaModel->getAlunoMatriculas($id);

        if (empty($matriculas)) {

            http_response_code(404);
            echo json_encode(["mensagem" => "Nenhuma matricula encontrada"]);
            return;

        }

        echo json_encode($matriculas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function cadastroAluno()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $nome = $_POST['nome_aluno'] ?? null;
            $cpf = $_POST['cpf_aluno'] ?? null;
            $rg = $_POST['rg_aluno'] ?? null;
            $dataNasc = $_POST['data_nasc_aluno'] ?? null;
            $telefone1 = $_POST['telefone1_aluno'] ?? null;
            $email = $_POST['email_aluno'] ?? null;
            $cepAluno = $_POST['endereco_aluno'] ?? null;
            $numeroAluno = $_POST['numero_aluno'] ?? null;
            $complementoAluno = $_POST['complemento_aluno'] ?? null;
            $bairroAluno = $_POST['bairro_aluno'] ?? null;
            $cidadeAluno = $_POST['cidade_aluno'] ?? null;
            $estadoAluno = $_POST['estado_aluno'] ?? null;
            $fotoAluno = $_POST['foto_aluno'] ?? null;
            $altAluno = $nome . ' foto' ?? null;
            $nomeResponsavel = $_POST['nome_mae'] ?? null;
            $telResponsavel = $_POST['telefone_mae'] ?? null;
            $emailResponsavel = $_POST['email_mae'] ?? null;
            $senha = $_POST['senha_aluno'] ?? null;

            if((!$email || !$senha)){

                http_response_code(400);
                echo json_encode(["erro" => "Email e senha são obrigatórios!"]);
                return;
  
            }
     
            $aluno = $this->alunoModel->postLoginAluno($email, $senha);

            if($aluno){

                http_response_code(200);
                echo json_encode(["mensagem" => "Tudo Certo!", "Aluno" => $aluno], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

            }else{
                http_response_code(401);
                echo json_encode(["erro" => "Email ou senha invalidos ou aluno inativo!"]);    
            }
            
        }else{
            http_response_code(405);
            echo json_encode(["erro" => "Método não permitido!"]);
        }

    }

    public function ListarNotasAluno($id){
        if(!ctype_digit($id) || (int)$id <= 0){
            http_response_code(400);
            echo json_encode(["erro" => "ID inválido."]);
            return;
        }

        $headers = getallheaders();

        $authHeader =  $headers['Authorization'] ?? '';
        if(!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            http_response_code(401);
            echo json_encode(["erro" => "Token não fornecido ou malformado"]);
            return;
        }
        $payload = AuxiliarToken::validar($matches[1]);

        if(!$payload){
            http_response_code(401);
            echo json_encode(["erro" => "Token inválido ou expirado"]);
            return;
        }

        $notas = $this->notasModel->getNotasAluno($id);

        if($notas){
            http_response_code(200);
            echo json_encode(["mensagem" => "Notas:" . $notas], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }else{
            http_response_code(404);
            echo json_encode(["erro" => "As notas do aluno não foram encontradas"], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }
}