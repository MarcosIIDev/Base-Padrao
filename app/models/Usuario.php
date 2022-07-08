<?php
Class Usuario extends Model 
{
    //Listagem de Todos os Usuarios p/ Nivel
    public function getUsuariosAll($nivel) {
        $array = array();
        
        $sql = "SELECT * FROM tbusuario, tbgrupo, tbunidade WHERE usu_unidade = und_id AND usu_grupo = grp_id AND grp_id > $nivel ORDER BY usu_usuario";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Usuarios Ativos p/ Nivel
    public function getUsuariosAtivo($nivel) {
        $array = array();
        
        $sql = "SELECT * FROM tbusuario, tbgrupo, tbunidade WHERE usu_unidade = und_id AND usu_grupo = grp_id AND usu_ativo = 'S' AND grp_id > $nivel ORDER BY usu_usuario";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Dados do Usuario
    public function getUsuario($usuId) {
        $array = array();
        
        $sql = "SELECT * FROM tbusuario WHERE usu_id = :usuario";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':usuario', $usuId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    
    //Pegar o ultimo Registro
    public function getUltimoReg() {
        $reg = 0;
        
        $sql = "SELECT usu_id FROM tbusuario ORDER BY usu_id DESC limit 1 ";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            $reg = $dados['usu_id'];
        }
        
        return $reg;
    }
      
    
    //Vericar Duplicidade
    public function nomeExist($nome) {
        $sql = "SELECT * FROM tbusuario WHERE usu_usuario = :usuario";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':usuario', $nome);
        $sql -> execute();

        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }    
    

    //Adicionar Usuario
    public function addUsuario($arrayModel) {
        $sql =  "INSERT INTO tbusuario (usu_usuario, usu_email, usu_login, usu_senha, usu_grupo, usu_unidade, usu_ativo, usu_foto, usu_obs)
                 VALUES(:usuario, :email, :login, :senha, :grupo, :unidade, :ativo, :foto, :obs)";
        $sql =  $this->conexao->prepare($sql);
        $sql -> bindValue(':usuario', $arrayModel['usuario']);
        $sql -> bindValue(':email', $arrayModel['email']);
        $sql -> bindValue(':login', $arrayModel['login']);
        $sql -> bindValue(':senha', $arrayModel['senha']);
        $sql -> bindValue(':grupo', $arrayModel['grupo']);
        $sql -> bindValue(':unidade', $arrayModel['unidade']);
        $sql -> bindValue(':ativo', $arrayModel['ativo']);
        $sql -> bindValue(':foto', $arrayModel['foto']);
        $sql -> bindValue(':obs', $arrayModel['obs']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    
    //Deletar Usuario
    public function delUsuario($usuId) {
        $sql = "DELETE FROM tbusuario WHERE usu_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':id', $usuId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    
    //Editar Usuario
    public function editUsuario($arrayModel) {
        $sql = "UPDATE tbusuario SET usu_usuario = :usuario, usu_email= :email, usu_login = :login, usu_grupo = :grupo, 
                usu_unidade = :unidade, usu_ativo = :ativo, usu_foto = :foto, usu_obs = :obs WHERE usu_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':usuario', $arrayModel['usuario']);
        $sql -> bindValue(':email', $arrayModel['email']);
        $sql -> bindValue(':login', $arrayModel['login']);
        $sql -> bindValue(':grupo', $arrayModel['grupo']);
        $sql -> bindValue(':unidade', $arrayModel['unidade']);
        $sql -> bindValue(':ativo', $arrayModel['ativo']);
        $sql -> bindValue(':foto', $arrayModel['foto']);
        $sql -> bindValue(':obs', $arrayModel['obs']);
        $sql -> bindValue(':id', $arrayModel['usuId']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
}