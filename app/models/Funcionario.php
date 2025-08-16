<?php

class Funcionario extends Model
{

    // Um método para listar todas as empresas
    public function getFuncionarios()
    {

        $sql = "SELECT 
                f.foto_funcionario, 
                f.nome_funcionario, 
                f.email_funcionario, 
                f.telefone1_funcionario, 
                e.fantasia_empresa, 
                f.cargo_funcionario 
            FROM 
                tbl_funcionario AS f
            INNER JOIN 
                tbl_empresa AS e
            ON 
                f.id_empresa = e.id_empresa
            ORDER BY 
                f.nome_funcionario, f.cargo_funcionario ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    // Listar funcionarios pelo cargo
    public function getFuncionariosCargo($cargo)
    {

        $sql = "SELECT nome_funcionario, email_funcionario, telefone1_funcionario, cargo_funcionario FROM tbl_funcionario 
        WHERE status_funcionario = 'ATIVO' AND cargo_funcionario LIKE :cargo ORDER BY nome_funcionario ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':cargo' => "$cargo%"]);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getFuncionarioId($id)
    {

        $sql = "SELECT * FROM tbl_funcionario WHERE status_funcionario = 'Ativo' AND id_funcionario = :cod_funcionario ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':cod_funcionario', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function patchAtualizarFuncionario($dados, $id)
    {
        $campos = [];

        foreach ($dados as $campo => $valor) {
            $campos[] = "$campo = :$campo";
        }

        // Adiciona a data de atualização
        $campos[] = "data_atualizacao_funcionario = NOW()";

        $sql = "UPDATE tbl_funcionario SET " . implode(", ", $campos) . " WHERE id_funcionario = :id_funcionario";

        $stmt = $this->db->prepare($sql);

        foreach ($dados as $campo => $valor) {
            $stmt->bindValue(":$campo", $valor);
        }

        $stmt->bindParam(":id_funcionario", $id);

        return $stmt->execute();
    }

    public function buscarFunc($email, $senha)
    {
        $sql = "SELECT * FROM tbl_funcionario 
        WHERE email_funcionario = :email 
        AND senha_funcionario = :senha 
        AND status_funcionario = 'ATIVO'";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
