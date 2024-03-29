<!DOCTYPE html>
<!doctype html>
<html lang="es">
  <?php 
  include_once("class/proyecto.php");
  $proyecto = new proyecto();

  $proyectos = $proyecto->get_all();
  
  foreach ($proyectos as $elemento) {
    var_dump($elemento);
  }

  ?>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Tablero - organizador</title>
  </head>
  <body>
  	<div class="container-fluid">
  		<div class="row">
  			<div class="col-md-3 bg-dark pt-5 pb-5 pl-0 pr-0">
  				<ul class="nav flex-column">
  					<li class="nav-item"><a href="#" class="nav-link active">Principal</a></li>
  					<li class="nav-item"><a href="#" class="nav-link">Proyectos</a></li>
  					<li class="nav-item"><a href="#" class="nav-link">Usuarios</a></li>
  					<li class="nav-item"><a href="#" class="nav-link">Estados</a></li>
  				</ul>
  			</div>
  			<div class="col-md-9">
  				<div class="row">
            <div class="col-12">
              <p class="h1">Nuestros proyectos</p>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="#">id</th>
                    <th scope="#">Nombre</th>
                    <th scope="#">Estado</th>  
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</td>
                    <td>Proyecto 1</td>
                    <td>Estado</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
  			</div>
  		</div>
  	</div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  </body>
</html>