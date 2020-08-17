<?php
class familiaController extends Controller {

    //Construtor da Classe
    public function __construct() {
        parent::__construct();
        
        //Verificação se o usuário está logado, caso não esteja retornar para página de Login
        $u = new Usuario();
        if ($u->isLogged() == false) {
            header("Location: /novo/digix/login");
        } 
        
        //Calculando a ponutação de todas famílias
        $fami = new Familia();
        $regr = new Regra();
        $regr->zeraPontuacao();
        $todasregras = $regr->getRegrasTodos();        
        foreach ($todasregras as $regraitem) {            
                $regr->verificaPontuacao($regraitem);            
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
        
        //Verifica o total de familias não contempladas cadastradas para realizar a paginação        
        $total_familias = $f->getTotalFamiliasFiltro($filtros);
        
        //Inicializa a paginação com o valor = 1
        $p = 1;	

	//Verifica se usuário mudou de página  
        if (isset($_GET['p']) && !empty($_GET['p'])) {
		$p = addslashes($_GET['p']);
	}

        //Define a quantidade de famílias que irão ser listadas por página e calcula quantas páginas serão exibidas        
	$qtd_por_pagina = 5;
	$total_paginas = ceil($total_familias / $qtd_por_pagina);

	//Armazenando em um array todas famílias não contempladas para página atual
        $familias = $f->getFamiliasFiltro($p, $qtd_por_pagina, $filtros);
        
        //Alimentando dados que serão exibidos na view
        $dados['total_familias'] = $total_familias;  
        $dados['limit_familias'] = $qtd_por_pagina;
        $dados['total_paginas'] = $total_paginas;
        $dados['familias'] = $familias;
        $dados['filtros'] = $filtros;        
        $dados['p'] = $p;

        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadfamilia', $dados);
    }
    
    //Adição de Família
    public function add() {
        
        $dados = array();
        
        //Pegando todas pessoas sem famílias (porque pessoas que já possuem família não podem aparecer no cadastro)
        $p = new Pessoa(); 
        $pessoas = $p->getPessoasSemFamilia();   
        
        //Alimentando array de $dados para envia-lo para view
        $dados['pessoas'] = $pessoas;
        
        //Inicializando array de erros
        $dados['erros'] = array();
        
        //Inicializando array de Dependentes selecionados
        $selecionados = array();
        
        //Verificando se os dados foram enviados pelo usuário
        if  (isset($_POST['pretendente']) && !empty($_POST['pretendente'])) {
            
            //Recebendo os dados
            $pretendente = addslashes($_POST['pretendente']);            
            $conjugue = addslashes($_POST['conjugue']);   
            $possui_casa = addslashes($_POST['possui_casa']); 
            
            //Fazendo validação se o usuário marcou a mesma pessoa sendo pretendente e cônjugue ao mesmo tempo
            if($pretendente==$conjugue) {
                $dados['erros'][0] = 'Um pretendente não pode ser seu próprio cônjugue.';
            }
            
            //Varrendo checkboxs de Dependentes para verificar qual foi marcado
            for ($q=1; $q <= 50; $q++) {
                $check = '';
                $check = 'check'.$q;                    
                if (isset($_POST[$check])) {
                    //Fazendo validação se o usuário marcou a mesma pessoa sendo pretendente e dependente ao mesmo tempo
                    if($q==$pretendente) {
                        $dados['erros'][1] = 'Um pretendente não pode ser um dependente'; 
                    }
                    //Fazendo validação se o usuário marcou a mesma pessoa sendo cônjugue e dependente ao mesmo tempo
                    else if($q==$conjugue) {
                        $dados['erros'][2] = 'Um cônjugue não pode ser um dependente'; 
                    } else {
                       //Adiciona no array $selecionados o dependente selecionado
                       $selecionados[] = $q; 
                    }                        
                }
            }                
            
            //Só posso gravar a família se não tiver nenhum erro de validação
            if (empty($dados['erros'])) {
                //Inicializando variáveis de rendaTotal e qtd_dependentes da família
                $rendaTotal = 0;
                $qtd_dependentes = 0;

                //pegando renda do Pretendente e somando com a renda total
                $rendaTotal += floatval($p->getRendaPessoa($pretendente));
                //pegando renda do Cônjugue e somando com a renda total
                $rendaTotal += floatval($p->getRendaPessoa($conjugue));

                //Vendo se a cônjugue é menor de idade para contabilizar como dependente
                if(!empty($conjugue)) {
                    //Caso seja menor de idade contabilizará como dependente
                    if ($p->VerificaIdadePessoa($conjugue) < 18) {
                        $qtd_dependentes++;
                    }
                }                    

                //Varrendo os Dependentes Selecionados                
                foreach($selecionados as $s) {                        
                    //pegando renda dos Dependentes Selecionados    
                    $rendaTotal += floatval($p->getRendaPessoa($s));
                    //verificando se os Dependentes Selecionados são menor de idade para contabilizar como dependente
                    if ($p->VerificaIdadePessoa($s) < 18) {
                        $qtd_dependentes++;
                    }
                }

                //Realizar a inserção da família
                $familia = new Familia();
                $id_familia = $familia->inserir($possui_casa, $rendaTotal, $qtd_dependentes);
                //Inserindo o pretendente na familia
                $familia->inserirPessoaFamilia($id_familia,$pretendente);
                //atualizando se é pretendente, cônjugue ou dependente na tabela de pessoa
                $p->atualizaTipo($pretendente,0);

                if(!empty($conjugue)) {
                    //Inserindo o cônjugue na família
                    $familia->inserirPessoaFamilia($id_familia,$conjugue);
                    $p->atualizaTipo($conjugue,1);
                }

                //Varrendo os Dependentes Selecionados para inserir na familia              
                foreach($selecionados as $s) {  
                    $familia->inserirPessoaFamilia($id_familia,$s);
                    $p->atualizaTipo($s,2);
                }                    

               //Após a gravação da nova família, redirecionar para listagem inicial das famílias 
               header("Location: /novo/digix/familia");            
            }
                
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadfamilia_add', $dados);
    }
    
    //Remoção de família
    public function remove($id) {
        if (!empty($id)) {
           
           //Pegando as pessoas da família para remover todas pessoas de dentro da família, posteriormente remover a família
           $familia = new Familia();
           $pessoa = new Pessoa();
           $pessoas = $familia->getPessoasDaFamilia($id);
           
           foreach($pessoas as $p) {
               //As pessoas da família que possuiram sua família excluída, agora voltam a ter o status "sem_familia"
               $pessoa->atualizaInformacoes($p['id_pessoa']);
           }           
           
           //Remover a família
           $familia->remover($id);           
           
           //Após a remoção da família, redirecionar para listagem inicial das famílias 
           header("Location: /novo/digix/familia");
            
        }
    }
    public function contempla($id) {
        if (!empty($id)) {
            //Realiza a contemplação da família selecionada
            $familia = new Familia();
            $familia->contempla($id);
            
            //Após a contemplação da família, redirecionar para listagem inicial de contemplados 
            header("Location: /novo/digix/contemplados");
        }
    }
    public function descontempla($id) {
        if (!empty($id)) {
            //Realiza a descontemplação da família selecionada
            $familia = new Familia();
            $familia->descontempla($id);
            
            //Após a descontemplação da família, redirecionar para listagem inicial de famílias 
            header("Location: /novo/digix/familia");
        }
    }

}