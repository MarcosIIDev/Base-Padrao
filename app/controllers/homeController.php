<?php
class homeController extends Controller 
{
    private $arrayView;
    private $login;

    //Construtor
    public function __construct() {
        //Instanciar
        $this->login = new Login();

        //Verificando se esta logado
        if (!$this->login->isLogado()){
            //Ir para pagina de Login
            header("location: ".BASE_URL."/login");
            exit;
        }

        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'menu' => 'home',
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }

    //Index
    public function index() {
        //Verificar se a Sessao de Erro esta vazia
        if (!empty($_SESSION['errorMsg'])) {
            $this->arrayView['msgReturnErr'] = $_SESSION['errorMsg'];
            $_SESSION['errorMsg'] = '';
        }

        //Verificar se a Sessao de Sucesso esta vazia
        if (!empty($_SESSION['successMsg'])) {
            $this->arrayView['msgReturnSucc'] = $_SESSION['successMsg'];
            $_SESSION['successMsg'] = '';
        }

        //Instanciar
        $vUsuario = new Usuario();

        //Listas da pagina
        $this->arrayView['listUsuarios'] = $vUsuario->getUsuariosAll(1);

        //Abrir a Pagina
        $this->loadTemplate('home', $this->arrayView);
    }

}
    
    