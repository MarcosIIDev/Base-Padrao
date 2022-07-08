<?php
class loginController extends Controller 
{
    private $arrayView;
    private $login;
    
    //Construtor
    public function __construct() {
        //Instanciar
        $this->login = new Login();

        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }
    
    
    //Abrir a Pagina de Login
    public function index() {
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
        
        //Instanciar Unidade
        $vUnidade = new Unidade();
        
        //Listas da pagina
        $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAtivo();
        
        $this->loadView('/login', $this->arrayView);
    }
    
    
    //verificar as informações do usuario
    public function checkLogin() {
        if(!empty($_POST['edlogin']) && !empty($_POST['edsenha'])){
            //Pegar valores
            $login   = $_POST['edlogin'];
            $senha   = md5($_POST['edsenha']);
            
            $Usuario = $this->login->confirmarLogin($login, $senha);
            
            if ($Usuario){
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, $this->login -> userUnidade, "Usuario logado no Sistema");
                
                //Ir para pagina Principal
                header("location: ".BASE_URL);
                exit;
            } else {
                //Msg Senha invalida
                $_SESSION['errorMsg'] = 'Usuário e/ou Senha invalido.';
            }
        } else {
            //Msg Preencha os Campos
            $_SESSION['errorMsg'] = 'Preencha todos os Campos.';
        }
        
        //Voltar para login
        header("location: ".BASE_URL."/login");
        exit;
    }
    
    
    //Esqueci minha senha
    public function esqueciMinhaSenha() {
        //Instanciar
        $vLogin = new Login();
        
        //Pegar valores
        $email = $_POST['edemail'];
        
        //Verificar se o email é válido
        $resultado = $vLogin -> checkEmail($email);
       
        //Enviar Link para email
        if ($resultado) {
            //Ir para pagina de Sucesso
            $_SESSION['successMsg'] = 'Acesse seu email, e clique no link para redefinir sua senha.';
            header("location: ".BASE_URL."/esqueciMinhaSenha/success");
            exit;
        } else {
            //Ir para pagina de Erro
            $_SESSION['errorMsg'] = 'O Email não foi localizado na nossa Base de Dados! <br/> Tente um outro email';
            header("location: ".BASE_URL."/esqueciMinhaSenha/erro");
            exit;
        }
        
    }
    
    
    //Logout
    public function logout() {
        //Verificando se esta logado
        $usuario = $this->login->isLogado();
        
        if ($usuario){
            //Lançamento no historico
            $log = new Historico();
            $log->registrar($this->login -> userId, $this->login -> userUnidade, "Usuario saiu do Sistema");

            //Limpar todas as sessões
            session_destroy();

            //Retornar a Pagina Principal
            header("location: ".BASE_URL);
        }

    }
    
}