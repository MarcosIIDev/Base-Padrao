<?php
class Model 
{
    //Variavel protegida
    protected $conexao;

    //Construct
    public function __construct() {
        //Variavel global - Conexao
        global $conexao;
        $this->conexao = $conexao;
    }

}