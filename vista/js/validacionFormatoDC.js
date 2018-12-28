window.onload = function() {
    calcular("dcs");
    calcular("dcn");
    calcular("dcc");
    calcular("dcr");
};



function validarFormatoDC(){
        
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
        
    } else if(validarItems("dcs")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de SERVICIO Y ETIQUETA TELEFÓNICA...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("dcn")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de NEGOCIACIÓN...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    }else if(validarItems("dcc")){
        
        swal({
                title: '¡Item(s) sin seleccionar!',
                text: 'Es obligatorio seleccionar todos los items de CIERRE DE COMPROMISO...',
                type: 'info',
                confirmButtonText: 'Entendido'
        });
        
    } else if(validarItems("dcr")){
        
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