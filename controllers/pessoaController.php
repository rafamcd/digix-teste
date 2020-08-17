<?php
class pessoaController extends Controller {

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
        $pes = new Pessoa(); 
        
        //Caso tenha algum filtro na tela (posso adicionar futuramente novos filtros de busca)
        $filtros = array ();      
        
        //Verifica se algum filtro foi enviado e armazena no array de filtros 
        if (isset($_GET['filtros'])) {
		$filtros = $_GET['filtros'];
	}        
        
        //Verifica o total de pessoas cadastradas para realizar a paginação         
        $total_pessoas = $pes->getTotalPessoasFiltro($filtros);        
        
        //Inicializa a paginação com o valor = 1        
        $p = 1;	
	
        //Verifica se usuário mudou de página        
        if (isset($_GET['p']) && !empty($_GET['p'])) {
		$p = addslashes($_GET['p']);
	}

        
        //Define a quantidade de pessoas que irão ser listadas por página e calcula quantas páginas serão exibidas        
	$qtd_por_pagina = 5;
	$total_paginas = ceil($total_pessoas / $qtd_por_pagina);

	//Armazenando em um array todas pessoas para página atual
        $pessoas = $pes->getPessoasFiltro($p, $qtd_por_pagina, $filtros);
        
        //Alimentando dados que serão exibidos na view
        $dados['total_pessoas'] = $total_pessoas;  
        $dados['limit_pessoas'] = $qtd_por_pagina;
        $dados['total_paginas'] = $total_paginas;
        $dados['pessoas'] = $pessoas;
        $dados['filtros'] = $filtros;        
        $dados['p'] = $p;

        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadpessoa', $dados);
    }
    
    //Adição de Pessoa
    public function add() {
        $dados = array(
            'pessoas' => array()
        );
        
        //Verificando se os dados foram enviados pelo usuário
        if  (isset($_POST['nome']) && !empty($_POST['nome'])) {
            
            //Recebendo todos os dados
            $nome = utf8_decode(addslashes($_POST['nome']));
            $fone = addslashes($_POST['fone']);            
            $data_nascimento = $_POST['data_nascimento'];
            $idade = $this->calcularIdade($data_nascimento);
            $email = addslashes($_POST['email']);
            
            //Como o campo float utiliza o modelo americano, precisamos substituir a vírgula por ponto
            $renda = addslashes($_POST['renda']);
            $renda = str_replace('.','', $renda);
            $renda = str_replace(',','.', $renda); 
            
            //Toda pessoa inicialmente é cadastrada como pretendente
            $tipo = 0;
            
            //Recebendo a imagem enviada e já define a extensão do arquivo
            $imagem = $_FILES['imagem'];  
            if (!empty($_FILES['imagem']['tmp_name'])) { 
                if (in_array($imagem['type'], array('image/jpeg','image/jpg','image/png'))) {
                        $ext = '.jpg';
                    if ($imagem['type'] == 'image/png') {
                        $ext = '.png';
                    }
                }
                
                //Gerando um nome aleatório para o arquivo da imagem
                $md5imagem = md5(time().rand(0,9999)).$ext;                
                
                //Movendo o arquivo gerado para pasta 
                $endereco = 'assets/images/pessoas/'.$md5imagem;
                move_uploaded_file($imagem['tmp_name'], $endereco);
                
            } else {                
                //Caso não tenha sido enviada nenhuma imagem, usar o avatar pré-definido "noimage.jpg"
                $md5imagem='noimage.jpg';                
            }   
                
                //Realizar a gravação da pessoa
                $pessoa = new Pessoa();
                $pessoa->inserir($nome, $fone, $data_nascimento, $idade, $email, $md5imagem, $renda, $tipo);
                
                //Após realizar a gravação da pessoa, redireciona para listagem inicial de pessoas
                header("Location: /novo/digix/pessoa");            
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadpessoa_add', $dados);
    }
    
    //Edição de Pessoa
    public function edit($id) {
        $dados = array();
        
        //Pegar os dados da pessoa que será editada
        $pessoa = new Pessoa();
        $dados['pessoa'] = $pessoa->getPessoa($id);        
        
        //Verifica se o usuário enviou os dados editados
        if  (isset($_POST['nome']) && !empty($_POST['nome'])) {
            
            //Armazenando os dados enviados nas variáveis
            $nome = utf8_decode(addslashes($_POST['nome']));
            $fone = addslashes($_POST['fone']);   
            $data_nascimento = $_POST['data_nascimento'];            
            $idade = $this->calcularIdade($data_nascimento);          
            $email = addslashes($_POST['email']);
            
            //Como o campo float utiliza o modelo americano, precisamos substituir a vírgula por ponto            
            $renda = addslashes($_POST['renda']);
            $renda = str_replace('.','', $renda);
            $renda = str_replace(',','.', $renda);             
            
            //Realizar a atualização da pessoa
            $pessoa->updatePessoa($id, $nome, $fone, $data_nascimento, $idade, $email, $renda);
            
            //Caso tenha sido alterada a imagem, realizar a atualização da mesma
            if (!empty($_FILES['imagem']['tmp_name'])) {
                $imagem = $_FILES['imagem'];
            
                if (in_array($imagem['type'], array('image/jpeg','image/jpg','image/png'))) {
                    $ext = '.jpg';
                    if ($imagem['type'] == 'image/png') {
                        $ext = '.png';
                    }
                    
                    //Gerando nome aleatório para nova imagem
                    $md5imagem = md5(time().rand(0,9999)).$ext;                
                    
                    //Movendo a imagem criada para pasta
                    $endereco = 'assets/images/pessoas/'.$md5imagem;
                    move_uploaded_file($imagem['tmp_name'], $endereco);                    

                    //Apagando imagem anterior e inserindo a imagem nova
                    $pessoa->apagaImagemAnterior($id);
                    $pessoa->updateImagemPessoa($id, $md5imagem);                    
                }
            }            
            //Após realizar a edição da pessoa, redireciona para listagem inicial de pessoas
            header("Location: /novo/digix/pessoa");
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('cadpessoa_edit', $dados);
    }
    
    //Remoção de pessoas
    public function remove($id) {
        if (!empty($id)) {
            
           $pessoa = new Pessoa();
           
           //Removendo a imagem da pessoa para depois remover a pessoa
           $pessoa->apagaImagemAnterior($id);
           
           //Removendo a pessoa
           $pessoa->remover($id);
           
           //Após realizar a remoção da pessoa, redireciona para listagem inicial de pessoas
           header("Location: /novo/digix/pessoa");
            
        }
    }
    
    //Função para calcular idade da pessoa
    public function calcularIdade($data){
    
    // Separa em dia, mês e ano
    list($ano, $mes, $dia) = explode('-', $data);

    // Descobre que dia é hoje e retorna a unix timestamp
    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
    
    // Descobre a unix timestamp da data de nascimento do fulano
    $diadonascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
    
    // Depois apenas fazemos o cálculo já citado :)
    $idade = floor((((($hoje - $diadonascimento) / 60) / 60) / 24) / 365.25);
    return $idade;
}

}