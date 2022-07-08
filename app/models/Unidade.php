<?php
Class Unidade extends Model 
{
    //Listagem de Todas Unidade
    public function getUnidadesAll() {
        $array = array();
        
        $sql = "SELECT * FROM tbunidade";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Unidades Ativas
    public function getUnidadesAtivo() {
        $array = array();
        
        $sql = "SELECT * FROM tbunidade WHERE und_ativo = 'S' ORDER BY und_unidade";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }

    
    //Dados da Unidade
    public function getUnidade($undId) {
        $array = array();
        
        $sql = "SELECT * FROM tbunidade WHERE und_id = :unidade";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':unidade', $undId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    
    //Verificar Duplicidade
    public function unidadeExist($unidade) {
        $sql = "SELECT * FROM tbunidade WHERE und_unidade = :unidade";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':unidade', $unidade);
        $sql -> execute();

        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }    
    

    //Adicionar Unidade
    public function addUnidade($arrayModel) {
        $sql =  "INSERT INTO tbunidade (und_unidade, und_end, und_bairro,  
                   und_cidade, und_uf, und_cep, und_fone1, und_fone2, und_email, und_resp, und_respfone, und_ativo, und_obs)
                   VALUES(:unidade, :end, :bairro, :cidade, :uf, :cep, :fone1, :fone2, :email, :resp,
                   :respfone, :ativo, :obs)";
        $sql =  $this->conexao->prepare($sql);
        $sql -> bindValue(':unidade', $arrayModel['unidade']);
        $sql -> bindValue(':end', $arrayModel['end']);
        $sql -> bindValue(':bairro', $arrayModel['bairro']);
        $sql -> bindValue(':cidade', $arrayModel['cidade']);
        $sql -> bindValue(':uf', $arrayModel['uf']);
        $sql -> bindValue(':cep', $arrayModel['cep']);
        $sql -> bindValue(':fone1', $arrayModel['fone1']);
        $sql -> bindValue(':fone2', $arrayModel['fone2']);
        $sql -> bindValue(':email', $arrayModel['email']);
        $sql -> bindValue(':resp', $arrayModel['resp']);
        $sql -> bindValue(':respfone', $arrayModel['respfone']);
        $sql -> bindValue(':ativo', $arrayModel['ativo']);
        $sql -> bindValue(':obs', $arrayModel['obs']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    //Deletar Unidade
    public function delUnidade($undId) {
        $sql = "DELETE FROM tbunidade WHERE und_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':id', $undId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
    
    //Editar Unidade
    public function editUnidade($arrayModel) {
        $sql = "UPDATE tbunidade SET und_unidade = :unidade, und_end = :end, und_bairro = :bairro, und_cidade = :cidade, und_uf = :uf, und_cep = :cep, und_fone1 = :fone1, 
                   und_fone2 = :fone2, und_email = :email, und_resp = :resp, und_respfone = :respfone, und_ativo = :ativo, und_obs = :obs WHERE und_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':unidade', $arrayModel['unidade']);
        $sql -> bindValue(':end', $arrayModel['end']);
        $sql -> bindValue(':bairro', $arrayModel['bairro']);
        $sql -> bindValue(':cidade', $arrayModel['cidade']);
        $sql -> bindValue(':uf', $arrayModel['uf']);
        $sql -> bindValue(':cep', $arrayModel['cep']);
        $sql -> bindValue(':fone1', $arrayModel['fone1']);
        $sql -> bindValue(':fone2', $arrayModel['fone2']);
        $sql -> bindValue(':email', $arrayModel['email']);
        $sql -> bindValue(':resp', $arrayModel['resp']);
        $sql -> bindValue(':respfone', $arrayModel['respfone']);
        $sql -> bindValue(':ativo', $arrayModel['ativo']);
        $sql -> bindValue(':obs', $arrayModel['obs']);
        $sql -> bindValue(':id', $arrayModel['undId']);
        $sql -> execute();
        
        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }
        
}