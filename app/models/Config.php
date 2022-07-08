<?php
Class Config extends Model 
{
    //Backup de Banco de Dados
    public function setBackupDB()
    {
        //Recebe o Tipo de Conexao
        $tipo_conexao = $_SERVER['HTTP_HOST'];

        //Verifica qual credencial usar
        if (($tipo_conexao == 'localhost:8080') || ($tipo_conexao == '127.0.0.1')){
            //Se a conexão for Local
            $HOST   = "C:/wamp/bin/mariadb/mariadb10.4.10/bin/mysqldump ";
            $DBNAME = "bco_padrao > ";
            $DBUSER = "-u root";
            $DBPASS = " ";

        }else{
            //para uso externo
            $HOST   = "mysqldump ";
            $DBNAME = "lukas087_bco_padrao > ";
            $DBUSER = "-u lukas087_banco";
            $DBPASS = "-pluka228672 ";
        }

        //nome do Arquivo
        $nArquivo = date('Ymd');
        $nArquivo = 'assets/backup/bco_'.$nArquivo.'.sql';


        //Executar o Comando
        exec($HOST.$DBUSER.$DBPASS.$DBNAME.$nArquivo);
    }  
 
}