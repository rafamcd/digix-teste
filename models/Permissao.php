<?php

class Permissao extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Pega as permissões do usuário
    public function getPermissao($id_usuario) {
        $array = array();
        $sql = "SELECT usuario.user nome, ".
               "usuario.imagem, ".
               "menu.id as id_menu, ".
               "menu.descricao as desc1, ".
               "menu.ordem, ".
               "menu.url as url1, ".
               "menu.class_bootstrap, ".
               "usuario.grupo_usuario_id, ".
               "usuario.id_funcionario, ".
               "usuario.id_cliente ".
               "FROM usuario ".
               "LEFT JOIN permissao ON permissao.id_grupousuarios = usuario.grupo_usuario_id ".
               "LEFT JOIN menu on permissao.id_menu = menu.id ".
               "where usuario.id = '$id_usuario' and menu.descricao is not null ".               
               "ORDER BY ordem";  
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
        
            $array = $sql->fetchAll();
            $array2 = array();
            
            foreach($array as $menuchave => $menu) {
                
                $sql2 = "SELECT descricao, url FROM sub_menu WHERE id_menu = '".($menu['id_menu'])."'";                
                $sql2 = $this->db->query($sql2);
                   
                   if ($sql2->rowCount() > 0) {
                      
                       $array2 = $sql2->fetchAll();
                       
                       foreach($array2 as $chave => $valor) {                        
                            $array[$menuchave]['submenu'][] = $valor;
                       }
                   }
               } 
            }
        return $array;                
        }
        
        //Verifica se o usuário logado tem permissão de acessar o controller
        public function verificaController($viewName,$id_usuario) {
            $grupo = -1;
            $sql = "SELECT grupo_usuario_id FROM usuario WHERE id = '$id_usuario'";
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0) {
                $sql = $sql->fetch();
                $grupo = $sql['grupo_usuario_id'];
            }
            
            $sql = "SELECT permissao.id FROM permissao ".
                   "LEFT JOIN menu on permissao.id_menu = menu.id ".                   
                   "LEFT JOIN grupo_usuarios on permissao.id_grupousuarios = grupo_usuarios.id ".
                   "WHERE menu.url = '$viewName' and grupo_usuarios.id = '$grupo'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }
        
        //Busca as permissões do Grupo de Usuários
        public function getPermissaoDoGrupo($id_grupo) {
            $array = array();
            $sql = "SELECT permissao.id_menu, ".
                   "permissao.id_grupousuarios, ".
                   "menu.descricao, menu.ordem FROM menu JOIN permissao on permissao.id_menu = menu.id ".
                   "WHERE menu.tipo = 2 and permissao.id_grupousuarios = '$id_grupo' ".
                   "union ".
                   "SELECT menu.id,'', menu.descricao, menu.ordem FROM menu WHERE menu.tipo = 2 AND ".
                   "menu.id not in (SELECT permissao.id_menu FROM permissao WHERE permissao.id_grupousuarios = '$id_grupo') ".
                   "ORDER BY ordem ";            
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
            return $array;
        }
        
        //Busca informação do nome do Grupo de Usuários
        public function getNomeGrupo($id_grupo) {
            $array = array();
            $sql = "SELECT descricao FROM grupo_usuarios WHERE id = '$id_grupo'";
            $sql = $this->db->query($sql);
            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
            }
            return $array;
        }
        
        //Inserir nova permissão
        public function inserePermissao($id, $id_grupo) {
            $id = addslashes($id);
            $id_grupo = addslashes($id_grupo);
            
            $sql = $this->db->prepare("DELETE FROM permissao WHERE id_menu = :id and id_grupousuarios = :id_grupo");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_grupo", $id_grupo);
            $sql->execute();
            $sql = $this->db->prepare("INSERT INTO permissao SET id_menu = :id, id_grupousuarios = :id_grupo");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_grupo", $id_grupo);
            $sql->execute();            
        }
        
        //Deletar permissão        
        public function deletePermissao($id, $id_grupo) {
            $id = addslashes($id);
            $id_grupo = addslashes($id_grupo);
            
            $sql = $this->db->prepare("DELETE FROM permissao WHERE id_menu = :id and id_grupousuarios = :id_grupo");            
            $sql->bindValue(":id", $id);
            $sql->bindValue(":id_grupo", $id_grupo);
            $sql->execute();            
        }
        
    
}

