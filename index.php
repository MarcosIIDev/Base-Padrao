<?php
session_start();

//Conexão com BD
require 'config/Conexao.php';

//Criando o Autoload
spl_autoload_register(function($class){
    if (file_exists('app/controllers/'.$class.'.php')){
        //Procurar na Pasta Controller
        require 'app/controllers/'.$class.'.php';
        
    } else if (file_exists('app/models/'.$class.'.php')) {
       //Procurar na Pasta Model
        require 'app/models/'.$class.'.php'; 
    } else if (file_exists('config/'.$class.'.php')) {
       //Procurar na Pasta Config
        require 'config/'.$class.'.php'; 
    }
});

//Instanciando a Classe Application
$app =  new Application();
$app -> run();

