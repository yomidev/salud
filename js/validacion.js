const validarEmail = (correo) =>{
    return /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo.trim());
}

//Validar codigo postal
const validarZip = (zip) =>{
    let long = zip.length;
    if(long == 5){
        return /^[0-9]+$/.test(zip.trim());
    }else{
        return false;
    }
}

//Validar Celular

const validarCelular = (celular) =>{
    let long = celular.length;
    if(long == 10){
        return /^[0-9]+$/.test(celular.trim());
    }else{
        return false;
    }
}

//Validar Telefono de Casa

const validarTelefono = (telefono) =>{
    if(telefono != ''){
        let long = telefono.length;
        if(long == 10){
            return /^[0-9]+$/.test(telefono.trim());
        }else{
            return false;
        }
    }
}