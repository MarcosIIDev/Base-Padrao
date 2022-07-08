<?php
class Application 
{
    public function run() {
        //URL
        $url = '/';
            if (isset($_GET['url'])) {
                $url .= $_GET['url'];
        }

        //Definindo paramentros
        $params = array();

        //Verifica se foi enviador alguma coisa
        if (!empty($url) && $url != '/') {
            //Se enviou - Explode (Divide pela barra)
            $url = explode("/", $url);
            array_shift($url); //Retira o primeiro registro

            //Pegar o controller
            $currentController = $url[0].'Controller'; 
            array_shift($url); //Deleta o Controller

            //Tratando possiveis erros de vazio e barra no final
            if (isset($url[0]) && !empty($url[0])) {
                    $currentAction = $url[0];
                    array_shift($url); //Deleta o Action
            } else {
                    $currentAction = 'index';
            }

            //Veriricar se tem paramentros
            if (count($url) > 0) {
                    $params = $url;
            }

        } else {
            //Não enviou - Atribui Valores Padroes
            $currentController = 'homeController';
            $currentAction     = 'index';
        }

        //Verificar se o Arquivo exite - ERRO (404)
        if (!file_exists('app/controllers/'.$currentController.'.php') || !method_exists($currentController, $currentAction)) {
            $currentController = 'notFoundController';
            $currentAction = 'index';
        }

        //Instanciar os Controles
        $Ctrll = new $currentController();

        //Instanciar 
        call_user_func_array(array($Ctrll, $currentAction), $params); 

    }

}