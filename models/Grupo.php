<?php

class Grupo extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Busca os grupos de usuário
    public function getGrupos() {
        $array = array();
        $sql = "SELECT * FROM grupo_usuarios ORDER BY id";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        return $array;
    }   
    
    //Busca os dados de um determinado grupo de usuário
    public function getGrupo($id) {
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM grupo_usuarios WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }   
    
    //Adiciona Grupo de Usuário
    public function addGrupo($descricao) {
        if (!empty($descricao)) {
            $descricao = utf8_decode(addslashes($descricao));
            $sql = $this->db->prepare("INSERT INTO grupo_usuarios SET descricao=:descricao");
            $sql->bindValue(":descricao", $descricao);
            $sql->execute();
        }
    }
    
    //Edita grupo de usuário
    public function editGrupo($descricao, $id) {
        if (!empty($descricao) && !empty($id)) {
            $descricao = utf8_decode(addslashes($descricao));
            $id = addslashes($id);
            
            $sql = $this->db->prepare("UPDATE grupo_usuarios SET descricao=:descricao WHERE id=:id");
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":id", $id);
            $sql->execute();
        }
    }
    
    //Remove grupo de usuário
    public function removeGrupo($id) {
        $id = addslashes($id);
        
        $sql = $this->db->prepare("DELETE FROM usuario WHERE grupo_usuario_id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $sql = $this->db->prepare("DELETE FROM permissao WHERE id_grupousuarios = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        
        $sql = $this->db->prepare("DELETE FROM grupo_usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
}

