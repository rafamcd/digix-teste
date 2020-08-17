<?php
class Controller {

	
        private $tpl;                
	protected $db;

	public function __construct() {
		global $config;                
	}

	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array(), $viewData2 = array()) {
		//print_r($viewData);exit;
                include 'views/template1.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'views/'.$viewName.'.php';
	}
        
        public function loadTemplateInPainel($viewName, $viewData = array()) {
		$v = new Permissao();
                if (!$v->verificaController($viewName,$_SESSION['lginteco'])) {
                    header("Location: ".BASE_URL."digix");
                } else {
                    include 'views/template1.php';
                }
	}
        
        public function loadMenu() {
            $dados = array(
            'permissao' => array()            
             );
        
            $p = new Permissao();
            $dados['permissao'] = $p->getPermissao($_SESSION['lginteco']);            
            $this->loadView("menu",$dados);
        }

        public function loadLibrary($lib) {
            if (file_exists('libraries/'.$lib.'.php')) {
                include 'libraries/'.$lib.'.php';                
            }
            
        }

}