<?php

class Projeto extends Model
{

    // Método para inserir no projeto -- A fazer 
    // get serve para listar
    // post serve para inserir

    public function postNovoProjeto($titulo, $descricao, $cod_professor, $cod_sigla, $data_inicio, $data_entrega, $status_projeto, $url_projeto)
    {
        //FUNÇÂO PARA VERIFICAR SE JA EXISTE O PROJETO COM O MESMO TITULO

        $check_sql = "SELECT COUNT(*) FROM tbl_projeto WHERE titulo_projeto = :titulo";
        $check_stmt = $this->db->prepare($check_sql);
        $check_stmt->bindParam(':titulo', $titulo);
        $check_stmt->execute();
        $existe = $check_stmt->fetchColumn();

        if ($existe > 0) {

            return [
                'success' => false,
                'message' => 'Já existe projeto com o titulo:'
            ];
            
        } else {

            //INSERIR NOVO PROJETO
            $sql = "INSERT INTO tbl_projeto(
            titulo_projeto,
            descricao_projeto,
            id_professor,
            id_sigla,
            data_criacao_projeto,
            data_entrega_projeto,
            status_projeto,
            url_projeto
            )VALUES(
            :titulo,
            :descricao,
            :cod_professor,
            :cod_sigla,
            :data_inicio,
            :data_entrega,
            :status_projeto,
            :url_projeto
            )";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':cod_professor', $cod_professor);
            $stmt->bindParam(':cod_sigla', $cod_sigla);
            $stmt->bindParam(':data_inicio', $data_inicio);
            $stmt->bindParam(':data_entrega', $data_entrega);
            $stmt->bindParam(':status_projeto', $status_projeto);
            $stmt->bindParam(':url_projeto', $url_projeto);

            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'id_projeto' => $this->db->lastInsertId()
                ];
            } else {
                return [
                    'success' => false,
                    'erro' => $stmt->errorInfo()
                ];
            }
        }



        // Método para inserir a participação do aluno no projeto -- A fazer 


    }

    public function postParticipacaoProjeto($cod_projeto, $nome_aluno, $nota_participacao, $observacao)
    {

    $aluno_sql = "SELECT id_aluno FROM tbl_aluno WHERE nome_aluno = :nome_aluno";
    $aluno_stmt = $this->db->prepare($aluno_sql);
    $aluno_stmt->bindParam(':nome_aluno', $nome_aluno);
    $aluno_stmt->execute();
    $cod_aluno = $aluno_stmt->fetchColumn();

        
        $sql = "INSERT INTO tbl_participacao_projeto(
            id_projeto,
            id_aluno,
            nota_participacao_projeto,
            obs_participacao_projeto
            )VALUES(
            :id_projeto,
            :id_aluno,
            :nota_participacao_projeto,
            :obs_participacao_projeto
            )";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_projeto', $cod_projeto);
            $stmt->bindParam(':id_aluno', $cod_aluno);
            $stmt->bindParam(':nota_participacao_projeto', $nota_participacao);
            $stmt->bindParam(':obs_participacao_projeto', $observacao);


            if ($stmt->execute()) {
                return [
                    'success' => true,
                    'id_aluno' => $cod_aluno,
                    'id_participacao_projeto' => $this->db->lastInsertId()
                ];
            } else {
                return [
                    'success' => false,
                    'erro' => $stmt->errorInfo()
                ];
            }
        }
        
        public function ListarProjetosIncritos($id){
            $sql = "SELECT * FROM tbl_participacao_projeto pp INNER JOIN tbl_projeto p ON pp.id_projeto = p.id_projeto 
                    INNER JOIN tbl_professor pf ON p.id_professor = pf.id_professor INNER JOIN tbl_funcionario f ON pf.id_funcionario = f.id_funcionario WHERE pp.id_aluno = :alunoId";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":alunoId", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
}