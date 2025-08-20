<?php

class Professor extends Model {
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
            WHERE 
                f.cargo_funcionario LIKE 'Professor%'
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
    
}