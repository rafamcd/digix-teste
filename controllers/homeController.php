<?php
class homeController extends Controller {

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
        $dados = array(
            'permissao' => array()
        );
        
        //Verificando as permissões do usuário e armazenando no array $dados
        $p = new Permissao();
        $dados['permissao'] = $p->getPermissao($_SESSION['lginteco']);        
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadTemplate('home', $dados);
    }

}