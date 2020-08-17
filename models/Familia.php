<?php

class Familia extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Busca todos os dados de uma família
    public function getFamilia($id) {
        $array = array();
        
        $sql = "SELECT familia.*, pessoa.nome FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE id='$id' and familiaContemplada = 0 and tipo = 0";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //Busca todas as famílias que não foram contempladas e que serão exibidas na página atual
    public function getFamilias($offset, $limit) {
            $array = array();
            
             $sql = "SELECT familia.*, pessoa.nome FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE familiaContemplada = 0 and tipo = 0 "
                . "ORDER BY pontuacaoTotal DESC LIMIT $offset, $limit";
            
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
            
            return $array;
        }
     
    //Busca todas as famílias que não foram contempladas
    public function getFamiliasTodas() {
            $array = array();
            
             $sql = "SELECT familia.*, pessoa.* FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE familiaContemplada = 0 ";                
            
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
            
            return $array;
        }
    
    //Inserção da família
    public function inserir($possui_casa, $rendaTotal, $qtd_dependentes) {
        $sql = "INSERT INTO familia SET possuiCasa=:possui_casa, rendaTotal=:rendaTotal, qtd_dependentes=:qtd_dependentes";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":possui_casa", $possui_casa);
        $sql->bindValue(":rendaTotal", $rendaTotal);
        $sql->bindValue(":qtd_dependentes", $qtd_dependentes);
        
        $sql->execute();
        
        return $this->db->lastInsertId();
    }
    
    //Inserção de pessoa dentro de uma família
    public function inserirPessoaFamilia($id_familia,$id_pessoa) {
        $sql = "INSERT INTO familiapessoas SET id_familia=:id_familia, id_pessoa=:id_pessoa";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id_familia", $id_familia);
        $sql->bindValue(":id_pessoa", $id_pessoa);        
        $sql->execute();
    }
    
    //Remoção de família
    public function remover($id) {                 
        $sql = $this->db->prepare("DELETE FROM familiapessoas WHERE id_familia=:id_familia");
        $sql->bindValue(":id_familia", $id);
        $sql->execute();
        $sql = $this->db->prepare("DELETE FROM familia WHERE id=:id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    //Busca o total de famílias não contempladas cadastradas para montagem de paginação
    public function getTotalFamiliasFiltro($filtros) {
		$filtroString = array('1=1');   
                
                $sql = "SELECT COUNT(familia.id) as c FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE familiaContemplada = 0 and tipo = 0";

		$sql = $this->db->query($sql);
                
                $row = $sql->fetch();

		return $row['c'];
	}

    //Busca o total de famílias contempladas cadastradas para montagem de paginação
     public function getTotalFamiliasContempladasFiltro($filtros) {
		$filtroString = array('1=1');   
                
                $sql = "SELECT COUNT(familia.id) as c FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE familiaContemplada = 1 and tipo = 0";

		$sql = $this->db->query($sql);
                
                $row = $sql->fetch();

		return $row['c'];
	}
    
    //Busca famílias não contempladas que serão exibidas na página atual
    public function getFamiliasFiltro($p, $qtd_por_pagina, $filtros) {
		$array = array();
                $filtroString = array('1=1');                

		$offset = ($p - 1) * $qtd_por_pagina;
                
                $sql = "SELECT familia.*, pessoa.nome FROM familia "
                . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
                . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
                . "WHERE familiaContemplada = 0 and tipo = 0 "
                . " ORDER BY pontuacaoTotal DESC LIMIT $offset, $qtd_por_pagina";
		
                $sql = $this->db->query($sql);
                
                if ($sql->rowCount() > 0) {
                    $array = $sql->fetchAll();
                }

		return $array;
	}
        
    //Busca famílias contempladas que serão exibidas na página atual
    public function getFamiliasContempladasFiltro($p, $qtd_por_pagina, $filtros) {
            $array = array();
            $filtroString = array('1=1');                

            $offset = ($p - 1) * $qtd_por_pagina;

            $sql = "SELECT familia.*, pessoa.nome FROM familia "
            . "LEFT JOIN familiapessoas ON familia.id = familiapessoas.id_familia "
            . "LEFT JOIN pessoa ON pessoa.id = familiapessoas.id_pessoa "
            . "WHERE familiaContemplada = 1 and tipo = 0 "
            . " ORDER BY pontuacaoTotal DESC LIMIT $offset, $qtd_por_pagina";

            $sql = $this->db->query($sql);

            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }

            return $array;
    }
    
    //Busca todas as pessoas que pertencem a uma determinada família
    public function getPessoasDaFamilia($id) {
        $array = array();
        $sql = "SELECT id_pessoa FROM familiapessoas WHERE id_familia = :id_familia";
        $sql = $this->db->prepare($sql);        
        $sql->bindValue(":id_familia", $id);
        $sql->execute();
                
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();            
        }
        return $array;
    }
    
    //Realiza a contemplação da família
    public function contempla($id) {
        $sql = "UPDATE familia SET familiaContemplada = 1 WHERE id = :id";
        $sql = $this->db->prepare($sql);                
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
    //Realiza a descontemplação da família
    public function descontempla($id) {
        $sql = "UPDATE familia SET familiaContemplada = 0 WHERE id = :id";
        $sql = $this->db->prepare($sql);                
        $sql->bindValue(":id", $id);
        $sql->execute();
    }
    
}

