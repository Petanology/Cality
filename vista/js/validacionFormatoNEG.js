window.onload = function() {
    calcular("npep");
    calcular("nsc");
    calcular("nn");
    calcular("nad");
    calcular("nrs");
};

    var f = new Date();
    var diaActual = f.getFullYear() + "-" + ("0" + (f.getMonth() + 1)).slice(-2) + "-" + f.getDate();

function validarFormatoNEG(){
    
    if($("#unidad").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que seleccione la UNIDAD para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    } else if($("#tipo-monitoreo").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que seleccione el TIPO DE MONITOREO para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    } else if($("#fecha").val() > diaActual){
        
        swal({
        title: '¡Campo Incoherente!',
        text: 'No se puede registrar una FECHA POSTERIOR a la actual...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    } else if($("#fecha").val() < "2016-01-01"){
        
        swal({
        title: '¡Campo Incoherente!',
        text: 'Es necesario que ingrese una FECHA posterior al año 2016 para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    } else if($("#error-critico").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que especifique si hubo algún ERROR CRÍTICO para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("npep")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de PROTOCOLO Y ETIQUETA PROFESIONAL...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("nsc")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de SERVICIO AL CLIENTE...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("nn")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de NEGOCIACIÓN...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if(validarItems("nad")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de ACTUALIZACIÓN DE DATOS...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if(validarItems("nrs")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de REGISTRO EN EL SISTEMA...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if($("#llamada").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que especifique la LLAMADA para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    }else if($("#fortalezas").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que especifique las FORTALEZAS para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    }else if($("#oportunidades").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que especifique las OPORTUNIDADES para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    }else{
        $('#botonRegistrar').attr("disabled" , true);
        document.formGeneral.submit();
        
    }
}