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
    $id_externo;
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
        $rfc = $_POST['rfc'];
        $curp = $_POST['curp'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $email = $_POST['correo'];
        $genero = $_POST['genero'];
        $empresa = $_POST['empresa'];
        $zip = $_POST['zip'];
        $estado = $_POST['estado'];
        $city = $_POST['city'];
        //$telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $sector = $_POST['sector'];
        $funcion = $_POST['funcion'];

        //Revisar si la persona ya se registro a un diplomado
        $query = "SELECT curp FROM externos WHERE curp ='$curp'";
        $resultado = mysqli_query($conn, $query);
        $n = $resultado->num_rows;
        if($n > 0){
            $externo = "SELECT id, email FROM externos where curp = '$curp'";
            $res_externo = mysqli_query($conn, $externo);
            while($rows = mysqli_fetch_array($res_externo)){
                $id_externo = $rows[0];
                $correo_registrado = $rows[1];
            }
            $query_curso = "SELECT id FROM course_externos WHERE id_externo ='$id_externo' AND id_course = 3";
            $res = mysqli_query($conn, $query_curso);
            $m = $res->num_rows;
            if($m > 0){
                $valido['success']=false;
                $valido['mensaje']="Usted ya se encuentra inscrito en el Diplomado Ciencia de Datos. Favor de revisar su bandeja de entrada del correo registrado para consultar las instrucciones correspondientes";
            }else{
                $course_externo = "INSERT INTO course_externos (id_externo, id_course, date_registro) VALUES (
                    '".$id_externo."',
                    '".$curso."',
                    '".$date."')";
                $r=mysqli_query($conn, $course_externo);
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
                $valido['mensaje']="Registro guardado con exito. Las instrucciones correspondientes se le enviaran al correo registrado\n\n
                NOTA: Si colocaste algún dato incorrecto o no recibes el correo con las indicaciones, favor de comunicarte al correo soporte_tecnico_diplomados1@aguascalientes.tecnm.mx";
            }
        }else{
            $insertar="insert into externos (rfc,curp,firstname,lastname,email,gender,empresa,zip,id_state,ciudad, celular, sector, funcion) values(
                '".$rfc."',
                '".$curp."',
                '".$name."',
                '".$lastname."',
                '".$email."',
                '".$genero."',
                '".$empresa."',
                '".$zip."',
                '".$estado."',
                '".$city."',
                '".$celular."',
                '".$sector."',
                '".$funcion."')";
            if(mysqli_query($conn, $insertar)){
                $externo = "SELECT id FROM externos where curp = '$curp'";
                $res_externo = mysqli_query($conn, $externo);
                while($rows = mysqli_fetch_array($res_externo)){
                    $id_externo = $rows[0];
                }
                $course_externo = "INSERT INTO course_externos (id_externo, id_course, date_registro) VALUES (
                    '".$id_externo."',
                    '".$curso."',
                    '".$date."')";
                if(mysqli_query($conn, $course_externo)){
                    //Correo para las personas nuevas
                    $mail->setFrom('soporte_tecnico_diplomados1@aguascalientes.tecnm.mx','FOPRODE');
                    $mail->addAddress($email, $name." ".$lastname);
                    //Content
                    $mail->isHTML(true);
                    $mail->CharSet = 'UTF-8';
                    $mail->Subject = 'Inscripción al Diplomado Ciencia de Datos';
                    $mail->Body    = 'Bienvenido al <b>Diplomado Ciencia de Datos.</b>
                        <br>
                        Por medio de este correo confirmamos su inscripción al <b>Diplomado Ciencia de Datos</b>. 
                        <br>
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
                    die(mysqli_error($conn));
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