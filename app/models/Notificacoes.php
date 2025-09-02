<?php




class Notificacoes extends Model{


    public function getAlunoNotifcs($alunoId)
    {
        $sql = "SELECT * FROM tbl_notificacoes WHERE id_aluno = :i";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":i", $alunoId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}