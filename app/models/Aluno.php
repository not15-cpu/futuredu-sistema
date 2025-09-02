<?php

class Aluno extends Model
{

    public function getAlunos()
    {

        $sql = "SELECT * FROM tbl_aluno 
        WHERE status_aluno = 'Ativo' ORDER BY nome_aluno ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    // Método para listar o aluno pelo ID

    public function getAlunoId($id)
    {

        $sql = "SELECT * FROM tbl_aluno WHERE status_aluno = 'Ativo' AND id_aluno = :cod_aluno ";

        // serve para preparar a instrução SQL antes de executá-la

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':cod_aluno', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para atualizar o aluno

    // putch = atualizar todos os campos
    // patch = atualizar apenas alguns campos

    public function patchAtualizarAluno($dados, $id)
    {

        // preparar uma array que reconheça os campos

        $campos = [];

        // gerar um loop que carregue as informações dos campos

        foreach ($dados as $campo => $valor) {

            $campos[] = "$campo = :$campo";
        }

        // Query do UPDATE
        $sql = "UPDATE tbl_aluno SET " . implode(", ", $campos) . ", data_atualizacao_aluno = NOW() WHERE id_aluno = :id_aluno";

        $stmt = $this->db->prepare($sql);

        // parãmetros que estão vindo da array "campos"

        foreach ($dados as $campo => $valor) {

            $stmt->bindValue(":$campo", $valor);
        }

        $stmt->bindParam(":id_aluno", $id);

        return $stmt->execute();
    }

    // Método para login do aluno

    public function postLoginAluno($email, $senha)
    {

        $sql = "SELECT * FROM tbl_aluno WHERE email_aluno = :email_aluno  AND status_aluno = 'ATIVO' ORDER BY id_aluno DESC LIMIT 1"; //caso tenha dois emails cadastrados, serve para travar e pegar o primeiro login 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email_aluno', $email);
        $stmt->execute();

        $user =  $stmt->fetch(PDO::FETCH_ASSOC);

        if(password_verify($senha, $user['senha_aluno'])){
            return $user;
        }
    }

    public function postLoginProfessor($email, $senha)
    {

        $sql = "SELECT * FROM tbl_aluno where email_aluno = :email_aluno 
        AND senha_aluno = :senha_aluno and status_aluno = 'ATIVO' LIMIT 1 ORDER BY id_aluno DESC"; //caso tenha dois emails cadastrados, serve para travar e pegar o primeiro login 
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email_aluno', $email);
        $stmt->bindParam(':senha_aluno', $senha);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function postCadastroAluno(
        $nome, $cpf, $rg, $dataNasc, $email, $senha,
        $tel1, $tel2, $cep, $endereco, $numero, $complemento,
        $bairro, $cidade, $estado, $foto, $alt,
        $nomeResponsavel, $telResponsavel, $emailResponsavel
    ) {
        $sql = "INSERT INTO tbl_aluno(
                    nome_aluno, cpf_aluno, rg_aluno, 
                    data_nasc_aluno, email_aluno, senha_aluno,
                    telefone1_aluno, telefone2_aluno, cep_aluno, endereco_aluno,
                    numero_aluno, complemento_aluno, bairro_aluno,
                    cidade_aluno, estado_aluno, foto_aluno, alt_aluno,
                    nome_responsavel, telefone_responsavel,
                    email_responsavel, data_criacao_aluno
                )
                VALUES(
                    :nome, :cpf, :rg, :dataNasc, :email, :hash,
                    :tel1, :tel2, :cep, :endereco, :numero, :complemento,
                    :bairro, :cidade, :estado, 'sem_imagem.png', :alt,
                    :nomeResponsavel, :telefoneResponsavel, :emailResponsavel, NOW()
                )";
    
        $hash = password_hash($senha, PASSWORD_ARGON2ID);
        $stmt = $this->db->prepare($sql);
    
        $stmt->bindValue(":nome", $nome);
        $stmt->bindValue(":cpf", $cpf);
        $stmt->bindValue(":rg", $rg);
        $stmt->bindValue(":dataNasc", $dataNasc);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":hash", $hash);
        $stmt->bindValue(":tel1", $tel1);
        $stmt->bindValue(":tel2", $tel2);
        $stmt->bindValue(":cep", $cep);
        $stmt->bindValue(":endereco", $endereco);
        $stmt->bindValue(":numero", $numero);
        $stmt->bindValue(":complemento", $complemento);
        $stmt->bindValue(":bairro", $bairro);
        $stmt->bindValue(":cidade", $cidade);
        $stmt->bindValue(":estado", $estado);
        $stmt->bindValue(":alt", $alt);
        $stmt->bindValue(":nomeResponsavel", $nomeResponsavel);
        $stmt->bindValue(":telefoneResponsavel", $telResponsavel);
        $stmt->bindValue(":emailResponsavel", $emailResponsavel);
    
        $stmt->execute();
        return $stmt;
    }
    

    public function getAlunoEmail($email)
    {
        $sql = "SELECT id_aluno, nome_aluno, email_aluno FROM tbl_aluno WHERE email_aluno = :e LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":e", $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function salvarTokenReset($id, $hash, $exp)
    {
        $sql = "UPDATE tbl_aluno SET reset_token_hash = :h,
            reset_token_expires = :e WHERE id_aluno = :ia";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":h", $hash);
        $stmt->bindValue(":e", $exp);
        $stmt->bindValue(":ia", $id, PDO::PARAM_INT);

        $success = $stmt->execute();
        return $success; // true se atualizou, false caso contrário
    }


    public function getAlunoHash($token)
    {
        // Aplica o mesmo hash usado ao salvar

        $sql = "SELECT id_aluno, reset_token_expires 
            FROM tbl_aluno 
            WHERE reset_token_hash = :h LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":h", $token);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function limparReset($id)
    {
        $sql = "UPDATE tbl_aluno SET
                reset_token_hash = NULL,
                reset_token_expires = NULL
                WHERE id_aluno = :ia";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":ia", $id);
        $stmt->execute();
        return $stmt;
    }

    public function atualizarSenha($id, $senha)
    {
        $hash = password_hash($senha, PASSWORD_ARGON2ID);
        $sql = "UPDATE tbl_aluno SET senha_aluno = :s,
                data_atualizacao_aluno = NOW()
                WHERE id_aluno = :ia";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":s", $hash);
        $stmt->bindValue(":ia", $id);
        $stmt->execute();
        return $stmt;
    }

    public function atualizarFoto($id, $foto)
    {
        $sql = "UPDATE tbl_aluno SET foto_aluno = :f,
                data_atualizacao_aluno = NOW()
                WHERE id_aluno = :i";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":f", $foto);
        $stmt->bindValue(":i", $id);
        $stmt->execute();
        return $stmt;
    }
}
