<?php
Class Grupo extends Model 
{
    //Listagem de Grupos
    public function getGruposAll() {
        $array = array();
        
        $sql = "SELECT tbgrupo.*, 
                (SELECT COUNT(tbusuario.usu_id) FROM tbusuario WHERE tbusuario.usu_grupo = tbgrupo.grp_id) as TOTAL_USER 
                FROM tbgrupo WHERE grp_id > 1";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Grupos por Nivel
    public function getGruposNivel($nivel) {
        $array = array();
        
        $sql = "SELECT tbgrupo.*, 
                (SELECT COUNT(tbusuario.usu_id) FROM tbusuario WHERE tbusuario.usu_grupo = tbgrupo.grp_id) as TOTAL_USER 
                FROM tbgrupo WHERE grp_id > $nivel";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Permissoes
    public function getPermissoesAll() {
        $array = array();
        
        $sql = "SELECT * FROM tbpermissao ORDER BY prm_slug";
        $sql = $this->conexao->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }
        
        return $array;
    }
    
    
    //Listagem de Permissoes por Grupo
    public function permissoesBy($usuGrupo) {
        $array = array();
        
        $sql = "SELECT * FROM tbpermlink WHERE lnk_grupo = :grupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $usuGrupo);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $dados = $sql->fetchAll();
            
            $perm_list = array();
                    
            foreach ($dados as $permissoes){
               $perm_list[] =  $permissoes['lnk_permissao'];
            } 
            
            //Verificar as permissoes
            $sql = "SELECT * FROM tbpermissao WHERE prm_id IN (".implode(",", $perm_list).")";
            $sql = $this->conexao->query($sql);
                      
            if ($sql->rowCount() > 0) {
                $dados = $sql->fetchAll();
                
                foreach ($dados as $linhas) {
                    $array[] = $linhas['prm_slug'];
                }
            }
        }
        
        return $array;
    }
    
    
    //Verificar Duplicidade
    public function grupoExist($grupo) {
        $sql = "SELECT * FROM tbgrupo WHERE grp_grupo = :ngrupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':ngrupo', $grupo);
        $sql -> execute();

        if ($sql->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE; 
        }
    }    
    
    
    //Pesquisa de dados do Grupo
    public function getGrupo($grpId) {
        $array = array();
        
        $sql = "SELECT * FROM tbgrupo WHERE grp_id = :grupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $grpId);
        $sql -> execute();
        
        if ($sql->rowCount() > 0){
            $array = $sql->fetch();
        }    
        
         return $array;
    }
    
    
    //Excluir Grupo
    public function delGrupo($grpId) {
        //Verificar se tem alguma usuario utilizando o grupo
        $sql = "SELECT * FROM tbusuario WHERE usu_grupo = :grupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $grpId);
        $sql -> execute();
        
        if ($sql->rowCount() === 0) {
            //Excluir os link da tabelea usuario link
            $sql = "DELETE FROM tbpermlink WHERE lnk_grupo = :grupo";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':grupo', $grpId);
            $sql -> execute();
            
            //Excluir o grupo na tabela usuario grupo
            $sql = "DELETE FROM tbgrupo WHERE grp_id = :grupo";
            $sql = $this->conexao->prepare($sql);
            $sql -> bindValue(':grupo', $grpId);
            $sql -> execute();
        }
    }
    
    
    //Adicionar Grupo
    public function addGrupo($grupo) {
        $sql = "INSERT INTO tbgrupo SET grp_grupo = :grupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $grupo);
        $sql -> execute();
        
        //Retorna o Id do ultimo inserido
        return $this->conexao->lastInsertId();
    }
    
    
    //Adicionar Itens de Permissão
    public function addPermissoes($permissao, $grpId) {
        $sql = "INSERT INTO tbpermlink SET lnk_grupo = :grpId, lnk_permissao = :permissao";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grpId', $grpId);
        $sql -> bindValue(':permissao', $permissao);
        $sql -> execute();
    }
    
    
    //Editar Grupo
    public function editGrupo($grpGrupo, $grpId) {
        $sql = "UPDATE tbgrupo SET grp_grupo = :grupo WHERE grp_id = :id";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $grpGrupo);
        $sql -> bindValue(':id', $grpId);
        $sql -> execute();
    }
    
    
    //Limpar links relacionados do Grupo
    public function clearLinks($grpId) {
        //Excluir os link da tabelea usuario link
        $sql = "DELETE FROM tbpermlink WHERE lnk_grupo = :grupo";
        $sql = $this->conexao->prepare($sql);
        $sql -> bindValue(':grupo', $grpId);
        $sql -> execute();
    }        
}