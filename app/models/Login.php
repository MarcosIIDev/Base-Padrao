<?php
class Login extends Model 
{
    private $Permissoes;
    public $userId;
    public $userNome;
    public $userUnidade;
    public $userFoto;
    public $userGrupo;
    
    //Verificar se o Usuario esta logado
    public function isLogado() {
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            
            $sql = "SELECT * FROM tbusuario, tbgrupo, tbunidade WHERE usu_unidade = und_id AND usu_grupo = grp_id AND usu_token = :token";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':token', $token);
            $sql -> execute();
            
            if ($sql->rowCount() > 0){
                
                //Usuarios
                $dados = $sql->fetch();
                $this->userId    = $dados['usu_id'];
                $this->userNome  = $dados['usu_usuario'];
                $this->userUnidade  = $dados['usu_unidade'];
                $this->userFoto  = $dados['usu_foto'];
                $this->userGrupo = $dados['grp_grupo'];
                
                
                //Permissoes
                $vGrupo = new Grupo();
                $this->Permissoes = $vGrupo->permissoesBy($dados['usu_grupo']);
                               
                return TRUE;
            }
        } 
        
        return FALSE;
    }
    
    
    //Verificar se tem a permissão
    public function hasPermissao($permissao) {
        if (in_array($permissao, $this->Permissoes)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
        

    //Confirmar dados do Login
    public function confirmarLogin($login, $senha) {
        $sql = "SELECT * FROM tbusuario, tbgrupo, tbunidade WHERE usu_grupo = grp_id AND usu_unidade = und_id AND usu_login = :login AND usu_senha = :senha AND usu_ativo = 'S'";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':login', $login);
        $sql -> bindValue(':senha', $senha);
        $sql -> execute();

        if ($sql->rowCount() > 0){
            
            $dados = $sql->fetch();
            $this->userNome = $dados['usu_usuario'];
            
            $token = md5(time().rand(0, 9999).rand(0, 9999));
            
            //Atualizar o token
            $sql = "UPDATE tbusuario SET usu_token = :token WHERE usu_id = :id";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':token',$token );
            $sql -> bindValue(':id',$dados['usu_id']);
            $sql -> execute();
            
            //Criar a Sessão
            $_SESSION['token'] = $token;
            $this->userId    = $dados['usu_id'];
            $this->userNome  = $dados['usu_usuario'];
            $this->userUnidade  = $dados['usu_unidade'];
            $this->userFoto  = $dados['usu_foto'];
            $this->userGrupo = $dados['grp_grupo'];

            return TRUE;
        } 
        
        return FALSE;
    }
    
    
    //Verificar o email e enviar Email
    public function checkEmail($email) {
        //Verificar se o email existe na Base de Dados
        $sql = "SELECT * FROM tbusuario WHERE usu_email = '$email'";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0){
            //Se o email existir
            $dados = $sql -> fetch();
            
            //Gerar variaveis
            $usuId = $dados['usu_id'];
            $token = md5(time().rand(0, 99999).rand(0, 99999));
            $link  = BASE_URL."EsqueciMinhaSenha/redefinirSenha/".$token;
            
            //Insere dados na tabela Usuario Token
            $sql = "INSERT INTO tbusuariotoken (usu_usuarioid, usu_token) VALUES (:usuario, :token)";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':usuario', $usuId);
            $sql -> bindValue(':token', $token);
            $sql -> execute();
            
            //Enviar email
            $para = $email;
            $assunto = "Redefinição de Senha";
            $mensagem = "Clique no link para redefinir sua Senha: \r\n".$link;
            $cabecalho = "From: teste@sistemaweb.bsb.br"."\r\n".
                         "Reply-To: ".$email."\r\n".
                         "X-Mailer: PHP/".phpversion();

            //Verificar se esta no servidor
            $tipo_conexao = $_SERVER['HTTP_HOST'];
            
            if (($tipo_conexao == 'localhost') || ($tipo_conexao == '127.0.0.1')){
                //Emitir uma mensagem com erro
                echo $mensagem;
                exit;
            } else {
                mail($para, $assunto, $mensagem, $cabecalho);
            }    
            
            return TRUE;
        } 
        
        //Caso os dados não confirme
        return FALSE;
    }
    
    
    //Verificar o token para Alteracao de Senha
    public function checkToken($token) {
        //Verificar se o email existe na Base de Dados
        $sql = "SELECT * FROM tbusuariotoken WHERE usu_token = '$token' AND usu_valido = 'S'";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0){
            $dados = $sql -> fetch();
            
           return $dados['usu_usuarioid'];
        } else {
            return ""; 
        }
    } 
    
    
    //Altera Senha pelo Email
    public function alterarSenha($usuId, $senha) {
        $sql = "UPDATE tbusuario SET usu_senha = :senha WHERE usu_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':senha', md5($senha));
        $sql -> bindValue(':id', $usuId);
        $sql -> execute();
    }
    
    
    //Invalidar Token
    public function editToken($token)  {
        $sql = "UPDATE tbusuariotoken SET usu_valido = 'N' WHERE usu_token = :token";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':token', $token);
        $sql -> execute();
    }
    
}
