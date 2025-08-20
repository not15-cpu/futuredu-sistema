<?php


class Instrutores extends Model
{
    public function getInstructors()
    {
        $sql = "SELECT * FROM tbl_professor p
                INNER JOIN tbl_funcionario f
                ON p.id_funcionario = f.id_funcionario WHERE status_funcionario LIKE 'A%'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarFunc($email, $senha){
        $sql = "SELECT * FROM tbl_funcionario WHERE email_funcionario = :email AND senha_funcionario = :senha AND status_funcionario LIKE 'A%'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
