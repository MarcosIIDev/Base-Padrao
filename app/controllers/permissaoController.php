<?php
class permissaoController extends Controller 
{
    private $login;
    private $arrayView;
    
    //Construtor
    public function __construct() {
        //Criando novo item
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
            'menu' => 'permissao',
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }
    
    
    //Abrir a Pagina
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
        
        //Instanciar Item
        $vPermissao = new Permissao();
        
        //Listas da pagina
        $this->arrayView['listPermissoes'] = $vPermissao -> getPermissoesNivel(0);

        //Vai pra Pagina de Permissões
        $this->loadTemplate('permissao', $this->arrayView);
    }
    
    
    //Adicionar Registro
    public function addMod() {
        //verificar se tem permissão para Adicionar Registro
        if (!$this->login->hasPermissao('N_ADDREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Adicionar Registro.';
            header("location: ".BASE_URL.'/permissao');
            exit;
        }

        //Instanciar Item
        $vPermissao = new Permissao();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edpermissao']) OR empty($_POST['edslug'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/permissao');
            exit;

        } else {
            
            //Verificar Duplicidade
            $duplicado = $vPermissao -> slugExist($_POST['edslug']);
            
            //Se não for dubplicado
            if ($duplicado == false) {
                //Pegar Valores
                $arrayModel = array(
                    'permissao'  => strtoupper(trim($_POST['edpermissao'])),
                    'ordem'      => $_POST['edordem'],
                    'slug'       => strtoupper($_POST['edslug'])
                );

                //Retorno do Banco de dados
                $retBD = $vPermissao -> addPermissao($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, 1, "Adicionou o Item de Permissao ". strtoupper($_POST['edpermissoes']));

                    //Voltar para pagina apos salvar
                    $_SESSION['successMsg'] = 'Registro Adicionado com sucesso!';
                    header("location: ".BASE_URL.'/permissao');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'Erro ao Salvar! Os dados não foram inseridos.';
                    header("location: ".BASE_URL.'/permissao');
                    exit;
                }    
                
            } else {
                //Se for duplicado Voltar para pagina
                $_SESSION['errorMsg'] = 'Já existe um registro com este valor!';
                header("location: ".BASE_URL.'/permissao');
                exit;
            } 
            
        }
    }  
    
    
    //Deletar Registro
    public function delMod($prmId) {
        //verificar se tem permissão para Excluir Registro
        if (!$this->login->hasPermissao('N_DELREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Excluir Registro.';
            header("location: ".BASE_URL.'/permissao');
            exit;
        }

        //Instanciar Item
        $vPermissao = new Permissao();
        
        if (!empty($prmId) && isset($prmId)) {
            //Pegar no Nome do Item
            $dados = $vPermissao->getPermissao($prmId);
            $nPermissao = $dados['prm_permissao'];
            
            //Retorno do Banco de dados
            $retBD = $vPermissao->delPermissao($prmId);
            if ($retBD){
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, 1, "Excluiu o registro da Permissao ". $nPermissao);

                //Retornar para Pagina
                $_SESSION['successMsg'] = 'Registro Excluido com sucesso!';
                header('location: '.BASE_URL.'/permissao');
            } else {
                //Erro ao Salvar
                $_SESSION['errorMsg'] = 'Erro! O Registro não foi Excluido.';
                header("location: ".BASE_URL.'/permissao');
                exit;
            }    
        } else {
            //Voltar se não encontrar
            $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
            header("location: ".BASE_URL.'/permissao');
            exit;
        }    
    }
    
    
    //Editar Registro 
    public function editMod($prmId) {
        //verificar se tem permissão para Alterar Registro
        if (!$this->login->hasPermissao('N_EDITREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Alterar Registro.';
            header("location: ".BASE_URL.'/permissao');
            exit;
        }

        //Instanciar Item
        $vPermissao = new Permissao();

        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edpermissao']) OR empty($_POST['edslug'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/permissao');
            exit;

        } else {
        
            //Verificar se ID existe ou esta vazio
            if (!empty($prmId) && isset($prmId)) {
                //Pegar Valores
                $arrayModel = array(
                    'permissao'  => strtoupper($_POST['edpermissao']),
                    'ordem'      => $_POST['edordem'],
                    'prmId'      => $prmId
                );
                
                //Retorno do Banco de dados
                $retBD = $vPermissao ->editPermissao($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, 1, "Alterou o registro da Permissao ".strtoupper($_POST['edpermissao']));

                    //Voltar para pagina
                    $_SESSION['successMsg'] = 'Registro Alterado com sucesso!';
                    header("location: ".BASE_URL.'/permissao');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'Erro ao Salvar! Os dados não foram Alterados.';
                    header("location: ".BASE_URL.'/permissao');
                    exit;
                }    
                
            } else {
                //Voltar se não encontrar
                $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
                header("location: ".BASE_URL.'/permissao');
                exit;
            }
        }
    }  
    
}