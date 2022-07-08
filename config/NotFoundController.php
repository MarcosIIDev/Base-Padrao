<?php
class notFoundController extends Controller 
{
    private $arrayView;

    //Abir a pagina
    public function index() {
        //Array da pagina - View
        $this->arrayView = array();

        //Vai pra Pagina de Erro 404
        $this->loadView('err404', $this->arrayView);
    }

}