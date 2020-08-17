<?php

class Usuario extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Verifica se o usuário está logado
    public function isLogged() {
        if (isset($_SESSION['lginteco']) && !empty($_SESSION['lginteco'])) {
            return true;
        } else {
            return false;
        }
    }
    
    //Validação de Login (usuário e senha)
    public function isExiste($usuario, $senha) {
        $sql = $this->db->prepare("SELECT * FROM usuario WHERE user = :usuario and senha = md5(:senha)");        
        $sql->bindValue(":usuario", $usuario);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    //Pegar dados de um determinado usuário
    public function getUsuario($id) {
        $array = array();
        
        $sql = $this->db->prepare("SELECT * FROM usuario WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //Pegar id do usuário
    public function getId($usuario) {
        $id = 0;
        $sql = $this->db->prepare("SELECT id FROM usuario WHERE user = :usuario");    
        $sql->bindValue(":usuario", $usuario);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $id = $sql['id'];
        }        
        return $id;
    }
    
    //Pegar Grupos de usuários cadastrados
    public function getGrupos() {
        $array = array();
        $sql = "SELECT * FROM grupo_usuarios order by descricao";
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        } 
        return $array;
    }
    
    //Buscar total de usuários para montagem de paginação
    public function getTotalUsuariosFiltro($filtros) {
		$filtroString = array('1=1');                

		if ($filtros['grupos'] > '0') {
                    $grupos = $filtros['grupos'];
                    $filtroString[] = "usuario.grupo_usuario_id = '$grupos'";
		}

		$sql = "SELECT COUNT(*) as c FROM usuario WHERE ".implode(' AND ',$filtroString);
                $sql = $this->db->query($sql);
                
                $row = $sql->fetch();

		return $row['c'];
	}
    
    //Buscar usuários que serão exibidos na página atual
    public function getUsuariosFiltro($p, $qtd_por_pagina, $filtros) {
		$array = array();
                $filtroString = array('1=1');                

		if (!empty($filtros['grupos'])) {
                    $grupos = $filtros['grupos'];                    
                    $filtroString[] = "usuario.grupo_usuario_id = '$grupos'";                        
		}
                
                $offset = ($p - 1) * $qtd_por_pagina;

		$sql = "SELECT usuario.*, (select nome from cliente where cliente.id = usuario.id_cliente) as nomec, (select nome from funcionario where funcionario.id = usuario.id_funcionario) as nomef  FROM usuario WHERE ".implode(' AND ',$filtroString)." ORDER BY user LIMIT $offset, $qtd_por_pagina";
                $sql = $this->db->query($sql);
                
                if ($sql->rowCount() > 0) {
                    $array = $sql->fetchAll();
                }

		return $array;
	}
    //Inserir usuário
    public function inserir($user, $id_funcionario, $id_cliente, $senha, $grupo_usuario_id, $md5imagem) {
        $sql = $this->db->prepare("INSERT INTO usuario SET user=:user, id_funcionario = :id_funcionario, id_cliente = :id_cliente, senha = :senha, grupo_usuario_id = :grupo_usuario_id, imagem=:md5imagem");
        $sql->bindValue(":user", $user);
        $sql->bindValue(":id_funcionario", $id_funcionario);
        $sql->bindValue(":id_cliente", $id_cliente);
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":grupo_usuario_id", $grupo_usuario_id);
        $sql->bindValue(":md5imagem", $md5imagem);
        $sql->execute();        
    }
    //Atualizar usuário
    public function updateUsuario($id, $user, $id_funcionario, $id_cliente, $grupo_usuario_id) {
        $sql = $this->db->prepare("UPDATE usuario SET user=:user, id_funcionario =:id_funcionario, id_cliente = :id_cliente, grupo_usuario_id = :grupo_usuario_id WHERE id = :id");
        $sql->bindValue(":user", $user);
        $sql->bindValue(":id_funcionario", $id_funcionario);
        $sql->bindValue(":id_cliente", $id_cliente);        
        $sql->bindValue(":grupo_usuario_id", $grupo_usuario_id);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }    
    //Atualizar senha de usuário
     public function updateSenha($id, $senha) {
        $sql = $this->db->prepare("UPDATE usuario SET senha=:senha WHERE id = :id");
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    //Atualizar imagem de usuário
    public function updateImagemUsuario($id, $imagem) {
        $sql = $this->db->prepare("UPDATE usuario SET imagem=:imagem WHERE id=:id");
        $sql->bindValue(":imagem", $imagem);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    //Apagar imagem anterior do usuário
    public function apagaImagemAnterior($id) {        
        if ($_SESSION['user'] == 'roseli' or $_SESSION['user'] == 'rubens' or $_SESSION['user'] == 'rafamcd') {
        $array = array();
        $sql = $this->db->prepare("SELECT imagem FROM usuario WHERE id=:id and imagem != 'noimage.jpg'");
        $sql->bindValue(":id", $id);
        $img = '';
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            
            $array = $sql->fetch();            
            $img = $array['imagem'];
            $endereco = 'assets/images/usuarios/'.$img;
            unlink($endereco);
            $myfile = fopen("log_usuario.txt", "a");
            fwrite($myfile, 'Imagem usuario, ID: '.$id.' - IP: '.$_SERVER['REMOTE_ADDR'].' - Data e Hora: '.date('d/m/Y H:i:s')."\r\n");
            fclose($myfile);           
            
        }
        }
    }
    //Remover usuário
    public function remover($id) {     
        if ($_SESSION['user'] == 'roseli' or $_SESSION['user'] == 'rubens' or $_SESSION['user'] == 'rafamcd') {
        $sql = $this->db->prepare("DELETE FROM usuario WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $myfile = fopen("log_usuario.txt", "a");
        fwrite($myfile, 'Usuario apagado, ID: '.$id.' - IP: '.$_SERVER['REMOTE_ADDR'].' - Data e Hora: '.date('d/m/Y H:i:s')."\r\n");
        fclose($myfile);        
        }
    }
    //Pegar nome de um determinado usuário
    public function getNomeUsuario($id) {
        $nome = '';
        $sql = "SELECT user from usuario where usuario.id = :id ";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();        
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $nome = $sql['user'];
        }
        return $nome;
    }    
    //Pegar tipo de usuário
    public function getTipoUsuario($id) {
        $tipo = 0;
        $sql = $this->db->prepare("SELECT grupo_usuario_id from usuario where usuario.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute(); 
        
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $tipo = $sql['grupo_usuario_id'];
        }
        return $tipo;
    }
    //Pegar imagem de um determinado usuário
    public function getImagemUsuario($id) {
        $imagem = '';
        $sql = $this->db->prepare("SELECT imagem from usuario where usuario.id = :id");               
        $sql->bindValue(":id", $id);
        $sql->execute(); 
        
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $imagem = $sql['imagem'];
        }
        return $imagem;
    }
    
}

