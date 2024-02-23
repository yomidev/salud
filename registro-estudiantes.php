<?php
    require_once 'php/conexion.php';
     //Consulta para cargar los tecnologicos

     $tec = "SELECT * FROM schools";
     $result = mysqli_query($conn, $tec);

     $state = "SELECT * FROM state";
     $result2 = mysqli_query($conn, $state);

     $course = "SELECT * FROM courses";
     $result3 = mysqli_query($conn, $course);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Estudiantes</title>
    <link rel="stylesheet" href="css/forms.css">
    <link rel="shortcut icon" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/dselect.js"></script>
</head>
<body>
    <header class="header-g">
        <nav id="barraGob">
            <div class="container-gob">
                <a style="float:left" class="navbar-brand-gob"  href="https://www.gob.mx/">
                    <embed src="https://framework-gb.cdn.gob.mx/landing/img/logoheader.svg" alt="Página de inicio, Gobierno de México">
                </a>
                <div class="barraGobmx-enlaces">
                    <a href="https://www.gob.mx/gobierno" title="Gobierno" class="nav-links">Gobierno</a>
                    <a href="https://www.gob.mx/participa" title="Participación Ciudadana" class="nav-links">Participa</a>
                    <a href="https://datos.gob.mx" title="Datos Abiertos" class="nav-links">Datos</a>
                </div>
            </div>
        </nav>
    </header>
    <header id="header-logo">
        <nav class="nav-logo">
            <div class="container-img">
                  <img src="img/gob-blanco.png" alt="" class="logo-gob">
                  <div class="line-border"></div>
                  <img src="img/sep-blanco.png" alt="" class="logo-sep">
                  <div class="line-border hidden2"></div>
                  <img src="img/logo_tecnm_white.png" alt="logo-tecnm" class="logo-tecnm">
                  <div class="line-border hidden2"></div>
                  <img src="img/ciencia-datos.png" alt="logo-tecnm" class="logo-sonora">
            </div>
        </nav>
    </header>
    <header id="menu">
        <nav class="navbar navbar-expand-lg nav-menu navbar-light" style="border-bottom: 1px solid #621132 !important;"> 
            <div class="container-fluid">
                <img src="#" alt="">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active text-uppercase fw-bold enlaces" aria-current="page" href="index.html">Inicio</a>
                  </li>
                  <!--<li class="nav-item">
                    <a class="nav-link active text-uppercase fw-bold enlaces" aria-current="page" href="docs/convocatoria.pdf" target="_blank">Convocatoria</a>
                  </li>-->
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-uppercase enlaces" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      REGISTRO
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="registro-estudiantes.php">ESTUDIANTE TECNM</a></li>
                      <li><a class="dropdown-item" href="registro-docentes.php">PROFESOR TECNM</a></li>
                      <li><a class="dropdown-item" href="registro-externos.php">PÚBLICO EN GENERAL</a></li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-uppercase enlaces" href="http://foprodesemiconductores.aguascalientes.tecnm.mx/login.php" target="_blank">Plataforma virtual</a>
                  </li>
                  <!--<li class="nav-item">
                    <a class="nav-link active text-uppercase fw-bold enlaces" aria-current="page" href="https://www.youtube.com/watch?v=4vjomyVJqfEf" target="_blank">Video de inducción</a>
                  </li>-->
                </ul>
              </div>
            </div>
        </nav>
    </header>
    <section class="container form-section">
        <h2 class="text-center title-form">Registro para Estudiantes TECNM</h2>
        <form id="form-estudiantes">
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="num_control" class="form-label">Nº de Control<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="num_control" name="num_control" required>
                </div>
                <div class="col-md-6">
                    <label for="curp" class="form-label">CURP<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="curp" name="curp" required style="text-transform: uppercase">
                </div>
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre(s)<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Apellidos<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electrónico<span style="color:red">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com">
                </div>
                <div class="col-md-6">
                    <label for="school" class="form-label">Tecnológico de Procedencia<span style="color:red">*</span></label>
                    <select name="select_box" id="select_box" class="form-select">
                        <option value="">Seleccione su Tecnológico de Procedencia</option>
                        <?php
                            foreach($result as $r){
                                echo '<option value="'.$r["id"].'">'.$r["name"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="genero" class="form-label">Genero<span style="color:red">*</span></label>
                    <select id="genero" name="genero" class="form-select" required>
                        <option value="">Seleccione una opción</option>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Prefiero no decirlo">Prefiero no decirlo</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="state" class="form-label">Estado<span style="color:red">*</span></label>
                    <select name="select_box2" id="select_box2" class="form-select">
                        <option value="">Seleccione su Estado de Residencia</option>
                        <?php
                            foreach($result2 as $r2){
                                echo '<option value="'.$r2["id"].'">'.$r2["state"].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="name" class="form-label">Cuidad</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="col-12">
                    &nbsp;
                    &nbsp;
                    <p><span style="color:red">*</span>Los campos marcados con asterisco son requeridos</p>
                    &nbsp;
                    &nbsp;
                    <button type="button" class="btn btn-primary btn-lg" onclick="registroEstudiantes()">Registrarme</button>
                </div>
            </div>
        </form>
    </section>
    <footer class="container-fluid p-4 footer responsive">
        <div class="img-footer">
            <img src="img/logo_tecnm_white.png" alt="" >
        </div>
        <div class="copyright">
            <a href="https://www.tecnm.mx/menu/proteccion_datos_personales/Aviso_de_Privacidad_Integral.pdf?doc=1" target="_blank" class="aviso">Aviso de Privacidad</a>
            <p>&copy; 2023 Tecnológico Nacional de México</p>
        </div>
        <div class="contact">
            <h5 class="title-footer">Informes</h5>
            <!--<p class="email-contact">Diplomado Semiconductores: <br><a href="mailto:">dip.semiconductores@tecnm.mx</a>
            <br><span><img src="img/download.png" alt=""> <a href="docs/convocatoria.pdf" target="_blank" class="convocatoria">Descargar Convocatoria</a></span></p>-->
        </div>
    </footer>
    <!--Modal de Aviso-->
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atención</h5>
            </div>
            <div class="modal-body">
                <img src="img/alert.png" alt="" class="img-modal" width="150px">
                <p>Estimad@: <br>
                    El registro para esta convocatoria ha concluido.      
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    <!--Fin Modal de Aviso-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="js/registro.js"></script>
    <script src="js/validacion.js"></script>
</body>
</html>
<script>
   /* $(document).ready(function(){
        $("#myModal").modal('show');
    });*/
    let select_box_element = document.querySelector('#select_box');
    dselect(select_box_element, {
      search: true
    });
    let select_box_element2 = document.querySelector('#select_box2');
    dselect(select_box_element2, {
      search: true
    });
    let select_box_element3 = document.querySelector('#genero');
    dselect(select_box_element3, {
      search: true
    });
</script>