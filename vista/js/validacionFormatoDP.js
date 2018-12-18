window.onload = function() {
    calcular("dps");
    calcular("dpn");
    calcular("dpn2");
    calcular("dpr");
};



function validarFormatoDP(){
    
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
        
    } else if(validarItems("dps")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de SERVICIO Y ETIQUETA TELEFÓNICA...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("dpn")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de NEGOCIACIÓN I...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("dpn2")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de NEGOCIACION II...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if(validarItems("dpr")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de REGISTRO EN EL SISTEMA...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if($("#observacion").val().length == 0){
        
        swal({
        title: '¡Campo vacío!',
        text: 'Es necesario que realice una OBSERVACIÓN para poder continuar...',
        type: 'info',
        confirmButtonText: 'Entendido'
        });
        
    }else{
        $('#botonRegistrar').attr("disabled" , true);
        document.formGeneral.submit();
        
    }
}