<?php
require 'php/conexion.php';

//Variables
$externo;
$docente;
$estudiante;
$tot;

//Array
$totales = [];

$sql = "SELECT count(*) total FROM externoss join course_externos as cd on cd.id_externo = s.id  where cd.id_course = 3";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $externo = $row["total"];
} else {
    echo "No se encontraron resultados.";
}

$sql2 = "SELECT count(*) total FROM docentes as d join course_docentes as cd on cd.id_docente = d.id where cd.id_course = 3";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    $row2 = $result2->fetch_assoc();
    $docente = $row2["total"];
} else {
    echo "No se encontraron resultados.";
}

$sql3 = "SELECT count(*) total FROM students as s join course_students as cd on cd.id_student = s.id  where cd.id_course = 3";
$result3 = $conn->query($sql3);

if ($result3->num_rows > 0) {
    $row3 = $result3->fetch_assoc();
    $estudiante = $row3["total"];
} else {
    echo "No se encontraron resultados.";
}

$tot = $estudiante + $docente + $externo;

//Guardar datos en el array
$totales = array(
    'Estudiantes' => $estudiante,
    'Docentes' => $docente,
    'Externos' => $externo,
    'Total' => $tot
);

//Docentes totales
$d_semi;
$d_litio;
$total_d;


$sql4 = "SELECT count(*) total FROM docentes as d join course_docentes as cd on cd.id_docente = d.id where cd.id_course = 1";
$result4 = $conn->query($sql4);
if ($result4->num_rows > 0) {
    $row4 = $result4->fetch_assoc();
    $d_semi = $row4["total"];
} else {
    echo "No se encontraron resultados.";
}

$sql5 = "SELECT count(*) total FROM docentes as d join course_docentes as cd on cd.id_docente = d.id where cd.id_course = 2";
$result5 = $conn->query($sql5);
if ($result5->num_rows > 0) {
    $row5 = $result5->fetch_assoc();
    $d_litio= $row5["total"];
} else {
    echo "No se encontraron resultados.";
}
$total_d = $d_semi + $d_litio;
$a_d = array(
    'Semiconductores' => $d_semi,
    'Litio' => $d_litio,
    'Total de Inscripciones' => $total_d
);

//Estudiantes totales
$es_semi;
$es_litio;
$total_es;


$sql6 = "SELECT count(*) total FROM students as s join course_students as cd on cd.id_student = s.id  where cd.id_course = 1";
$result6 = $conn->query($sql6);
if ($result6->num_rows > 0) {
    $row6 = $result6->fetch_assoc();
    $es_semi = $row6["total"];
} else {
    echo "No se encontraron resultados.";
}

$sql7 = "SELECT count(*) total FROM students as s join course_students as cd on cd.id_student = s.id where cd.id_course = 2";
$result7 = $conn->query($sql7);
if ($result7->num_rows > 0) {
    $row7 = $result7->fetch_assoc();
    $es_litio= $row7["total"];
} else {
    echo "No se encontraron resultados.";
}
$total_es = $es_semi + $es_litio;
$es_d = array(
    'Semiconductores' => $es_semi,
    'Litio' => $es_litio,
    'Total de Inscripciones' => $total_es
);

//Externos totales
$e_semi;
$e_litio;
$total_e;


$sql8 = "SELECT count(*) total FROM externos as s join course_externos as cd on cd.id_externo = s.id  where cd.id_course = 1";
$result8 = $conn->query($sql8);
if ($result8->num_rows > 0) {
    $row8 = $result8->fetch_assoc();
    $e_semi = $row8["total"];
} else {
    echo "No se encontraron resultados.";
}

$sql9 = "SELECT count(*) total FROM externos as s join course_externos as cd on cd.id_externo = s.id where cd.id_course = 2";
$result9 = $conn->query($sql9);
if ($result9->num_rows > 0) {
    $row9 = $result9->fetch_assoc();
    $e_litio= $row9["total"];
} else {
    echo "No se encontraron resultados.";
}
$total_e = $e_semi + $e_litio;
$e_d = array(
    'Semiconductores' => $e_semi,
    'Litio' => $e_litio,
    'Total de Inscripciones' => $total_e
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <title>Reporte General</title>
</head>
    <style>
        *{
            font-family: 'Montserrat', sans-serif;
        }
        h1{
            font-size: 2em;
            padding: 20px;
            text-align: center;
        }
        td{
            font-size: 12pt !important;
        }
    </style>
<body>
    <?php
        $labels = array_keys($totales); // Estados
        $data = array_values($totales); // Total de personas por estado

        $labels2 = array_keys($a_d); // Estados
        $data2 = array_values($a_d); // Total de personas por estado

        $labels3 = array_keys($es_d); // Estados
        $data3 = array_values($es_d); // Total de personas por estado

        $labels4 = array_keys($e_d); // Estados
        $data4 = array_values($e_d); // Total de personas por estado
    ?>
    <h1>Estadísticas Generales</h1>

    <h1>Totales Generales</h1>
    <div class="container d-flex">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tipo de Usuario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Estudiantes</td>
                    <td><?php echo $estudiante?></td>
                </tr>
                <tr>
                    <td>Docentes</td>
                    <td><?php echo $docente?></td>
                </tr>
                <tr>
                    <td>Externos</td>
                    <td><?php echo $externo?></td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td><?php echo $tot?></td>
                </tr>
            </tbody>
        </table>
        <div class="chart-container" style="position: relative; height:60vh; width:80vw">
             <canvas id="chart"></canvas>
        </div>
    </div>

    <!--<h1>Totales Generales Docentes</h1>
    <div class="container d-flex justify-content-start">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Diplomado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Semiconductores</td>
                    <td><?php echo $d_semi?></td>
                </tr>
                <tr>
                    <td>Litio</td>
                    <td><?php echo $d_litio?></td>
                </tr>
                <tr>
                    <td>Total de Inscripciones</td>
                    <td><?php echo $total_d?></td>
                </tr>
            </tbody>
        </table>
        <div class="chart-container" style="position: relative; height:60vh; width:80vw">
            <canvas id="chart1"></canvas>
        </div>
    </div>

    <h1>Totales Generales Estudiantes</h1>
    <div class="container d-flex" style="justify-content: space-between;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Diplomado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Semiconductores</td>
                    <td><?php echo $es_semi?></td>
                </tr>
                <tr>
                    <td>Litio</td>
                    <td><?php echo $es_litio?></td>
                </tr>
                <tr>
                    <td>Total de Inscripciones</td>
                    <td><?php echo $total_es?></td>
                </tr>
            </tbody>
        </table>
        <div class="chart-container" style="position: relative; height:40vh; width:100vw">
            <canvas id="chart2"></canvas>
        </div>
    </div>

    <h1>Totales Generales Externos</h1>
    <div class="container d-flex justify-content-start">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Diplomado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Semiconductores</td>
                    <td><?php echo $e_semi?></td>
                </tr>
                <tr>
                    <td>Litio</td>
                    <td><?php echo $e_litio?></td>
                </tr>
                <tr>
                    <td>Total de Inscripciones</td>
                    <td><?php echo $total_e?></td>
                </tr>
            </tbody>
        </table>
        <div class="chart-container" style="position: relative; height:40vh; width:100vw">
            <canvas id="chart3"></canvas>
        </div>
    </div>-->

    <script>
        var ctx = document.getElementById('chart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Personas Inscritas',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(146, 0, 10, 1)', // Color de fondo de las barras
                    borderColor: 'rgba(0, 0, 0, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }   
                },
                responsive: true,
                maintainAspectRatio: false,
                width: 500,
                height: 300,
            }
        });
        var ctx2 = document.getElementById('chart1').getContext('2d');
        var chart2 = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels2); ?>,
                datasets: [{
                    label: 'Personas Inscritas',
                    data: <?php echo json_encode($data2); ?>,
                    backgroundColor: 'rgba(146, 0, 10, 1)', // Color de fondo de las barras
                    borderColor: 'rgba(0, 0, 0, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }   
                },
                responsive: true,
                maintainAspectRatio: false,
                width: 500,
                height: 300,
            }
        });
        var ctx3 = document.getElementById('chart2').getContext('2d');
        var chart3 = new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels3); ?>,
                datasets: [{
                    label: 'Personas Inscritas',
                    data: <?php echo json_encode($data3); ?>,
                    backgroundColor: 'rgba(146, 0, 10, 1)', // Color de fondo de las barras
                    borderColor: 'rgba(0, 0, 0, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }   
                },
                responsive: true,
                maintainAspectRatio: false,
                width: 500,
                height: 300,
            }
        });
        var ctx4 = document.getElementById('chart3').getContext('2d');
        var chart4 = new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels4); ?>,
                datasets: [{
                    label: 'Personas Inscritas',
                    data: <?php echo json_encode($data4); ?>,
                    backgroundColor: 'rgba(146, 0, 10, 1)', // Color de fondo de las barras
                    borderColor: 'rgba(0, 0, 0, 1)', // Color del borde de las barras
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0
                    }   
                },
                responsive: true,
                maintainAspectRatio: false,
                width: 500,
                height: 300,
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>