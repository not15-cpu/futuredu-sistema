<?php

class Nota extends Model
{

    public function getNotas()
    {

        $sql = "SELECT 
    a.nome_aluno, 
    f.nome_funcionario, 
    n.nota, 
    n.obs_nota, 
    n.data_nota
FROM 
    tbl_matricula AS m
INNER JOIN 
    tbl_aluno AS a ON m.id_aluno = a.id_aluno
INNER JOIN 
    tbl_sigla_curso AS s ON m.id_sigla = s.id_sigla
INNER JOIN 
    tbl_funcionario AS f ON s.id_funcionario = f.id_funcionario
LEFT JOIN 
    tbl_nota AS n ON m.id_matricula = n.id_matricula
ORDER BY 
    a.nome_aluno ASC;";

        $stmt = $this->db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getNotasAluno($alunoId){
        $sql = "SELECT * FROM tbl_nota n INNER JOIN tbl_matricula m ON n.id_matricula = m.id_matricula INNER JOIN tbl_aluno a ON m.id_aluno = a.id_aluno WHERE a.id_aluno = :alunoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":alunoId", $alunoId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
