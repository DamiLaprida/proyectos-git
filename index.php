<?php

include_once 'conexion.php';

//Leer
$sql_leer = 'SELECT * FROM colores';
$gsent = $pdo -> prepare($sql_leer);
$gsent -> execute();

$resultado = $gsent->fetchAll();

//var_dump($resultado);

//Agregar
if ($_POST){
  $color = $_POST['color'];
  $descripcion = $_POST['descripcion'];

  $sql_agregar = 'INSERT INTO colores (color , descripcion) VALUES (?,?)'; //con ? , ? evitas SQL injection
  $sentencia_agregar = $pdo->prepare($sql_agregar);
  $sentencia_agregar->execute(array($color,$descripcion));

  header('location:index.php');
}
if ($_GET){
  $id = $_GET['id'];
  $sql_unico = 'SELECT * FROM colores WHERE id = ?';
  $gsent_unico = $pdo->prepare($sql_unico);
  $gsent_unico->execute(array($id));

  $resultado_unico = $gsent_unico->fetch();

  //var_dump($resultado_unico);
}
 ?>
 <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b3ab404e6b.js" crossorigin="anonymous"></script>

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
            <?php
                foreach($resultado as $dato): ?>


          <div class="alert alert-<?php echo $dato['color'] ?> text-uppercase" role="alert">
           <?php echo $dato['color'] ?>
           -
           <?php echo $dato['descripcion'] ?>

           <a href="eliminar.php?id=<?php echo $dato['id'] ?>" class = "float-right ml-3" >
              <i class="fas fa-trash"></i>
           </a>

           <a href="index.php?id=<?php echo $dato['id'] ?>" class="float-right">
             <i class="fas fa-user-edit"></i>
           </a>
    </div>
  <?php endforeach ?>
    </div>
          <div class="col-md-6">
            <?php if(!$_GET): ?>
            <h2>AGREGAR ELEMENTOS</h2>
            <form  method="POST">
              <label>Color</label>
              <input type="text" class = "form-control" name = "color" ><br>
              <label>Descripción</label>
              <input type="text" class = "form-control mt-1" name = "descripcion">
              <button  class = "btn btn-primary mt-3">Agregar</button>
            </form>
          <?php endif ?>

          <?php if($_GET): ?>
          <h2>EDITAR ELEMENTOS</h2>
          <form  method="GET" action="editar.php">
            <label>Color</label>
            <input type="text" class = "form-control" name = "color" value = "<?php echo $resultado_unico['color'] ?>"><br>
            <label>Descripción</label>
            <input type="text" class = "form-control mt-1" name = "descripcion" value = "<?php echo $resultado_unico['descripcion'] ?>">
            <input type="hidden"  name="id" value="<?php echo $resultado_unico['id'] ?>">
            <button  class = "btn btn-primary mt-3">Agregar</button>
          </form>
        <?php endif ?>

          </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
