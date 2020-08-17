<?php
class contempladosController extends Controller {

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
        $f = new Familia();         
        
        //Caso tenha algum filtro na tela (posso adicionar futuramente novos filtros de busca)
        $filtros = array ();      
        
        //Verifica se algum filtro foi enviado e armazena no array de filtros         
        if (isset($_GET['filtros'])) {
		$filtros = $_GET['filtros'];
	}        
        
        //Verifica o total de familias contempladas cadastradas para realizar a paginação        
        $total_familias = $f->getTotalFamiliasContempladasFiltro($filtros);
        
        //Inicializa a paginação com o valor = 1        
        $p = 1;	

	
        //Verifica se usuário mudou de página        
        if (isset($_GET['p']) && !empty($_GET['p'])) {
		$p = addslashes($_GET['p']);
	}
        
        //Define a quantidade de famílias que irão ser listadas por página e calcula quantas páginas serão exibidas        
	$qtd_por_pagina = 5;
	$total_paginas = ceil($total_familias / $qtd_por_pagina);

	//Armazenando em um array todas famílias contempladas para página atual
        $familias = $f->getFamiliasContempladasFiltro($p, $qtd_por_pagina, $filtros);
        
        //Alimentando dados que serão exibidos na view
        $dados['total_familias'] = $total_familias;  
        $dados['limit_familias'] = $qtd_por_pagina;
        $dados['total_paginas'] = $total_paginas;
        $dados['familias'] = $familias;
        $dados['filtros'] = $filtros;        
        $dados['p'] = $p;

        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadfamiliacontemplada', $dados);
    }    
}