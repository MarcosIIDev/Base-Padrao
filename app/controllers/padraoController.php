<?php
class padraoController extends Controller 
{
    //edpadrao ->
	//padrao ->
    //Padrao ->
    //padId ->
    //pad_ ->

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
        if (!$this->login->hasPermissao('ADD_USUARIO')){
            header("location: ".BASE_URL);
            exit;
        }
        
        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'menu' => 'padrao',
            'msgReturnErr' => '',
            'msgReturnSucc' => ''
        );
    }
    
    
    //Abrir a Pagina de Listagem
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
        
        //Instanciar
        $vPadrao = new Padrao();
        
        //Listas da pagina
        $this->arrayView['listPadraos'] = $vPadrao->getPadraosAll($this->nivel);

        //Vai pra Pagina de Listagem
        $this->loadTemplate('padraoList', $this->arrayView);
    }
    
    
    //Abrir a Pagina de Adicionar
    public function adicionar() {
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
        $vUnidade = new Unidade();
        
        //Listas da pagina
        $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAll();
        
        //Vai pra Pagina de Add
        $this->loadTemplate('padraoAdd', $this->arrayView);
    }
    
    
    //Abrir a Pagina de Edição
    public function Editar($padId) {
        //Verificar se ID existe ou esta vazio
        if (!empty($padId) && isset($padId)) {
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

            //Instanciar
            $vPadrao = new Padrao();
            $vUnidade = new Unidade();

            //Listas da pagina
            $this->arrayView['Padrao'] = $vPadrao->getPadrao($padId);
            $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAtivo();

            //Vai pra Pagina de Ediçao
            $this->loadTemplate('padraoEdit', $this->arrayView);
            
        }  else {
            //Retornar a Pagina de Listagem
            header('location: '.BASE_URL.'/padrao');
        }  
    }
    
          
    //Adicionar Registro
    public function addMod() {
        //verificar se tem permissão para Adicionar Registro
        if (!$this->login->hasPermissao('N_ADDREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Adicionar Registro.';
            header("location: ".BASE_URL.'/padrao');
            exit;
        }

        //Instanciar
        $vPadrao = new Padrao();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edpadrao']) OR empty($_POST['edpadrao'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos Obrigatórios.';
            header("location: ".BASE_URL.'/padrao');
            exit;

        } else {
                
            //Verificar Duplicidade
            $duplicado = $vPadrao ->padraoExist($_POST['edpadrao']);
            
            //Se não for dubplicado
            if ($duplicado == false) {
                //Pegar o Ultimo Registro
                //$ultimoReg = $vPadrao->getUltimoReg() + 1;
                //$nArquivo  = $ultimoReg  . '.jpg';
                //$caminho_imagem = PATH_USER . $nArquivo;

                //Pegar Valores
                $arrayModel = array(
                    'padrao' => strtoupper(trim($_POST['edpadrao'])),
                    'resp'    => strtoupper($_POST['edresp']),
                    'email'   => strtolower($_POST['edemail']),
                    'obs'     => $_POST['edobs'],
                    'grupo'   => 'GRUPO',
                    'data'    => ($_POST['eddata'] == '') ? NULL : implode('-', array_reverse(explode('/', $_POST['eddata']))),
                    'senha'   => md5($_POST['edsenha']),
                    'foto'    => (empty($_FILES["edfile"]['tmp_name'])) ? 'no-photo.png' : '**$nArquivo**',
                    
                );
                
                //Se o File não estiver vazio Faz o upload da imagem
                //if (!empty($_FILES["edfile"]['tmp_name'])){
                //    move_uploaded_file($_FILES["edfile"]['tmp_name'], $caminho_imagem);
                //}    

                //Retorno do Banco de dados
                $retBD = $vPadrao -> addPadrao($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Adicionou o Padrao ". strtoupper($_POST['edpadrao']));

                    //Voltar para pagina apos salvar
                    $_SESSION['successMsg'] = 'Registro Adicionado com sucesso!';
                    header("location: ".BASE_URL.'/padrao');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Os dados não foram inseridos.';
                    header("location: ".BASE_URL.'/padrao');
                    exit;
                }
                
                
            } else {
                //Se for duplicado Voltar para pagina
                $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Já existe um registro com este valor!';
                header("location: ".BASE_URL.'/padrao');
                exit;
            } 
            
        }
    }  
    
    
    //Deletar Registro
    public function delMod($padId) {
        //verificar se tem permissão para Excluir Registro
        if (!$this->login->hasPermissao('N_DELREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Excluir Registro.';
            header("location: ".BASE_URL.'/padrao');
            exit;
        }

        //Instanciar
        $vPadrao = new Padrao();
        
        //Pegar no Nome do Arquivo
        $dados = $vPadrao->getPadrao($padId);
        //$nArquivo = *** ($dados['pad_foto'] == 'no-photo.png') ? $dados['pad_id'].'.jpg' : $dados['pad_foto'];
        
        //Verificar se ID existe ou esta vazio
        if (!empty($padId) && isset($padId)) {
        
            //Retorno do Banco de dados
            $retBD = $vPadrao->delPadrao($padId);
            if ($retBD){
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, $this->login -> userUnidade, "Excluiu o registro do Padrao ". strtoupper($dados['pad_padrao']));

                //Verifica se o arquivo existe e deleta
                //if (file_exists(PATH_USER.$nArquivo)) {
                //    unlink(PATH_USER.$nArquivo);
                //}  

                //Retornar para Pagina
                $_SESSION['successMsg'] = 'Registro Excluido com sucesso!';
                header('location: '.BASE_URL.'/padrao');
                exit;
            } else {
                //Erro ao Salvar
                $_SESSION['errorMsg'] = 'ERRO! O Registro não foi Excluido.';
                header("location: ".BASE_URL.'/padrao');
                exit;
            }
            
            
        } else {
            //Voltar se não encontrar
            $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
            header("location: ".BASE_URL.'/padrao');
            exit;
        }
    }
    
    
    //Editar Registro 
    public function editMod($padId) {
        //verificar se tem permissão para Alterar Registro
        if (!$this->login->hasPermissao('N_EDITREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Alterar Registro.';
            header("location: ".BASE_URL.'/padrao');
            exit;
        }

        //Instanciar
        $vPadrao = new Padrao();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edpadrao']) OR empty($_POST['edpadrao'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/padrao');
            exit;

        } else {

            if (!empty($padId) && isset($padId)) {
                //Pegar no Nome do Arquivo
                $dados = $vPadrao->getPadrao($padId);
                //$nArquivo = ($dados['pad_foto'] == 'no-photo.png') ? $dados['pad_id'].'.jpg' : $dados['pad_foto'];
                //$caminho_imagem = PATH_USER . $nArquivo;
                
                //Pegar Valores
                $arrayModel = array(

                    'padId'   => $padId
                );
                
                //Verifica se o arquivo foi atualizado
                //if (!empty($_FILES['edfile']['name'])){
                //    // Faz o upload da imagem para seu respectivo caminho
                //    move_uploaded_file($_FILES['edfile']['tmp_name'], $caminho_imagem);
                //}
                
                //Retorno do Banco de dados
                $retBD = $vPadrao -> editPadrao($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Alterou o registro do Padrao ".strtoupper($_POST['edpadrao']));
                    
                    //Voltar para pagina
                    $_SESSION['successMsg'] = 'Registro Alterado com sucesso!';
                    header("location: ".BASE_URL.'/padrao');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Os dados não foram Alterados.';

                    //Verifica se a Foto foi atualizada
                    if (!empty($_FILES['edfile']['name'])){
                        $_SESSION['errorMsg'] = '';
                        $_SESSION['successMsg'] = 'Fotografia Alterada com sucesso!';
                    }

                    //Voltar para pagina
                    header("location: ".BASE_URL.'/padrao');
                    exit;
                }

                
            } else {
                //Voltar se não encontrar
                $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
                header("location: ".BASE_URL.'/padrao');
                exit;
            }
        }
    }  
}