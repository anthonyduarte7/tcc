<!DOCTYPE html>
<html lang="pt_br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Oficina Skyline | Edição</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: crimson"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../home.php" class="brand-link">
      <img src="../img/WhatsApp_Image_2021-06-01_at_21.37.12-removebg-preview.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="color: crimson">Oficina Skyline</span>
    </a>

   
  </aside>
                <?php
                    include("conexao.php");
                    if(!isset($_GET["id"])){
                        header("Location: ../home.php");
                        exit;
                    }
                    $id= filter_input(INPUT_GET,'id',FILTER_DEFAULT);
                    $selecionar = "SELECT * FROM skyline WHERE id=:id";
                    try{
                        $resultado = $conectar -> prepare($selecionar);
                        $resultado -> bindParam(":id",$id,PDO::PARAM_INT);
                        $resultado -> execute();

                        $contar = $resultado -> rowCount();
                        if($contar > 0){
                            while($mostrar = $resultado -> FETCH(PDO::FETCH_OBJ)){
                                $idCont = $mostrar -> id;
                                $nome = $mostrar -> nome;
                                $numero = $mostrar -> numero;
                                $carro = $mostrar -> carro;
                                $produto = $mostrar -> produto;
                                $servico = $mostrar -> servico;
                            }
                        }else{
                            echo "ERRO! Não há dados com esse ID";
                        }
                    }catch(PDOException $erro){
                        echo "ERRO de select no PDO" . $erro -> getMessage();
                    }
                ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edição de Clientes</h1>
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Atualização de cadastro</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control" name="numero" value="<?php echo $numero ?>" required="">
                  </div>
                  <div class="form-group">
                    <label for="carro">Modelo do carro:</label>
                    <input type="text" class="form-control" name="carro" value="<?php echo $carro ?>">
                  </div>
                  <div class="form-group">
                    <label for="produto">Produto:</label>
                    <input type="text" class="form-control" name="produto" value="<?php echo $produto ?>">
                  </div>
                  <div class="form-group">
                    <label for="servico">Serviço:</label>
                    <input type="text" class="form-control" name="servico" value="<?php echo $servico ?>">
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="editcontato" class="btn-lg btn-danger">Atualizar cliente</button>
                </div>
              </form>
 
                    <?php
                        include("conexao.php");
                        if(isset($_POST["editcontato"])){
                            $nome = $_POST["nome"];
                            $numero = $_POST["numero"];
                            $carro = $_POST["carro"];
                            $produto = $_POST["produto"];
                            $servico = $_POST["servico"];

                            $modificar = "UPDATE skyline SET nome=:nome,numero=:numero,carro=:carro,produto=:produto,servico=:servico WHERE id=:id";
                            try{
                                $resultadoEdit = $conectar -> prepare($modificar);
                                $resultadoEdit -> bindParam(":id",$id,PDO::PARAM_INT);
                                $resultadoEdit -> bindParam(":nome",$nome,PDO::PARAM_STR);
                                $resultadoEdit -> bindParam(":numero",$numero,PDO::PARAM_STR);
                                $resultadoEdit -> bindParam(":carro",$carro,PDO::PARAM_STR);
                                $resultadoEdit -> bindParam(":produto",$produto,PDO::PARAM_STR);
                                $resultadoEdit -> bindParam(":servico",$servico,PDO::PARAM_STR);
                                $resultadoEdit -> execute();

                                $contarEdit = $resultadoEdit -> rowCount();
                                if($contarEdit > 0){
                                    header("Refresh:2, ../home.php");
                                    echo "<div class='card-body'>             <div class='alert alert-danger alert-dismissible' style>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    <h5><i class=' icon fas fa-check'></i>Os dados foram modificados com sucesso!</h5>
                                  </div></div>";
                                }else{
                                    echo "ERRO os dados nao foram enviados";
                                }
                            }catch(PDOException $erroEdit){
                                echo "Houve um erro no codigo" . $erroEdit ->getMessage();
                            }
                        }
                    ?>

            </div>
          </div>
        </div>
      </div>
    </section> 
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
          <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Clientes</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Nome</th>
                      <th>Número</th>
                      <th>Modelo do carro</th>
                      <th>Produto</th>
                      <th>Serviço</th>
                      
                    </tr>
                  </thead>
                  <tr>
                    <td><?php echo $idCont ?></td>
                    <td><?php echo $nome ?></td>
                    <td><?php echo $numero ?></td>
                    <td><?php echo $carro ?></td>
                    <td><?php echo $produto ?></td>
                    <td><?php echo $servico ?></td>
                  </tr>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>    
        </div>
      </div>
     </section>

  </div>
  <footer class="main-footer">
    <strong  style="color:crimson">Copyright &copy; 2021- Oficina Skyline</a>.</strong>
    Todos os direitos reservados.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
</body>
</html>     