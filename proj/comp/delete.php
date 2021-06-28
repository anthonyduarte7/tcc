<?php
    include("../conexao.php");
    if(isset($_GET["id"])){
        $id = $_GET["id"];

        $deletar = "DELETE FROM skyline WHERE id=:id";

        try{
            $resultadoDeletar = $conectar -> prepare($deletar);
            $resultadoDeletar -> bindValue(":id",$id,PDO::PARAM_INT);
            $resultadoDeletar -> execute();

            $contarDeletar = $resultadoDeletar -> rowCount();
            if($contarDeletar > 0){
                header("Location: ../../home.php");
            }else{
                header("Location: ../../home.php");
            }
        }catch(PDOException $erro){
            echo "Houve um erro" . $erro -> getMessage();
        }
    }else{
        header("Location: ../../home.php");
    }

?>