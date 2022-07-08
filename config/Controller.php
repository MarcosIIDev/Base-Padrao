<?php
class Controller 
{
    //Carregar Pagina
    public function loadView($viewName, $viewData = array()) {
        extract($viewData);

        //Incluir a pagina para acesso
        require 'app/views/'.$viewName.'.php';
    }

    //Carregar Template
    public function loadTemplate($viewName, $viewData = array()) {
        //Incluir a pagina para acesso
        require 'app/views/template.php';
    }

    //Carregar Pagina dentro do Template
    public function loadViewInTemplate($viewName, $viewData = array()) {
        extract($viewData);

        //Incluir a pagina para acesso
        require 'app/views/'.$viewName.'.php';
    }

}