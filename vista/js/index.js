$(document).ready(function(){
    /* Cerrar ventana de sesión fallida */
    $(".cerrar-alerta").click(function(){
        $(".alerta").fadeOut();
    });
    
    
    /* Mostrar / Ocultar contraseña */
    var click = true;
    
    $(".ojo").click(function(){        
                
        if(click){
            $("#password").attr("type" , "text");
            click = false;
            $(".ojo").removeClass("cerrar");
            $(".ojo").addClass("abrir");
        }else{
            $("#password").attr("type" , "password");
            click = true;
            $(".ojo").removeClass("abrir");
            $(".ojo").addClass("cerrar");
        }
        
    });
    
});