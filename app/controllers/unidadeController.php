<?php
class unidadeController extends Controller 
{
    private $login;
    private $arrayView;
    
    //Construtor
    public function __construct() {
        //Instanciar o Login
        $this->login = new Login();

        //Verificando se esta logado
        if (!$this->login->isLogado()){
            header("location: ".BASE_URL."/login");
            exit;
        }
        
        //verificar se tem permissão para acessa a pagina
        if (!$this->login->hasPermissao('MENU_ADMIN')){
            header("location: ".BASE_URL);
            exit;
        }
        
        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'menu' => 'unidade',
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }
    
    
    //Abrir a Pagina de Listagem
    public function index()  {
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
        $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAll();

        //Vai pra Pagina de Unidades
        $this->loadTemplate('unidadeList', $this->arrayView);
    }
    
    
    //Abrir a Pagina de Adicionar
    public function adicionar() {
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
        
        //Vai pra Pagina de Unidades
        $this->loadTemplate('unidadeAdd', $this->arrayView);
    }
    
    
    //Abrir a Pagina de Edição
    public function Editar($undId) {
        //Verificar se ID existe ou esta vazio
        if (!empty($undId) && isset($undId)) {
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
            $this->arrayView['Unidade'] = $vUnidade->getUnidade($undId);

            //Vai pra Pagina de Unidades
            $this->loadTemplate('unidadeEdit', $this->arrayView);
            
        }  else {
            //Retornar a Pagina de Listagem
            header('location: '.BASE_URL.'/unidade');
        }  
    }
    
    
    //Adicionar Registro
    public function addMod() {
        //verificar se tem permissão para Adicionar Registro
        if (!$this->login->hasPermissao('N_ADDREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Adicionar Registro.';
            header("location: ".BASE_URL.'/unidade');
            exit;
        }

        //Instanciar Unidade
        $vUnidade = new Unidade();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edunidade'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/unidade');
            exit;

        } else {

            //Verificar Duplicidade
            $duplicado = $vUnidade ->unidadeExist($_POST['edunidade']);
            
            //Se não for dubplicado
            if ($duplicado == false) {
                //Pegar Valores
                $arrayModel = array(
                    'unidade' => strtoupper(trim($_POST['edunidade'])),
                    'end'     => strtoupper($_POST['edend']),
                    'bairro'  => strtoupper($_POST['edbairro']),
                    'cidade'  => strtoupper($_POST['edcidade']),
                    'uf'      => strtoupper($_POST['eduf']),
                    'cep'     => $_POST['edcep'],
                    'fone1'   => $_POST['edfone1'],
                    'fone2'   => $_POST['edfone2'],
                    'email'   => strtolower($_POST['edemail']),
                    'resp'    => strtoupper($_POST['edresp']),
                    'respfone' => $_POST['edrespfone'],
                    'ativo'   => $_POST['edativo'],
                    'obs'     => $_POST['edobs']
                );

                //Retorno do Banco de dados
                $retBD = $vUnidade -> addUnidade($arrayModel);
                
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Adicionou a Unidade ". strtoupper($_POST['edunidade']));

                    //Voltar para pagina apos salvar
                    $_SESSION['successMsg'] = 'Registro Adicionado com sucesso!';
                    header("location: ".BASE_URL.'/unidade');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'Erro ao Salvar! Os dados não foram inseridos.';
                    header("location: ".BASE_URL.'/unidade');
                    exit;
                }    
                
            } else {
                //Se for duplicado Voltar para pagina
                $_SESSION['errorMsg'] = 'Já existe um registro com este valor!';
                header("location: ".BASE_URL.'/unidade');
                exit;
            } 
       
        }
        
    }  
    
    
    //Deletar Registro
    public function delMod($undId) {
        //verificar se tem permissão para Excluir Registro
        if (!$this->login->hasPermissao('N_DELREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Excluir Registro.';
            header("location: ".BASE_URL.'/unidade');
            exit;
        }

        //Instanciar Unidade
        $vUnidade = new Unidade();
        
        //Verificar se ID existe ou esta vazio
        if (!empty($undId) && isset($undId)) {
            //Pegar no Nome da Unidade
            $dados = $vUnidade->getUnidade($undId);
            $nUnidade = $dados['und_unidade'];
        
            //Retorno do Banco de dados
            $retBD = $vUnidade->delUnidade($undId);
            if ($retBD){
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, $this->login -> userUnidade, "Excluiu o registro da Unidade ". $nUnidade);

                //Retornar para Pagina
                $_SESSION['successMsg'] = 'Registro Excluido com sucesso!';
                header('location: '.BASE_URL.'/unidade');
            } else {
                //Erro ao Salvar
                $_SESSION['errorMsg'] = 'Erro! O Registro não foi Excluido.';
                header("location: ".BASE_URL.'/unidade');
                exit;
            }    
            
        } else {
            //Voltar se não encontrar
            $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
            header("location: ".BASE_URL.'/unidade');
            exit;
        }
    }
    
    
    //Editar Registro 
    public function editMod($undId) {
        //verificar se tem permissão para Alterar Registro
        if (!$this->login->hasPermissao('N_EDITREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Alterar Registro.';
            header("location: ".BASE_URL.'/unidade');
            exit;
        }

        //Instanciar Unidade
        $vUnidade = new Unidade();

        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edunidade'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/unidade');
            exit;

        } else {
        
            //Verificar se ID existe ou esta vazio
            if (!empty($undId) && isset($undId)) {
                
                //Pegar Valores
                $arrayModel = array(
                    'unidade' => strtoupper(trim($_POST['edunidade'])),
                    'end'     => strtoupper($_POST['edend']),
                    'bairro'  => strtoupper($_POST['edbairro']),
                    'cidade'  => strtoupper($_POST['edcidade']),
                    'uf'      => strtoupper($_POST['eduf']),
                    'cep'     => $_POST['edcep'],
                    'fone1'   => $_POST['edfone1'],
                    'fone2'   => $_POST['edfone2'],
                    'email'   => strtolower($_POST['edemail']),
                    'resp'    => strtoupper($_POST['edresp']),
                    'respfone' => $_POST['edrespfone'],
                    'ativo'   => $_POST['edativo'],
                    'obs'     => $_POST['edobs'],
                    'undId'   => $undId
                );
                
                //Retorno do Banco de dados
                $retBD = $vUnidade -> editUnidade($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Alterou o registro da Unidade ".strtoupper($_POST['edunidade']));

                    //Voltar para pagina
                    $_SESSION['successMsg'] = 'Registro Alterado com sucesso!';
                    header("location: ".BASE_URL.'/unidade');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'Erro ao Salvar! Os dados não foram Alterados.';
                    header("location: ".BASE_URL.'/unidade');
                    exit;
                }    
                
            } 
        }
    }  
}