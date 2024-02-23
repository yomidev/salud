<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    require_once 'conexion.php';
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    $valido['success'] = array('success' => false, 'mensaje' => "");

    //Variables globales
    $id_alumno;
    $date = date("Y-m-d");
    $curso = 3;
    $correo_registrado;

    //Configuracion para correo

    $mail = new PHPMailer;
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                     
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.office365.com';                
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'soporte_tecnico_diplomados1@aguascalientes.tecnm.mx';   
    $mail->Password   = 'Mielsanmarcos24.';                               
    $mail->SMTPSecure = 'STARTTLS'; 
    $mail->Port       = 587; 

    if($_POST){
        $num_control = $_POST['num_control'];
        $curp = $_POST['curp'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $school = $_POST['school'];
        $estado = $_POST['state'];
        $ciudad = $_POST['city'];
        $genero = $_POST['genero'];


        //Verificar si ya existe el registro
        $query = "SELECT id FROM students WHERE email ='$email' OR curp = '$curp'";
        $resultado = mysqli_query($conn, $query);
        $n = $resultado->num_rows;
        if($n > 0){
            //Verificar si ya se registro en el diplomado
            $query_alumno = "SELECT id, email FROM students WHERE curp ='$curp'";
            $res = mysqli_query($conn, $query_alumno);
            while($rows = mysqli_fetch_array($res)){
                $id_alumno = $rows[0];
                $correo_registrado = $rows[1];
            }
            $query_course = "SELECT * FROM course_students WHERE id_student='$id_alumno' AND id_course = 3";
            $res2 = mysqli_query($conn, $query_course);
            $m = $res2->num_rows;
            if($m > 0){
                $valido['success']=false;
                $valido['mensaje']="Usted ya se encuentra inscrito en el Diplomado Ciencia de Datos. Favor de revisar su bandeja de entrada del correo registrado para consultar las instrucciones correspondientes";
            }else{
                $course_student = "INSERT INTO course_students (id_student, id_course, date_registro) VALUES (
                    '".$id_alumno."',
                    '".$curso."',
                    '".$date."')";
                $r=mysqli_query($conn, $course_student);
                //Correo para las personas que ya se registraron en ambos diplomados
                $mail->setFrom('soporte_tecnico_diplomados1@aguascalientes.tecnm.mx','FOPRODE');
                $mail->addAddress($correo_registrado, $name." ".$lastname);
                //Content
                $mail->isHTML(true); 
                $mail->CharSet = 'UTF-8';                                 
                $mail->Subject = 'Inscripción al Diplomado Ciencia de Datos';
                $mail->Body    = 'Bienvenido al <b>Diplomado Ciencia de Datos.</b>
                <br>
                Por medio de este correo confirmamos su inscripción al <b>Diplomado Ciencia de Datos</b>. 
                Detectamos que tu registro ya se encuentra dado de alta en nuestra plataforma debido a que has tomado algún otro diplomado; 
                por lo tanto tus accesos serán los siguientes:
                <br>
                Link de acceso a plataforma virtual<br>
                <a href=http://foprodesemiconductores.aguascalientes.tecnm.mx/aula/ target=_blank>http://foprodesemiconductores.aguascalientes.tecnm.mx/aula/</a><br>
                Sus accesos son los siguientes: <br>
                <ul>
                    <li><b>Usuario: </b>'.$curp.'</li>
                    <li><b>Contraseña: </b>Tu contraseña actual</li>
                </ul>
                <p>Nota: Recuerde que la contraseña al momento de ingresar por primera vez al sistema; se le pedirá el cambio de contraseña</p>
                <p><b>Si no recuerdas tu contraseña favor de comunicarte al siguiente correo: soporte_tecnico_diplomados1@aguascalientes.tecnm.mx para poder apoyarte con el ingreso</b></p>
                <p><em>Favor de no responder este correo</em></p>
                Saludos
                ';
                //Enviar correo
                $mail->send();
                $valido['success']=true;
                $valido['mensaje']="Registro guardado con exito. Las instrucciones correspondientes se le enviaran al correo registrado
                NOTA: Si colocaste algún dato incorrecto o no recibes el correo con las indicaciones, favor de comunicarte al correo soporte_tecnico_diplomados1@aguascalientes.tecnm.mx";
            }
        }else{
            //Insertar nuevo registro a tabla de estudiantes
            $insertar="insert into students (num_control,curp,firstname,lastname,email,id_state,id_tecnologico,city,gender) values(
                '".$num_control."',
                '".$curp."',
                '".$name."',
                '".$lastname."',
                '".$email."',
                '".$estado."',
                '".$school."',
                '".$ciudad."',
                '".$genero."')";
            if(mysqli_query($conn, $insertar)) {
                //Consultar el id del registro insertado
                $query_alumno2 = "SELECT id FROM students WHERE curp ='$curp'";
                $res3 = mysqli_query($conn, $query_alumno2);
                while($rows2 = mysqli_fetch_array($res3)){
                    $id_alumno = $rows2[0];
                }
                $course_student2 = "INSERT INTO course_students (id_student, id_course, date_registro) VALUES (
                    '".$id_alumno."',
                    '".$curso."',
                    '".$date."')";
                if(mysqli_query($conn, $course_student2)){
                    //Correo para las personas nuevas
                    $mail->setFrom('soporte_tecnico_diplomados1@aguascalientes.tecnm.mx','FOPRODE');
                    $mail->addAddress($email, $name." ".$lastname);
                    //Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = 'Inscripción al Diplomado Ciencia de Datos';
                    $mail->Body    = 'Bienvenido al <b>Diplomado Ciencia de Datos.</b>
                    <br>
                    Por medio de este correo confirmamos su inscripción al <b>Diplomado Ciencia de Datos</b>.<br>
                    Link de acceso a plataforma virtual<br>
                    <a href=http://foprodesemiconductores.aguascalientes.tecnm.mx/aula/ target=_blank>http://foprodesemiconductores.aguascalientes.tecnm.mx/aula/</a><br>
                    Sus accesos son los siguientes: <br>
                    <ul>
                        <li><b>Usuario: </b>'.$curp.'</li>
                        <li><b>Contraseña: </b>Prueba123$</li>
                    </ul><br>
                    Nota: Recuerde que la contraseña al momento de ingresar por primera vez al sistema; se le pedirá el cambio de contraseña<br>
                    <p><em>Favor de no responder este correo</em></p>
                    Saludos
                    ';
                    //Enviar correo
                    $mail->send();
                    $valido['success']=true;
                    $valido['mensaje']="Registro guardado con exito. Las instrucciones correspondientes se le enviaran al correo registrado\n\n
                    NOTA: Si colocaste algún dato incorrecto o no recibes el correo con las indicaciones, favor de comunicarte al correo soporte_tecnico_diplomados1@aguascalientes.tecnm.mx";
                }else{
                    $valido['success']=false;
                    $valido['mensaje']="Algo salio mal. Intente nuevamente. Si el problema persiste favor de contactar a soporte técnico.";
                }
            }else{
                $valido['success']=false;
                $valido['mensaje']="Algo salio mal. Intente nuevamente. Si el problema persiste favor de contactar a soporte técnico.";
            }
        }
    }else{
        $valido['success']=false;
        $valido['mensaje']="Algo salio mal. Intente nuevamente. Si el problema persiste favor de contactar a soporte técnico.";
    }
    echo json_encode($valido);
?>