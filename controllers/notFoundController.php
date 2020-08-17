<?php
class notFoundController extends Controller {

    //Função executada quando o usuário tentar acessar uma página que não existe
    public function index() {
        $data = array();
        
        $this->loadView('404', $data);
    }

}