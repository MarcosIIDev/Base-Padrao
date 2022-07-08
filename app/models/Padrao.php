<?php
Class Padrao extends Model 
{
    //tbpadrao ->
    //Padrao ->
    //padrao ->
    //pad_ ->
    //padId ->

    //Listagem de Todos os Registros
    public function getPadraosAll() {
        $array = array();
        
        $sql = "SELECT * FROM tbpadrao";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Registros Ativos
    public function gePadraosAtivo() {
        $array = array();
        
        $sql = "SELECT * FROM tbpadrao WHERE pad_ativo = 'S'";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Dados do Registro
    public function getPadrao($padId) {
        $array = array();
        
        $sql = "SELECT * FROM tbpadrao WHERE pad_id = :padrao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':padrao', $padId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    
    //Pegar o ultimo Registro
    public function getUltimoReg() {
        $reg = 0;
        
        $sql = "SELECT pad_id FROM tbpadrao ORDER BY pad_id DESC limit 1 ";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch();
            $reg = $dados['pad_id'];
        }
        
        return $reg;
    }
      
    
    //Vericar Duplicidade
    public function padraoExist($padrao) {
        $sql = "SELECT * FROM tbpadrao WHERE pad_padrao = :padrao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':padrao', $padrao);
        $sql -> execute();

        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }    
    

    //Adicionar Padrao
    public function addPadrao($arrayModel) {
        $sql =  "INSERT INTO tbpadrao (pad_padrao)
                 VALUES(:padrao)";
        $sql =  $this->conexao->prepare($sql);
        $sql -> bindValue(':padrao', $arrayModel['padrao']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    
    //Deletar Padrao
    public function delPadrao($padId) {
        $sql = "DELETE FROM tbpadrao WHERE pad_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':id', $padId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    
    //Editar Padrao
    public function editPadrao($arrayModel) {
        $sql = "UPDATE tbpadrao SET pad_padrao = :padrao WHERE pad_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':padrao', $arrayModel['padrao']);
        $sql -> bindValue(':id', $arrayModel['padId']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }

    //Conjunto de outra Tabela
    //public function parcelasBy($contrato) {

    //Verificar
    //public function checkPadrao($id) {    
    
}