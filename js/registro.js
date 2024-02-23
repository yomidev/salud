/*INICIA REGISTRO PARA ESTUDIANTES*/

const registroEstudiantes = async() =>{
    
    let num_control = document.querySelector("#num_control").value;
    let curp = document.querySelector("#curp").value;
    let name = document.querySelector("#name").value;
    let lastname = document.querySelector("#lastname").value;
    let email = document.querySelector("#email").value;
    let school = document.querySelector("#select_box").value;
    let state = document.querySelector("#select_box2").value;
    let city = document.querySelector("#city").value;
    let genero = document.querySelector("#genero").value;



    //Validar campos vacios

    if(num_control.trim() === '' || curp.trim() === '' || name.trim() === '' || lastname.trim() === '' ||
     email.trim() === '' || school === '' || state === '' || genero === ''){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'Faltan datos por llenar'
        })
        return;
    }

    //Validar que el correo ingresado sea correcto
    if(!validarEmail(email)){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El formato de correo no es correcto. Intente nuevamente'
        })
        return;
    }

    //Mandar datos 

    const dataEstudiante = new FormData();
    dataEstudiante.append("num_control", num_control);
    dataEstudiante.append("curp", curp);
    dataEstudiante.append("name", name);
    dataEstudiante.append("lastname", lastname);
    dataEstudiante.append("email", email);
    dataEstudiante.append("school",school);
    dataEstudiante.append("state", state);
    dataEstudiante.append("city", city);
    dataEstudiante.append("genero",genero);


    let respuesta2 = await fetch("php/insertar_estudiantes.php",{
        method:'POST',
        body: dataEstudiante,
    });

    let resultado2 = await respuesta2.json();
    if(resultado2.success == true){
        Swal.fire({
            icon:'success',
            title:'REGISTRO COMPLETADO',
            text: resultado2.mensaje
        })
        document.querySelector("#form-estudiantes").reset();
    }else{
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: resultado2.mensaje
        })
    }

}

//INICIA REGISTRO PARA DOCENTES
const registroDocentes = async() =>{
    
    let rfc = document.querySelector("#rfc").value;
    let curp = document.querySelector("#curp").value;
    let name = document.querySelector("#name").value;
    let lastname = document.querySelector("#lastname").value;
    let email = document.querySelector("#email").value;
    let school = document.querySelector("#select_box").value;
    let state = document.querySelector("#select_box2").value;
    let city = document.querySelector("#city").value;
    let genero = document.querySelector("#genero").value;


    //Validar campos vacios

    if(rfc.trim() === '' || curp.trim() === '' || name.trim() === '' || lastname.trim() === '' ||
     email.trim() === '' || school === '' || state === '' || genero === ''){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'Faltan datos por llenar'
        })
        return;
    }

    //Validar que el correo ingresado sea correcto
    if(!validarEmail(email)){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El formato de correo no es correcto. Intente nuevamente'
        })
        return;
    }

    //Mandar datos 

    const dataDocente = new FormData();
    dataDocente.append("rfc", rfc);
    dataDocente.append("curp", curp);
    dataDocente.append("name", name);
    dataDocente.append("lastname", lastname);
    dataDocente.append("email", email);
    dataDocente.append("school",school);
    dataDocente.append("state", state);
    dataDocente.append("city", city);
    dataDocente.append("genero",genero);


    let respuesta3 = await fetch("php/insertar_docentes.php",{
        method:'POST',
        body: dataDocente,
    });

    let resultado3 = await respuesta3.json();
    if(resultado3.success == true){
        Swal.fire({
            icon:'success',
            title:'REGISTRO COMPLETADO',
            text: resultado3.mensaje
        })
        document.querySelector("#form-docentes").reset();
    }else{
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: resultado3.mensaje
        })
    }

}

//INSERTAR DATOS DE EXTERNOS

const registro = async() =>{
    
    let correo = document.querySelector("#email").value;
    let rfc = document.querySelector("#rfc").value;
    let curp = document.querySelector("#curp").value;
    let name = document.querySelector("#name").value;
    let lastname = document.querySelector("#lastname").value;
    let genero = document.querySelector("#genero").value;
    let empresa = document.querySelector("#empresa").value;
    let sector = document.querySelector("#sector").value;
    let funcion = document.querySelector("#funcion").value;
    let zip = document.querySelector("#zip").value;
    let estado = document.querySelector("#select_box").value;
    let city = document.querySelector("#city").value;
    //let telefono = document.querySelector("#telefono").value;
    let celular = document.querySelector("#celular").value;

    //Validar campos requeridos
    if(correo.trim() === '' || rfc.trim() === '' || curp.trim() === '' ||
    name.trim() === '' || lastname.trim() === '' || zip.trim() === '' || celular.trim() === '' || genero === '' 
    || estado === ''){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'Faltan datos por llenar'
        })
        return;
    }

    //Validar que el correo ingresado sea correcto
    if(!validarEmail(correo)){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El formato de correo no es correcto. Intente nuevamente'
        })
        return;
    }

    if(validarZip(zip) == false){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El código postal no es correcto. Intente nuevamente'
        })
        return;
    }

    if(validarCelular(celular) == false){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El numero de celular no es correcto. Intente nuevamente'
        })
        return;
    }

    /*if(validarTelefono(telefono) == false){
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: 'El numero de telefono no es correcto. Intente nuevamente'
        })
        return;
    }*/
    //Insertar datos de externo a la base de datos
    const data = new FormData();
    data.append("name", name);
    data.append("lastname", lastname);
    data.append("correo", correo);
    data.append("rfc", rfc);
    data.append("curp", curp);
    data.append("genero", genero);
    data.append("empresa", empresa);
    data.append("sector",sector);
    data.append("funcion",funcion);
    data.append("zip", zip);
    data.append("estado", estado);
    data.append("city", city);
    //data.append("telefono", telefono);
    data.append("celular", celular);

    let respuesta = await fetch("php/insertar_externos.php",{
        method:'POST',
        body: data,
    });

    let resultado = await respuesta.json();
    if(resultado.success == true){
        Swal.fire({
            icon:'success',
            title:'REGISTRO COMPLETADO',
            text: resultado.mensaje
        })
        document.querySelector("#form-externos").reset();
    }else{
        Swal.fire({
            icon:'error',
            title:'ERROR',
            text: resultado.mensaje
        })
    }
}
