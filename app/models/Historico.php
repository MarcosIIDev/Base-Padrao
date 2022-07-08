<?php
Class Historico extends Model 
{
    //Registrar Historico
    public function registrar($user, $unidade, $acao) {
        $sql = "INSERT INTO tbhistusuario SET hst_unidade = :unidade, hst_data = NOW(), hst_usuario = :user, hst_acao = :acao, hst_ativo = 'S'";
        $sql = $this->conexao->prepare($sql);
        $sql->bindValue (':user', $user);
        $sql->bindValue (':unidade', $unidade);
        $sql->bindValue (':acao', $acao);
        $sql->execute();
    }
    
    //Buscar Registro de Uniário
    public function getHistoricoList($usuario, $projeto) {
        $array = array();
        
        $sql = "SELECT * FROM tbhistusuario, tbusuario WHERE hst_usuario = usu_id AND hst_usuario = :usuario AND hst_projeto = :projeto ORDER BY hst_data DESC";
        $sql = $this->conexao->prepare($sql);
        $sql->bindValue (':usuario', $usuario);
        $sql->bindValue (':projeto', $projeto);
        $sql->execute();
        
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
}