<?php
class grupoController extends Controller 
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
            'menu' => 'grupo',
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
        $vGrupo = new Grupo();
        $vPermissao = new Permissao();
        
        //Listas da pagina
        $this->arrayView['listGrupos'] = $vGrupo->getGruposNivel($this->nivel);
        $this->arrayView['listPermissoes'] = $vPermissao->getPermissoesNivel($this->nivel);

        //Vai pra Pagina de Grupos
        $this->loadTemplate('grupoList', $this->arrayView);
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
        
        //Instanciar
        $vGrupo = new Grupo();
        $vPermissao = new Permissao();
        
        //Listas da pagina
        $this->arrayView['listPermissoes'] = $vPermissao->getPermissoesNivel($this->nivel);
        
        //Vai pra Pagina de Grupos
        $this->loadTemplate('grupoAdd', $this->arrayView);
    }
    
    //Abrir a Pagina de Edição
    public function editar($grpId) {
        
        //Verificar se ID existe ou esta vazio
        if (!empty($grpId) && isset($grpId)) {
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

            //Instanciar Grupo
            $vGrupo = new Grupo();
            $vPermissao = new Permissao();

            //Listas da pagina
            $this->arrayView['listPermissoes'] = $vPermissao->getPermissoesNivel($this->nivel);
            $this->arrayView['Grupo'] = $vGrupo->getGrupo($grpId);
            $this->arrayView['listLinks'] = $vGrupo->permissoesBy($grpId);

            //Vai pra Pagina de Grupos
            $this->loadTemplate('grupoEdit', $this->arrayView);
        }  else {
            //Retornar a Pagina de Listagem
            header('location: '.BASE_URL.'/grupo');
        }  
    }
    
    //Deletar Registro
    public function delMod($grpId) {
        //verificar se tem permissão para Excluir Registro
        if (!$this->login->hasPermissao('N_DELREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Excluir Registro.';
            header("location: ".BASE_URL.'/grupo');
            exit;
        }

        //Instanciar Grupo
        $vGrupo = new Grupo();
        
        if (!empty($grpId) && isset($grpId)) {
            //Pegar no Nome do Curso
            $dados = $vGrupo->getGrupo($grpId);
            $nGrupo = $dados['grp_grupo'];
        
            //Deleta o Grupo
            $vGrupo->delGrupo($grpId);
            
            //Limpar os Links
            $vGrupo -> clearLinks($grpId);
            
            //Lançamento no historico
            $log = new Historico();
            $log->registrar($this->login -> userId, $this->login -> userUnidade, "Excluiu o registro do Grupo ". $nGrupo);

            //Retornar a Pagina de Listagem
            $_SESSION['successMsg'] = 'Registro Excluido com sucesso!';
            header('location: '.BASE_URL.'/grupo');
        } else {
            
            //Voltar para Grupo List
            $_SESSION['errorMsg'] = 'Nenhum registro foi encontrado.';
            header("location: ".BASE_URL.'/grupo');
            exit;
        }    
    }
    
    
    //Adicionar Registro no modal
    public function addMod() {
        //verificar se tem permissão para Adicionar Registro
        if (!$this->login->hasPermissao('N_ADDREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Adicionar Registro.';
            header("location: ".BASE_URL.'/grupo');
            exit;
        }

        //Instanciar Grupo
        $vGrupo = new Grupo();

        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edgrupo'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/grupo');
            exit;

        } else {
        
            //Verificar Duplicidade
            $duplicado = $vGrupo ->grupoExist($_POST['edgrupo']);
            
            //Se não for dubplicado
            if ($duplicado == false) {
                //Pegar o nome do grupo
                $grupo = strtoupper(trim($_POST['edgrupo']));
                $grpId = $vGrupo->addGrupo($grupo);
                
                //Lançamento no historico
                $log = new Historico();
                $log->registrar($this->login -> userId, $this->login -> userUnidade, "Adicionou o Grupo ". $grupo);
                

                //Verificar se existe Permissões para Salvar
                if (isset($_POST['permissoes']) && count($_POST['permissoes']) > 0) {
                    $permissoes = $_POST['permissoes'];
                    //Adicionar na Tabela
                    foreach ($permissoes as $linha) {
                        $vGrupo -> addPermissoes($linha, $grpId);
                    }
                }
                
                //Voltar para Grupo List
                $_SESSION['successMsg'] = 'Registro Adicionado com sucesso!';
                header("location: ".BASE_URL.'/grupo');
                exit;
                
            } else {
                
                //Se for duplicado Voltar para pagina
                $_SESSION['errorMsg'] = 'Já existe um registro com este valor!';
                header("location: ".BASE_URL.'/grupo');
                exit;
            } 
        } 
    } 
    
    //Editar Registro
    public function EditMod($grpId) {
        //verificar se tem permissão para Alterar Registro
        if (!$this->login->hasPermissao('N_EDITREG')){
            $_SESSION['errorMsg'] = 'Você não tem Privilégio de Alterar Registro.';
            header("location: ".BASE_URL.'/grupo');
            exit;
        }

        //Verificar se campo existe ou esta vazio
        if (empty($_POST['edgrupo'])) {
        
            //Voltar se não preencher todos os campos
            $_SESSION['errorMsg'] = 'ERRO AO SALVAR! Preencha todos os Campos.';
            header("location: ".BASE_URL.'/grupo');
            exit;

        } else {

            //Verificar se ID existe ou esta vazio
            if (!empty($grpId) && isset($grpId)) {
                //Instanciar Grupo
                $vGrupo = new Grupo();

                if (!empty($_POST['edgrupo'])) {
                    //Pegar o nome do grupo
                    $grupo = strtoupper($_POST['edgrupo']);
                    //$grpId = $vGrupo->addGrupo($grupo);
                    
                    //Alterar o nome do Grupo
                    $vGrupo -> editGrupo($grupo, $grpId);
                    
                    //Lançamento no historico
                    $log = new Historico();
                    $log->registrar($this->login -> userId, $this->login -> userUnidade, "Alterou o registro do Grupo ".$grupo);
                    
                    //Limpar os Links
                    $vGrupo -> clearLinks($grpId);

                    //Verificar se existe Permissões para Salvar
                    if (isset($_POST['permissoes']) && count($_POST['permissoes']) > 0) {
                    $permissoes = $_POST['permissoes'];
                    
                        foreach ($permissoes as $linha) {
                            $vGrupo -> addPermissoes($linha, $grpId);
                        }
                    }
                        
                    //Voltar para Grupo List
                    $_SESSION['successMsg'] = 'Registros Alterados com sucesso!';
                    header("location: ".BASE_URL.'/grupo');
                    exit;    

                } else {

                    //Voltar para Grupo List
                    $_SESSION['errorMsg'] = 'Nenhum registro foi encontrado.';
                    header("location: ".BASE_URL.'/grupo');
                    exit;
                }
            
            } else {
                
                //Voltar para Grupo List
                $_SESSION['errorMsg'] = 'Nenhum registro foi encontrado.';
                header("location: ".BASE_URL.'/grupo');
                exit;
            }

        }
        
    } 
    
}