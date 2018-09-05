$(document).ready(function(){
    /* Cerrar ventana de sesión fallida */
    $(".cerrar-alerta").click(function(){
       $(".alerta").addClass("desvanecer-alerta");
    });
    
    
    /* Mostrar / Ocultar contraseña */
    
    $(".ojo").mousedown(function(){
        $("#password").attr("type" , "text");
        $(this).removeClass("cerrar");
        $(this).addClass("abrir");
    });
    
    $(".ojo").mouseup(function(){
       
        $("#password").attr("type" , "password");
        $(this).removeClass("abrir");
        $(this).addClass("cerrar");
        
    });
    
});