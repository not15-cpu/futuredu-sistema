<?php

class Curso extends Model
{

    // Um método para pegar 6 cursos de forma aleatoria no banco de dados
    public function getCursoRand($limite = 6)
    {

        $sql = "SELECT * FROM tbl_curso ORDER BY RAND() LIMIT :qtd";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':qtd', (int) $limite, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getTodosCurso()
    {

        $sql = "SELECT * FROM tbl_curso WHERE status_curso = 'Ativo' OR status_curso = 'Pendente' ORDER BY status_curso ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }


    public function getCursosNome($nomeCurso)
    {

        $sql = "SELECT nome_curso, descricao_curso, nivel_curso, modalidade_curso, valor_curso 
        FROM tbl_curso WHERE status_curso = 'Ativo' AND nome_curso LIKE :nome ORDER BY nome_curso ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nome', "nome_curso"]);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getCursosNivel($nivelCurso)
    {

        $sql = "SELECT nome_curso, descricao_curso, nivel_curso, modalidade_curso, valor_curso 
        FROM tbl_curso WHERE status_curso = 'Ativo' AND nome_curso LIKE :nivel AND ORDER BY nome_curso ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nivel', "nivel_curso%"]);
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    //Método para adicionar um novo curso

    public function addCurso($dados)
    {

        $sql = "INSERT INTO tbl_curso(
            nome_curso, 
            nivel_curso, 
            carga_horaria_curso, 
            descricao_curso, 
            modalidade_curso, 
            area_curso, 
            pre_requisito_curso, 
            valor_curso, 
            alt_curso, 
            data_criacao_curso, 
            data_atualizacao_curso, 
            status_curso
            
        ) VALUES(
            :nome_curso, 
            :nivel_curso, 
            :carga_horaria_curso, 
            :descricao_curso, 
            :modalidade_curso, 
            :area_curso, 
            :pre_requisito_curso, 
            :valor_curso, 
            :alt_curso, 
            :data_criacao_curso, 
            :data_atualizacao_curso, 
            :status_curso
        )";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(':nome_curso', $dados['nome_curso']);
        $stmt->bindValue(':nivel_curso', $dados['nivel_curso']);
        $stmt->bindValue(':carga_horaria_curso', $dados['carga_horaria_curso']);
        $stmt->bindValue(':descricao_curso', $dados['descricao_curso']);
        $stmt->bindValue(':modalidade_curso', $dados['modalidade_curso']);
        $stmt->bindValue(':area_curso', $dados['area_curso']);
        $stmt->bindValue(':pre_requisito_curso', $dados['pre_requisito_curso']);
        $stmt->bindValue(':valor_curso', $dados['valor_curso']);
        $stmt->bindValue(':alt_curso', $dados['nome_curso']);
        $stmt->bindValue(':data_criacao_curso', $dados['data_criacao_curso']);
        $stmt->bindValue(':data_atualizacao_curso', $dados['data_atualizacao_curso']);
        $stmt->bindValue(':status_curso', $dados['status_curso']);

        $stmt->execute();

        return $this->db->lastInsertId();
    }

    public function atualizarFoto($id, $foto)
    {

        $sql  = "UPDATE tbl_curso SET foto_curso = :foto WHERE id_curso = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto', $foto);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
    //Método para carregar os dados do curso

    public function carregarDados($id)
    {

        $sql = "SELECT * FROM tbl_curso WHERE id_curso = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarCurso($dados)
    {

        $sql = "UPDATE tbl_curso SET
        nome_curso             = :nome_curso,             
        nivel_curso            = :nivel_curso,            
        carga_horaria_curso    = :carga_horaria_curso,    
        descricao_curso        = :descricao_curso,        
        modalidade_curso       = :modalidade_curso,       
        area_curso             = :area_curso,             
        pre_requisito_curso    = :pre_requisito_curso,    
        valor_curso            = :valor_curso,       
        foto_curso             = :arquivo,
        alt_curso              = :alt_curso,              
        data_criacao_curso     = :data_criacao_curso,     
        data_atualizacao_curso = :data_atualizacao_curso, 
        status_curso           = :status_curso
    WHERE id_curso            = :id";


        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome_curso', $dados['nome_curso']);
        $stmt->bindValue(':nivel_curso', $dados['nivel_curso']);
        $stmt->bindValue(':carga_horaria_curso', $dados['carga_horaria_curso']);
        $stmt->bindValue(':descricao_curso', $dados['descricao_curso']);
        $stmt->bindValue(':modalidade_curso', $dados['modalidade_curso']);
        $stmt->bindValue(':area_curso', $dados['area_curso']);
        $stmt->bindValue(':pre_requisito_curso', $dados['pre_requisito_curso']);
        $stmt->bindValue(':valor_curso', $dados['valor_curso']);
        $stmt->bindValue(':arquivo', $dados['foto_curso']);
        $stmt->bindValue(':alt_curso', $dados['nome_curso']);
        $stmt->bindValue(':data_criacao_curso', $dados['data_criacao_curso']);
        $stmt->bindValue(':data_atualizacao_curso', $dados['data_atualizacao_curso']);
        $stmt->bindValue(':status_curso', $dados['status_curso']);
        $stmt->bindValue(':id', $dados['id_curso']);

        $resultado = $stmt->execute();

        return $resultado;
    }

    public function getTodosCursoDash()
    {

        $sql = "SELECT * FROM tbl_curso WHERE status_curso != 'Desativar' ORDER BY nome_curso ASC";

        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    // Metodo para atualizar os status do curso
    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_curso SET status_curso = :status_curso WHERE id_curso = :id_curso";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_curso', $status);
        $stmt->bindValue(':id_curso', $id);
        return $stmt->execute();
    }

    public function desativarCurso($id)
    {

        $sql = "UPDATE tbl_curso SET status_curso = :status_curso WHERE id_curso = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status_curso', 'Desativar');
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
