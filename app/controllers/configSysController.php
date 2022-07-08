<?php
class configSysController extends Controller 
{
    private $login;
    private $arrayView;
    
    //Construtor
    public function __construct() 
    {
        //Instanciar o Login
        $this->login = new Login();

        //Verificando se esta logado
        if (!$this->login->isLogado()){
            header("location: ".BASE_URL."/login");
            exit;
        }
        
        //verificar se tem permissão para acessa a pagina
        if (!$this->login->hasPermissao('SUPER_ADMIN')){
            header("location: ".BASE_URL);
            exit;
        }
        
        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'menu' => 'config',
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }
    
    //Abrir a Pagina de Listagem
    public function index() 
    {
        //Verificar se a Sessao de Erro esta vazia
        if (!empty($_SESSION['errorMsg'])) {
            $this->arrayView['msgReturnErr'] = $_SESSION['errorMsg'];
            $_SESSION['errorMsg'] = '';
        };
        
        //Verificar se a Sessao de Sucesso esta vazia
        if (!empty($_SESSION['successMsg'])) {
            $this->arrayView['msgReturnSucc'] = $_SESSION['successMsg'];
            $_SESSION['successMsg'] = '';
        }
        
        //Vai pra Pagina de Timelines
        $this->loadTemplate('configSys', $this->arrayView);
    }

    
    //Backup de Banco de Dados
    public function backupBD() 
    {
        //instanciar
        $vConfig = new Config();
        
        //Limpar os Check
        $vConfig ->setBackupDB();
        
        //Volta p Pagina Inicial
        $_SESSION['successMsg'] = 'Backup realizado com sucesso!';
        header("location: ".BASE_URL);
        exit;
    }
    
}