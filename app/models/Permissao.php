<?php
Class Permissao extends Model 
{
    //Listagem de Permissão por Nivel
    public function getPermissoesNivel($nivel) 
    {
        $array = array();
        
        //$sql = "SELECT * FROM tbpermissao";
        $sql = "SELECT tbpermissao.*, 
                (SELECT COUNT(tbpermlink.lnk_id) FROM tbpermlink WHERE tbpermlink.lnk_permissao = tbpermissao.prm_id) as TOTAL_ITEM 
                FROM tbpermissao WHERE prm_id > $nivel 
                ORDER BY prm_ordem";
        
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    //Dados da Permissao
    public function getPermissao($prmId) 
    {
        $array = array();
        
        $sql = "SELECT * FROM tbpermissao WHERE prm_id = :permissao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':permissao', $prmId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    
    //Pesquisar Duplicidade
    public function slugExist($slug)
    {
        $sql = "SELECT * FROM tbpermissao WHERE prm_slug = :slug ORDER BY prm_ordem";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':slug', $slug);
        $sql -> execute();

        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    } 
    
    
    
    //Pesquisa de dados do Item
    public function checkPermissao($prmId) 
    {
        $array = array();
        
        $sql = "SELECT * FROM tbpermissao WHERE prm_id = :permissao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':permissao', $prmId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    //Excluir permissao
    public function delPermissao($prmId) 
    {
        //Verificar se tem alguma permissao utilizando o permissao
        $sql = "SELECT * FROM tbpermlink WHERE lnk_permissao = :permissao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':permissao', $prmId);
        $sql -> execute();
        
        if ($sql->rowCount() === 0) {
            //Excluir o permissao na tabela permissao permissao
            $sql = "DELETE FROM tbpermissao WHERE prm_id = :permissao";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':permissao', $prmId);
            $sql -> execute();
        }
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    //Adicionar Item
    public function addPermissao($arrayModel) 
    {
        $sql =  "INSERT INTO tbpermissao (prm_permissao, prm_ordem, prm_slug)
                 VALUES(:permissao, :ordem, :slug)";
        $sql =  $this->conexao->prepare($sql);
        $sql -> bindValue(':permissao', $arrayModel['permissao']);
        $sql -> bindValue(':slug', $arrayModel['slug']);
        $sql -> bindValue(':ordem', $arrayModel['ordem']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    //Editar Usuaio
    public function editPermissao($arrayModel) 
    {
        $sql = "UPDATE tbpermissao SET prm_permissao = :permissao, prm_ordem = :ordem WHERE prm_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':permissao', $arrayModel['permissao']);
        $sql -> bindValue(':ordem', $arrayModel['ordem']);
        $sql -> bindValue(':id', $arrayModel['prmId']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
        
}