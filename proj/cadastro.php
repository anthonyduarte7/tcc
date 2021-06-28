

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cadrasto de Clientes</h1>
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
                <h3 class="card-title">Cadastro de Clientes</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" id="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome" placeholder="Digite o nome do cliente..." required="">
                  </div>
                  <div class="form-group">
                    <label for="numero">Número:</label>
                    <input type="text" class="form-control" name="numero" placeholder="Digite o número do cliente..." required="">
                  </div>
                  <div class="form-group">
                    <label for="carro">Modelo do carro:</label>
                    <input type="text" class="form-control" name="carro" placeholder="Digite o modelo do carro do cliente...">
                  </div>
                  <div class="form-group">
                    <label for="produto">Produto:</label>
                    <input type="text" class="form-control" name="produto" placeholder="Digite o produto do cliente...">
                  </div>
                  <div class="form-group">
                    <label for="servico">Serviço:</label>
                    <input type="text" class="form-control" name="servico" placeholder="Digite o serviço desejado pelo cliente...">
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="botao1" class="btn-lg btn-danger">Cadastrar cliente</button>
                </div>
              </form>
              <?php
                include("conexao.php");
                if(isset($_POST["botao1"])){
                  $nome=$_POST["nome"];
                  $numero=$_POST["numero"];
                  $carro=$_POST["carro"];
                  $produto=$_POST["produto"];
                  $servico=$_POST["servico"];

                  $inserir = "INSERT INTO skyline(nome,numero,carro,produto,servico) VALUES(:nome,:numero,:carro,:produto,:servico)";

                  try{
                    $resultado = $conectar -> prepare($inserir);
                    $resultado -> bindParam(":nome",$nome,PDO::PARAM_STR);
                    $resultado -> bindParam(":numero",$numero,PDO::PARAM_STR);
                    $resultado -> bindParam(":carro",$carro,PDO::PARAM_STR);
                    $resultado -> bindParam(":produto",$produto,PDO::PARAM_STR);
                    $resultado -> bindParam(":servico",$servico,PDO::PARAM_STR);
                    $resultado -> execute();

                    $contar = $resultado -> rowCount();
                    if($contar > 0){
                      echo " <div class='card-body'>             <div class='alert alert-danger alert-dismissible' style>
                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                      <h5><i class=' icon fas fa-check'></i>Os dados foram enviados!</h5>
                    </div></div>";

                    }else{
                      echo "Erro";
                    }
                  }catch(PDOException $erro){
                    echo "Houve um erro no codigo" . $erro ->getMessage();
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
                      <th>Ações</th>
                    </tr>
                  </thead>

                  <?php
                    $selecionar = "SELECT * FROM skyline ORDER BY id DESC";

                    try{
                      $resultadoSelect = $conectar -> prepare($selecionar);
                      $resultadoSelect -> execute();

                      $number = 1;
                      $contarSelect = $resultadoSelect -> rowCount();
                      if($contarSelect > 0){
                        while($mostrar = $resultadoSelect -> FETCH(PDO::FETCH_OBJ)){
                    ?>
                    <tr>
                    <td><?php echo $number++;?></td>
                    <td><?php echo $mostrar -> nome; ?></td>
                    <td><?php echo $mostrar -> numero; ?></td>
                    <td><?php echo $mostrar -> carro; ?></td>
                    <td><?php echo $mostrar -> produto; ?></td>
                    <td><?php echo $mostrar -> servico; ?></td>
                    <td><div class="btn-group"><a href="proj/comp/delete.php?id=<?php echo $mostrar -> id; ?>" onclick="return confirm('Tem certeza que deseja deletar esse contato?')">
                          <button type="button" class="btn btn-default"><i class="fas fa-trash-alt" style="color: crimson"></i></button></a>
                        <a href="proj/edit.php?id=<?php echo $mostrar -> id; ?>">
                          <button type="button" class="btn btn-default"><i class="fas fa-user-edit" style="color: crimson"></i></button></a></div>  
                          </td>
                    </tr>
                    <?php
                        }
                      }
                    }catch(PDOException $erro){
                      echo "Houve um erro: " .$erro -> getMessage();
                    }
                    
                    ?>

                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#" style="color: crimson">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#" style="color: crimson">1</a></li>
                  <li class="page-item"><a class="page-link" href="#" style="color: crimson">2</a></li>
                  <li class="page-item"><a class="page-link" href="#" style="color: crimson">3</a></li>
                  <li class="page-item"><a class="page-link" href="#" style="color: crimson">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->
          </div>    
        </div>
      </div>
     </section>

  </div> 
         