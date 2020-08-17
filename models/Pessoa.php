<?php

class Pessoa extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Busca todos os dados de uma determinada pessoa
    public function getPessoa($id) {
        $array = array();
        
        $sql = "SELECT * FROM pessoa WHERE id='$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //Busca todos os dados das pessoas que serão exibidas na página atual
    public function getPessoas($offset, $limit) {
            $array = array();
            
            $sql = "SELECT * FROM pessoa order by nome LIMIT $offset, $limit";
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
            
            return $array;
        }
    
    //Inserção de Pessoa
    public function inserir($nome, $fone, $data_nascimento, $idade, $email, $md5imagem, $renda, $tipo) {
        $sql = "INSERT INTO pessoa SET nome=:nome, fone=:fone, data_nascimento=:data_nascimento, idade = :idade, email = :email, imagem=:md5imagem, renda = :renda, tipo = :tipo";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":data_nascimento", $data_nascimento);
        $sql->bindValue(":idade", $idade);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":md5imagem", $md5imagem);
        $sql->bindValue(":renda", $renda);
        $sql->bindValue(":tipo", $tipo);
        
        $sql->execute();
    }
    
    //Remoção de pessoa
    public function remover($id) {                 
        $sql = $this->db->prepare("DELETE FROM familiapessoas WHERE id_pessoa=:id_pessoa");
        $sql->bindValue(":id_pessoa", $id);
        $sql = $this->db->prepare("DELETE FROM pessoa WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    //Verifica a quantidade de pessoas cadastradas para montar a paginação
    public function getTotalPessoasFiltro($filtros) {
		$filtroString = array('1=1');                

		$sql = "SELECT COUNT(*) as c FROM pessoa WHERE ".implode(' AND ',$filtroString);
                $sql = $this->db->query($sql);
                
                $row = $sql->fetch();

		return $row['c'];
	}
    
    //Busca todos os dados das pessoas que serão exibidas na página atual
    public function getPessoasFiltro($p, $qtd_por_pagina, $filtros) {
		$array = array();
                $filtroString = array('1=1');                

		$offset = ($p - 1) * $qtd_por_pagina;

		$sql = "SELECT * FROM pessoa WHERE ".implode(' AND ',$filtroString)." ORDER BY nome LIMIT $offset, $qtd_por_pagina";
                $sql = $this->db->query($sql);
                
                if ($sql->rowCount() > 0) {
                    $array = $sql->fetchAll();
                }

		return $array;
	}
        
    //Atualização de pessoa
    public function updatePessoa($id, $nome, $fone, $data_nascimento, $idade, $email, $renda) {
        $sql = "UPDATE pessoa SET nome=:nome, fone=:fone, data_nascimento=:data_nascimento, idade = :idade, email = :email, renda = :renda WHERE id=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":fone", $fone);
        $sql->bindValue(":data_nascimento", $data_nascimento);
        $sql->bindValue(":idade", $idade);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":renda", $renda);        
        $sql->bindValue(":id", $id);
        $sql->execute();        
    }
    
    //Atualização da imagem da pessoa
    public function updateImagemPessoa($id, $imagem) {
        $sql = "UPDATE pessoa SET imagem=:imagem WHERE id=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":imagem", $imagem);
        $sql->bindValue(":id", $id);
        $sql->execute(); 
    }
    
    //Apagar a imagem anterior da pessoa antes de inserir a nova
    public function apagaImagemAnterior($id) {        
        $array = array();
        $sql = "SELECT imagem FROM pessoa WHERE id='$id' and imagem != 'noimage.jpg'";
        $img = '';
        $sql = $this->db->query($sql);
        
        if ($sql->rowCount() > 0) {
            
            $array = $sql->fetch();            
            $img = $array['imagem'];
            $endereco = 'assets/images/pessoas/'.$img;
            unlink($endereco);
        }
    }
    
    //Busca todas pessoas ordenadas por nome
    public function getPessoasTodos() {
        $array = array();
        $sql = "SELECT * FROM pessoa ORDER BY nome";
        $sql = $this->db->query($sql);
                
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;        
    }
    
    //Busca todas pessoas que não estão vinculadas dentro de nenhuma família
    public function getPessoasSemFamilia() {
        $array = array();
        $sql = "SELECT * FROM pessoa WHERE possui_familia = 0 ORDER BY nome";
        $sql = $this->db->query($sql);
                
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;        
    }
    
    //Busca renda de uma determinada pessoa
    public function getRendaPessoa($id) {
        $renda = 0;
        $sql = "SELECT renda FROM pessoa WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
                
        if ($sql->rowCount() > 0) {
            $renda = $sql->fetch();            
        }

        return $renda['renda'];   
    }
    
    //Busca idade de uma determinada pessoa
    public function VerificaIdadePessoa($id) {
        $idade = 0;
        $sql = "SELECT idade FROM pessoa WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id", $id);
        $sql->execute();
                
        if ($sql->rowCount() > 0) {
            $idade = $sql->fetch();            
        }

        return $idade['idade'];   
    }
    
    //Atualizar tipo (pretendente, cônjugue ou dependente) da pessoa
    public function atualizaTipo($id,$tipo) {
        $sql = "UPDATE pessoa SET tipo = :tipo, possui_familia = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    //Quando uma família é excluída, as pessoas que pertenciam a esta família possui suas informações familiares zeradas
    public function atualizaInformacoes($id) {        
        $sql = "UPDATE pessoa SET tipo = 0, possui_familia = 0 WHERE id = :id";
        $sql = $this->db->prepare($sql);                
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    
    
}

