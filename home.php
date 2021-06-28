<?php
    include_once("header.php");
    if(isset($_GET["acao"])){
        $acao = $_GET["acao"];
        if($acao == "bemvindo"){
            include_once("proj/cadastro.php");
        }elseif($acao == "editar"){
            include_once("proj/edit.php");
        }
    }else{
        include_once("proj/cadastro.php");
    }
    include_once("rodape.php");
?>