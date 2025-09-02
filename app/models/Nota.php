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

    public function getNotasAluno($alunoId)
    {
        $sql = "SELECT * FROM tbl_nota n 
                INNER JOIN tbl_matricula m ON n.id_matricula = m.id_matricula 
                INNER JOIN tbl_aluno a ON m.id_aluno = a.id_aluno 
                WHERE a.id_aluno = :alunoId";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":alunoId", $alunoId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getNotasSigla($idA, $idS)
    {
        $sql = "
SELECT 
    sc.id_sigla, 
    sc.nome_sigla,
    c.nome_curso,
    c.modalidade_curso,
    sc.carga_horaria_sigla,
    n.tipo_nota,
    n.nota,
    n.data_nota,
    n.obs_nota,
    AVG(n.nota) OVER() AS media -- média geral da seleção
FROM tbl_nota n
INNER JOIN tbl_matricula m ON n.id_matricula = m.id_matricula
INNER JOIN tbl_sigla_curso sc ON m.id_sigla = sc.id_sigla
INNER JOIN tbl_aluno a ON m.id_aluno = a.id_aluno
INNER JOIN tbl_curso c ON sc.id_curso = c.id_curso
WHERE m.id_sigla = :ids AND m.id_aluno = :ida
ORDER BY n.data_nota
";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":ids", $idS);
        $stmt->bindValue(":ida", $idA);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMedia($ida)
    {
        $sql = "SELECT *, AVG(n.nota) AS media
                FROM tbl_nota n
                INNER JOIN tbl_matricula m ON n.id_matricula = m.id_matricula
                INNER JOIN tbl_sigla_curso sc ON m.id_sigla = sc.id_sigla
                INNER JOIN tbl_curso c ON sc.id_curso = c.id_curso
                INNER JOIN tbl_aluno a ON m.id_aluno = a.id_aluno
                WHERE m.id_aluno = :ida AND n.tipo_nota = 'Média'";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":ida", $ida);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMediaCurso($ida, $idc)
    {
        $sql = "SELECT tipo_nota, AVG(nota) AS media FROM tbl_nota n 
                INNER JOIN tbl_matricula m ON n.id_matricula = m.id_matricula 
                INNER JOIN tbl_sigla_curso sc ON m.id_sigla = sc.id_sigla 
                INNER JOIN tbl_curso c ON sc.id_curso = c.id_curso
                INNER JOIN tbl_aluno a ON m.id_aluno = a.id_aluno
                WHERE m.id_aluno = :idm AND c.id_curso = :idc 
                GROUP BY tipo_nota 
                ORDER BY tipo_nota ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":idm", $ida);
        $stmt->bindValue(":idc", $idc);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}    
