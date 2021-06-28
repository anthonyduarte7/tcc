<?php
try{
    @DEFINE("SERVIDOR","localhost");
    @DEFINE("BANCO","projeto");
    @DEFINE("USUARIO","root");
    @DEFINE("SENHA","");

    $conectar = new PDO("mysql:host=".SERVIDOR.";dbname=".BANCO,USUARIO,SENHA);
    $conectar -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){
    echo "houve um erro no código: ". $erro ->getMessage();

}
?>