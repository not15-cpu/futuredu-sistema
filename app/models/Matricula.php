<?php

class Matricula extends Model
{
   public function getMatriculas()
   {

      $sql = "SELECT 
    
            a.nome_aluno, 
            s.nome_sigla,
            m.obs_matricula,
            m.data_matricula,
            m.status_matricula
    
    FROM 
       tbl_matricula AS m
    INNER JOIN 
       tbl_aluno AS a ON m.id_aluno = a.id_aluno
    INNER JOIN 
       tbl_sigla_curso AS s ON m.id_sigla = s.id_sigla
    ORDER BY 
       a.nome_aluno, s.nome_sigla ASC;";


      $stmt = $this->db->query($sql);

      return $stmt->fetchALL(PDO::FETCH_ASSOC);
   }

   public function getAlunoMatriculas($userId)
   {
      $sql = "SELECT 
               a.nome_aluno, 
               sc.nome_sigla,
               c.nome_curso,
               c.modalidade_curso,
               c.carga_horaria_curso,
               c.foto_curso,
               m.obs_matricula,
               m.data_matricula,
               m.status_matricula

            FROM tbl_matricula m 
              INNER JOIN tbl_aluno a ON
              m.id_aluno = a.id_aluno 
              INNER JOIN tbl_sigla_curso sc
              ON m.id_sigla = sc.id_sigla 
              INNER JOIN tbl_curso c 
              ON sc.id_curso = c.id_curso 
              WHERE m.id_aluno = :alunoId 
              ORDER BY nome_curso ASC";
      $stmt = $this->db->prepare($sql);
      $stmt->bindValue(":alunoId", $userId);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
