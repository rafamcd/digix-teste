<?php

class Regra extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    //Busca todos os dados de uma determinada regra
    public function getRegra($id) {
        $array = array();
        
        $sql = "SELECT * FROM regraspontuacao WHERE id='$id'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }
        return $array;
    }
    
    //Buscar todas regras que serão exibidas na página atual
    public function getRegras($offset, $limit) {
            $array = array();
            
            $sql = "SELECT * FROM regraspontuacao order by id LIMIT $offset, $limit";
            $sql = $this->db->query($sql);
            
            if ($sql->rowCount() > 0) {
                $array = $sql->fetchAll();
            }
            
            return $array;
        }
    
    //Remoção de regra    
    public function remover($id) {                 
        $sql = $this->db->prepare("DELETE FROM regraspontuacao WHERE id=:id");
        $sql->bindValue(":id", $id);        
        $sql->execute();
    }
    
    //Busca quantidade de regras cadastradas para montagem da paginação
    public function getTotalRegrasFiltro($filtros) {
		$filtroString = array('1=1');                

		$sql = "SELECT COUNT(*) as c FROM regraspontuacao WHERE ".implode(' AND ',$filtroString);
                $sql = $this->db->query($sql);
                
                $row = $sql->fetch();

		return $row['c'];
	}
    
    //Busca informações das regras da página atual    
    public function getRegrasFiltro($p, $qtd_por_pagina, $filtros) {
		$array = array();
                $filtroString = array('1=1');                

		$offset = ($p - 1) * $qtd_por_pagina;

		$sql = "SELECT * FROM regraspontuacao WHERE ".implode(' AND ',$filtroString)." ORDER BY id LIMIT $offset, $qtd_por_pagina";
                $sql = $this->db->query($sql);
                
                if ($sql->rowCount() > 0) {
                    $array = $sql->fetchAll();
                }

		return $array;
	}
    
    //Inserção de regra
    public function inserir($tabela, $campo, $sinal, $valor1, $valor2, $pontos) {
        $sql = "INSERT INTO regraspontuacao SET tabela=:tabela, campo=:campo, sinal=:sinal, valor1 = :valor1, valor2 = :valor2, pontos = :pontos";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":tabela", $tabela);
        $sql->bindValue(":campo", $campo);
        $sql->bindValue(":sinal", $sinal);
        $sql->bindValue(":valor1", $valor1);
        $sql->bindValue(":valor2", $valor2);
        $sql->bindValue(":pontos", $pontos);   
        $sql->execute();
    }
    
    //Atualização de regra
    public function updateRegra($id, $tabela, $campo, $sinal, $valor1, $valor2, $pontos) {
        $sql = "UPDATE regraspontuacao SET tabela=:tabela, campo=:campo, sinal=:sinal, valor1 = :valor1, valor2 = :valor2, pontos = :pontos WHERE id=:id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":tabela", $tabela);
        $sql->bindValue(":campo", $campo);
        $sql->bindValue(":sinal", $sinal);
        $sql->bindValue(":valor1", $valor1);
        $sql->bindValue(":valor2", $valor2);
        $sql->bindValue(":pontos", $pontos);        
        $sql->bindValue(":id", $id);
        $sql->execute();        
    }
    
    //Busca todas as regras ordenadas pelo ID
    public function getRegrasTodos() {
        $array = array();
        $sql = "SELECT * FROM regraspontuacao ORDER BY id";
        $sql = $this->db->query($sql);
                
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;        
    }
    
    //Buscar o nome das tabelas e colunas que serão exibidas para criação de regras
    public function getTodasColunas() {
        $array = array();
        $sql = "SELECT CONCAT(TABLE_NAME,'.',COLUMN_NAME) as coluna FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'digix' AND TABLE_NAME in ('pessoa','familia')";
        $sql = $this->db->query($sql);
                
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;        
    }
    
    //Zerar pontuação da família
    public function zeraPontuacao() {
        $sql = "UPDATE familia SET pontuacaoTotal = 0, qtd_requisitos = 0";
        $sql = $this->db->query($sql);
    }
    
    //Atualização da pontuação da família
    public function verificaPontuacao($regra) {        
        $sinal = $regra['sinal'];
        $valor2 = 0;
        
        //Pegando o sinal do banco de dados e transformando ele pro php entender
        if ($sinal =='igual') {
            $sinal = '=';
        } else if ($sinal=='maior'){
            $sinal = '>';
        } else if ($sinal=='menor') {
            $sinal = '<';
        } else if ($sinal=='entre') {
            $sinal = 'between';
            $valor2 = $regra['valor2'];
        }
        
        //Caso o sinal seja =, < ou >
        if($valor2 == 0) {
            
            //Se a tabela da regra selecionada for a família
            if($regra['tabela'] == 'familia') {
                //como a pontuacaoTotal fica na tabela de família mesmo, eu já posso realizar a atualização
                $sql = "UPDATE familia SET pontuacaoTotal = pontuacaoTotal + :pontuacaoregra, qtd_requisitos = qtd_requisitos + 1"
                   ." WHERE ".$regra['campo'].' '.$sinal.' '.$regra['valor1'];
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":pontuacaoregra", $regra['pontos']);
                $sql->execute();
            }
            
            //Se a tabela da regra selecionada for a pessoa
            if ($regra['tabela'] == 'pessoa') {                 
                 //Primeiro preciso pegar o id de todas as pessoas que atendem a regra  
                 $sql = "SELECT id from pessoa"
                         ." WHERE tipo = 0 AND ".$regra['campo'].' '.$sinal.' '.$regra['valor1'];                 
                 $sql = $this->db->query($sql);                
                 
                 //Caso existam pessoas que atendem essa regra
                 if ($sql->rowCount() > 0) {
                     
                     $array = array();
                     $array = $sql->fetchAll();
                     
                     //Varrendo todas as pessoas que atendem essa regra 
                     foreach($array as $a) {
                         
                         //Para cada pessoa que atende essa regra, preciso pegar qual é a família para atualizar a pontuação
                         $sqlIdFamilia = "SELECT id_familia FROM familiapessoas WHERE id_pessoa = :id_pessoa";
                         $sqlIdFamilia = $this->db->prepare($sqlIdFamilia);
                         $sqlIdFamilia->bindValue(":id_pessoa", $a['id']);
                         $sqlIdFamilia->execute();
                         
                         if ($sqlIdFamilia->rowCount() > 0) {
                             
                            $id_familia = $sqlIdFamilia->fetch();   
                            $id_familia = $id_familia['id_familia'];
                            
                            //Atualiza a pontuação dessa família
                            $sqlUpdate = "UPDATE familia SET pontuacaoTotal = pontuacaoTotal + :pontuacaoregra, qtd_requisitos = qtd_requisitos + 1"
                                ." WHERE id = :id";
                             $sqlUpdate = $this->db->prepare($sqlUpdate);
                             $sqlUpdate->bindValue(":pontuacaoregra", $regra['pontos']);
                             $sqlUpdate->bindValue(":id", $id_familia);
                             $sqlUpdate->execute();
                        }
                     }
                 }                 
            }
            
        } else if ($valor2 > 0) {
            //Aqui vai entrar quando o sinal for "entre" dois valores
            
            //Caso a tabela selecionada seja a família
            if($regra['tabela'] == 'familia') {
                //como a pontuacaoTotal fica na tabela de família mesmo, eu já posso realizar a atualização
                $sql = "UPDATE familia SET pontuacaoTotal = pontuacaoTotal + :pontuacaoregra, qtd_requisitos = qtd_requisitos + 1"
                   ." WHERE ".$regra['campo'].' '.$sinal.' '.$regra['valor1'].' AND '.$regra['valor2'];
                $sql = $this->db->prepare($sql);
                $sql->bindValue(":pontuacaoregra", $regra['pontos']);
                $sql->execute();
            }
            
            //Caso a tabela selecionada seja a pessoa
            if ($regra['tabela'] == 'pessoa') {
                 //Primeiro preciso pegar o id de todas as pessoas que atendem essa regra
                 $sql = "SELECT id from pessoa"
                         ." WHERE tipo = 0 AND ".$regra['campo'].' '.$sinal.' '.$regra['valor1'].' AND '.$regra['valor2'];
                 
                 $sql = $this->db->query($sql);                
                 
                 //Verificar se existem pessoas que atendem essa regra
                 if ($sql->rowCount() > 0) {
                     
                     $array = array();
                     $array = $sql->fetchAll();
                     
                     //Varrer todas as pessoas que atendem essa regra
                     foreach($array as $a) {
                         
                         //Pegar o id da família de cada pessoa que atende essa regra
                         $sqlIdFamilia = "SELECT id_familia FROM familiapessoas WHERE id_pessoa = :id_pessoa";
                         $sqlIdFamilia = $this->db->prepare($sqlIdFamilia);
                         $sqlIdFamilia->bindValue(":id_pessoa", $a['id']);
                         $sqlIdFamilia->execute();
                         
                         if ($sqlIdFamilia->rowCount() > 0) {
                             
                            $id_familia = $sqlIdFamilia->fetch();   
                            $id_familia = $id_familia['id_familia'];
                            
                            //Realiza a atualização da pontuação da família da pessoa que atende essa regra
                            $sqlUpdate = "UPDATE familia SET pontuacaoTotal = pontuacaoTotal + :pontuacaoregra, qtd_requisitos = qtd_requisitos + 1"
                                ." WHERE id = :id";
                             $sqlUpdate = $this->db->prepare($sqlUpdate);
                             $sqlUpdate->bindValue(":pontuacaoregra", $regra['pontos']);
                             $sqlUpdate->bindValue(":id", $id_familia);
                             $sqlUpdate->execute();
                        }
                     }
                 }                 
            }            
        }
    }
}

