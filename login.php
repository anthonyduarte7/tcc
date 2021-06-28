<?php
  ob_start();
  session_start();
  if(isset($_SESSION["usuario"]) && isset($_SESSION["senha"])){
    header("Location: home.php");
  }
?>

<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Oficina Skyline | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" style="">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-danger">
    <div class="card-header text-center">
      <a class="h1" style="color: crimson"><b>Oficina</b>Skyline</a>
    </div>
    <div class="card-body" >
      <p class="login-box-msg"></p>

      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="usuario" placeholder="Digite seu usuario" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope" style="color: crimson"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="senha" placeholder="Digite sua senha" required="">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"  style="color: crimson"></span>
            </div>
          </div>
        </div>
          <div class="col-12">
            <button type="submit" name="botao1" class="btn btn-danger btn-block">Acessar</button>
          </div>
          <!-- /.col -->
        </div>

        <?php
            include("proj/conexao.php");
            if(isset($_GET{"pg"})){
              $pg = $_GET["pg"];
              if($pg === "negado"){
                echo " <div class='card-body'>             <div class='alert alert-danger alert-dismissible' style>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h5><i class='icon fas fa-exclamation-triangle'></i>Acesso Negado</h5>
              </div></div>  ";
              }elseif($pg === "sair"){
                echo "<div class='card-body'>             <div class='alert alert-danger alert-dismissible' style>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                <h5><i class='icon fas fa-sad-tear'></i>Você Saiu do Sistema!</h5>
                Volte logo!
              </div></div>";
              }
            }
            if(isset($_POST{"botao1"})){
              $usuario = filter_input(INPUT_POST, "usuario", FILTER_DEFAULT);
              $senha = filter_input(INPUT_POST, "senha", FILTER_DEFAULT);
              $select = "SELECT * FROM tcc WHERE usuario=:usuario AND senha=:senha";

              try{
                $result = $conectar ->prepare($select);
                $result -> bindParam(":usuario",$usuario,PDO::PARAM_STR);
                $result -> bindParam(":senha",$senha,PDO::PARAM_STR);
                $result -> execute();

                $contar = $result -> rowCount();
                if($contar > 0){
                  $usuario = $_POST["usuario"];
                  $senha = $_POST["senha"];
                  $_SESSION["usuario"] = $usuario;
                  $_SESSION["senha"] = $senha;

                  header("Refresh:1, home.php");
                }else{
                  echo "<div class='card-body'>             <div class='alert alert-danger alert-dismissible' style>
                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                  <h5><i class='icon fas fa-exclamation-triangle'></i>Login falhou! Confira as informações</h5>
                </div></div>";
                }
              }catch(PDOException $erro){
                echo "Houve um erro" . $erro -> getMessage();
              }
            }
        ?>

      </form>

    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
