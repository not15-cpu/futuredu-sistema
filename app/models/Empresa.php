<?php
 
class Empresa extends Model{
 
    // Um método para listar todas as empresas
    public function getEmpresas(){
 
        $sql = "SELECT fantasia_empresa, tipo_empresa, email_empresa, telefone1_empresa, cep_empresa
        FROM tbl_empresa WHERE status_empresa = 'Ativo' ORDER BY fantasia_empresa DESC";
 
        $stmt = $this->db->query($sql);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
 
    }
}