<?php
class loginController extends Controller {

    //Construtor da Classe
    public function __construct() {
        parent::__construct();
    }
    
    //Função que é executada inicialmente quando Controller é acessado
    public function index() {
        $dados = array(
            'aviso' => ''
        );
        
        //Verificando se o usuário enviou user e senha
        if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
            $usuario = addslashes($_POST['usuario']);
            $senha = addslashes($_POST['senha']);
            
            //Verificando se usuário é valido, existe e digitou a senha correta
            $u = new Usuario();
            if ($u->isExiste($usuario, $senha)) {
                $uid = $u->getId($usuario);
                
                //Armazenando dados importantes do usuário na sessão
                $_SESSION['lginteco'] = $uid;
                $_SESSION['nomeuser'] = $u->getNomeUsuario($uid);
                $_SESSION['tipouser'] = $u->getTipoUsuario($uid);
                $_SESSION['imagemuser'] = $u->getImagemUsuario($uid);
                $_SESSION['user'] = $usuario;
                
                //Redireciona para página inicial do painel
                header("Location: /novo/digix");
            } else {
                //Armazena erros para serem exibidos ao usuário
                $dados['aviso'] = "Usuário e/ou senha inválidos.";
            }
        }
        
        //Carregando a view com os dados alimentados no array $dados
        $this->loadView('login', $dados);
    }
    public function logout() {
        //Realiza o logout
        unset($_SESSION['lginteco']);
        
        //Redireciona para página de Login
        header("Location: /novo/digix/login");
    }
}