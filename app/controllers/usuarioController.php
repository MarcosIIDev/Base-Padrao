<?php
class usuarioController extends Controller 
{
    private $login;
    private $arrayView;
    private $nivel;
    
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
        
        //Verificando Nivel de Permissão
        if (!$this->login->hasPermissao('SUPER_ADMIN')){
           $this->nivel = 1;
        }else{
            $this->nivel = 0;
        }
        
        //Array da pagina - View
        $this->arrayView = array(
            'user' => $this->login,
            'menu' => 'usuario',
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
        
        //Instanciar Usuario
        $vUsuario = new Usuario();
        
        //Listas da pagina
        $this->arrayView['listUsuarios'] = $vUsuario->getUsuariosAll($this->nivel);

        //Vai pra Pagina de Usuarios
        $this->loadTemplate('usuarioList', $this->arrayView);
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
        $vGrupo = new Grupo();
        
        //Listas da pagina
        $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAtivo();
        $this->arrayView['listGrupos'] = $vGrupo->getGruposNivel($this->nivel);
        
        //Vai pra Pagina de Usuarios
        $this->loadTemplate('usuarioAdd', $this->arrayView);
    }
    
    
    //Abrir a Pagina de Edição
    public function Editar($usuId) {
        //Verificar se ID existe ou esta vazio
        if (!empty($usuId) && isset($usuId)) {
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
            $vUsuario = new Usuario();
            $vUnidade = new Unidade();
            $vGrupo   = new Grupo();

            //Listas da pagina
            $this->arrayView['Usuario'] = $vUsuario->getUsuario($usuId);
            $this->arrayView['listUnidades'] = $vUnidade->getUnidadesAtivo();
            $this->arrayView['listGrupos'] = $vGrupo->getGruposNivel($this->nivel);

            //Vai pra Pagina de Usuarios
            $this->loadTemplate('usuarioEdit', $this->arrayView);
            
        }  else {
            //Retornar a Pagina de Listagem
            header('location: '.BASE_URL.'/usuario');
        }  
    }
    
          
    //Adicionar Registro
    public function addMod() {
        //verificar se tem permissão para Adicionar Registro
        if (!$this->login->hasPermissao('N_ADDREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Adicionar Registro.';
            header("location: ".BASE_URL.'/usuario');
            exit;
        }

        //Instanciar Usuario
        $vUsuario = new Usuario();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edusuario']) OR empty($_POST['edemail']) OR empty($_POST['edlogin']) OR empty($_POST['edsenha'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/usuario');
            exit;

        } else {
                
            //Verificar Duplicidade
            $duplicado = $vUsuario ->nomeExist($_POST['edusuario']);
            
            //Se não for dubplicado
            if ($duplicado == false) {
                //Pegar o Ultimo Registro
                $ultimoReg = $vUsuario->getUltimoReg() + 1;
                $nArquivo  = $ultimoReg  . '.jpg';
                $caminho_imagem = PATH_USER . $nArquivo;
                
                //Pegar Valores
                $arrayModel = array(
                    'usuario' => strtoupper(trim($_POST['edusuario'])),
                    'email'   => strtolower($_POST['edemail']),
                    'login'   => strtolower(trim($_POST['edlogin'])),
                    'senha'   => md5($_POST['edsenha']),
                    'grupo'   => $_POST['edgrupo'],
                    'unidade' => $_POST['edunidade'],
                    'ativo'   => $_POST['edativo'],
                    'foto'    => (empty($_FILES["edfile"]['tmp_name'])) ? 'no-photo.png' : $nArquivo,
                    'obs'     => $_POST['edobs']
                );
                
                //Se o File não estiver vazio Faz o upload da imagem
                if (!empty($_FILES["edfile"]['tmp_name'])){
                    move_uploaded_file($_FILES["edfile"]['tmp_name'], $caminho_imagem);
                }    

                //Retorno do Banco de dados
                $retBD = $vUsuario -> addUsuario($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Adicionou o Usuario(a) ". strtoupper($_POST['edusuario']));

                    //Voltar para pagina apos salvar
                    $_SESSION['successMsg'] = 'Registro Adicionado com sucesso!';
                    header("location: ".BASE_URL.'/usuario');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Os dados não foram inseridos.';
                    header("location: ".BASE_URL.'/usuario');
                    exit;
                }
                
                
            } else {
                //Se for duplicado Voltar para pagina
                $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Já existe um registro com este valor!';
                header("location: ".BASE_URL.'/usuario');
                exit;
            } 
            
        }
    }  
    
    
    //Deletar Registro
    public function delMod($usuId) {
        //verificar se tem permissão para Excluir Registro
        if (!$this->login->hasPermissao('N_DELREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Excluir Registro.';
            header("location: ".BASE_URL.'/usuario');
            exit;
        }

        //Instanciar Usuario
        $vUsuario = new Usuario();
        
        //Pegar no Nome do Arquivo
        $dados = $vUsuario->getUsuario($usuId);
        $nArquivo = ($dados['usu_foto'] == 'no-photo.png') ? $dados['usu_id'].'.jpg' : $dados['usu_foto'];
        
        //Verificar se ID existe ou esta vazio
        if (!empty($usuId) && isset($usuId)) {
        
            //Retorno do Banco de dados
            $retBD = $vUsuario->delUsuario($usuId);
            if ($retBD){
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, $this->login -> userUnidade, "Excluiu o registro do Usuario(a) ". strtoupper($dados['usu_usuario']));

                //Verifica se o arquivo existe e deleta
                if (file_exists(PATH_USER.$nArquivo)) {
                    unlink(PATH_USER.$nArquivo);
                }  

                //Retornar para Pagina
                $_SESSION['successMsg'] = 'Registro Excluido com sucesso!';
                header('location: '.BASE_URL.'/usuario');
                exit;
            } else {
                //Erro ao Salvar
                $_SESSION['errorMsg'] = 'Erro! O Registro não foi Excluido.';
                header("location: ".BASE_URL.'/usuario');
                exit;
            }
            
            
        } else {
            //Voltar se não encontrar
            $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
            header("location: ".BASE_URL.'/usuario');
            exit;
        }
    }
    
    
    //Editar Registro 
    public function editMod($usuId) {
        //verificar se tem permissão para Alterar Registro
        if (!$this->login->hasPermissao('N_EDITREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Alterar Registro.';
            header("location: ".BASE_URL.'/usuario');
            exit;
        }

        //Instanciar Usuario
        $vUsuario = new Usuario();
        
        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edusuario']) OR empty($_POST['edemail']) OR empty($_POST['edlogin']) OR empty($_POST['edsenha'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/usuario');
            exit;

        } else {



            if (!empty($usuId) && isset($usuId)) {
                //Pegar no Nome do Arquivo
                $dados = $vUsuario->getUsuario($usuId);
                $nArquivo = ($dados['usu_foto'] == 'no-photo.png') ? $dados['usu_id'].'.jpg' : $dados['usu_foto'];
                $caminho_imagem = PATH_USER . $nArquivo;
                
                //Pegar Valores
                $arrayModel = array(
                    'usuario' => strtoupper(trim($_POST['edusuario'])),
                    'login'   => strtolower(trim($_POST['edlogin'])),
                    'email'   => strtolower($_POST['edemail']),
                    'grupo'   => $_POST['edgrupo'],
                    'unidade' => $_POST['edunidade'],
                    'foto'    => empty($_FILES["edfile"]['tmp_name']) ? $dados['usu_foto'] : $nArquivo,
                    'ativo'   => $_POST['edativo'],
                    'obs'     => $_POST['edobs'],
                    'usuId'   => $usuId
                );
                
                //Verifica se o arquivo foi atualizado
                if (!empty($_FILES['edfile']['name'])){
                    // Faz o upload da imagem para seu respectivo caminho
                    move_uploaded_file($_FILES['edfile']['tmp_name'], $caminho_imagem);
                }
                
                //Retorno do Banco de dados
                $retBD = $vUsuario -> editUsuario($arrayModel);
                if ($retBD){
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Alterou o registro do Usuario(a) ".strtoupper($_POST['edusuario']));
                    
                    //Voltar para pagina
                    $_SESSION['successMsg'] = 'Registro Alterado com sucesso!';
                    header("location: ".BASE_URL.'/usuario');
                    exit;
                } else {
                    //Erro ao Salvar
                    $_SESSION['errorMsg'] = 'Erro ao Salvar! Os dados não foram Alterados.';

                    //Verifica se a Foto foi atualizada
                    if (!empty($_FILES['edfile']['name'])){
                        $_SESSION['errorMsg'] = '';
                        $_SESSION['successMsg'] = 'Fotografia Alterada com sucesso!';
                    }

                    //Voltar para pagina
                    header("location: ".BASE_URL.'/usuario');
                    exit;
                }

                
            } else {
                //Voltar se não encontrar
                $_SESSION['errorMsg'] = 'Nenhum registro foi selecionado.';
                header("location: ".BASE_URL.'/usuario');
                exit;
            }
        }
    }  
}