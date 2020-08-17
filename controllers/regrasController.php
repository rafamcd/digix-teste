<?php
class regrasController extends Controller {

    //Construtor da Classe
    public function __construct() {
        parent::__construct();
        
        //Verificação se o usuário está logado, caso não esteja retornar para página de Login
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location: /novo/digix/login");
        } 
    }
    
    //Função que é executada inicialmente quando Controller é acessado
    public function index() {
        $dados = array();
        $regra = new Regra(); 
        
        //Caso tenha algum filtro na tela (posso adicionar futuramente novos filtros de busca)
        $filtros = array ();      
        
        //Verifica se algum filtro foi enviado e armazena na variável $filtros        
        if (isset($_GET['filtros'])) {
		$filtros = $_GET['filtros'];
	}        
        
        //Verifica o total de regras cadastradas para realizar a paginação         
        $total_regras = $regra->getTotalRegrasFiltro($filtros);        
        
        //Inicializa a paginação com o valor = 1         
        $p = 1;	
	
        //Verifica se usuário mudou de página         
        if (isset($_GET['p']) && !empty($_GET['p'])) {
		$p = addslashes($_GET['p']);
	}
        
        //Define a quantidade de regras que irão ser listadas por página e calcula quantas páginas serão exibidas        
	$qtd_por_pagina = 5;
	$total_paginas = ceil($total_regras / $qtd_por_pagina);

        //Armazenando em um array todas regras para página atual
	$regras = $regra->getRegrasFiltro($p, $qtd_por_pagina, $filtros);
        
        //Alimentando dados que serão exibidos na view
        $dados['total_regras'] = $total_regras;  
        $dados['limit_pessoas'] = $qtd_por_pagina;
        $dados['total_paginas'] = $total_paginas;
        $dados['regras'] = $regras;
        $dados['filtros'] = $filtros;        
        $dados['p'] = $p;

        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadregra', $dados);
    }
    
    //Adição de Regras
    public function add() {
       //Inicialização de array  
       $dados = array(
            'regras' => array(),
            'tabelas' => array(0=>'pessoa',1=>'familia')            
        );
       
        //Pegando as colunas que irão aparecer para o usuário adicionar nova regra
        $r = new Regra();        
        $dados['colunas'] = $r->getTodasColunas();        
        
        //Verificando se os dados foram enviados pelo usuário        
        if  (isset($_POST['campo']) && !empty($_POST['campo'])) {
             
            //Armazenando os dados enviados em variáveis
            $campotabela = explode('.',$_POST['campo']);
            $tabela = addslashes($campotabela[0]);            
            $campo = addslashes($campotabela[1]);             
            $sinal = addslashes($_POST['sinal']);            
            $valor1 = addslashes($_POST['valorini']);            
            $valor2 = addslashes($_POST['valorfin']);            
            $pontos = addslashes($_POST['pontos']);
            
            //Inserindo nova regra
            $r->inserir($tabela, $campo, $sinal, $valor1, $valor2, $pontos);
            
            //Após a inserção da nova regra, redireciona para listagem inicial de regras
            header("Location: /novo/digix/regras");            
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadregra_add', $dados);
    }
    
    //Edição de Regra
    public function edit($id) {
        $dados = array();
        
        //Pegando os dados da Regra selecionada para edição
        $regra = new Regra();
        $dados['regra'] = $regra->getRegra($id);
        $dados['colunas'] = $regra->getTodasColunas();
        
        //Verifica se o usuário realizou o envio da regra editada
        if  (isset($_POST['campo']) && !empty($_POST['campo'])) {
             
            //Armazena em variáveis os campos enviados
            $campotabela = explode('.',$_POST['campo']);
            $tabela = addslashes($campotabela[0]);            
            $campo = addslashes($campotabela[1]);             
            $sinal = addslashes($_POST['sinal']);            
            $valor1 = addslashes($_POST['valorini']);            
            $valor2 = addslashes($_POST['valorfin']);            
            $pontos = addslashes($_POST['pontos']);
            
            //Atualiza a regra
            $r = new Regra();
            $r->updateRegra($id, $tabela, $campo, $sinal, $valor1, $valor2, $pontos);
            
            //Após realizar a atualização da regra, redireciona para listagem inicial de regras
            header("Location: /novo/digix/regras");            
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadregra_edit', $dados);
    }
    
    //Remoção de Regra
    public function remove($id) {
        if (!empty($id)) {
            
           $regra = new Regra();
           $regra->remover($id);
           
           //Após realizar a remoção da regra, redireciona para listagem inicial de regras
           header("Location: /novo/digix/regras");            
        }
    }
}