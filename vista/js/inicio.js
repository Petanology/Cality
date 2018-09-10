/* funcion menú */
$(document).ready(function(){
    
    function funcionMenu(){
        // animación icono
        $(".primero").toggleClass("primero-activado");
        $(".segundo").toggleClass("segundo-activado");
        $(".tercero").toggleClass("tercero-activado");
        
        // Agrandar / empequeñecer menú
        $("#ul-menu").toggleClass("menu-tooltip");
        $("#ul-menu").toggleClass("menu-normal");
        $("#menu").toggleClass("menu-activado");    
        $(".fondo-toggle").toggleClass("fondo-toggle-activado");    
    }
    
    // tocar el icono de menú
    /*$(".icono-menu").click(function(){
        funcionMenu();
    });*/
    
    // tocatr el fondo oscuro
    $("#fondo-toggle").click(function(){
        funcionMenu();
    });
    
    // forma diferente en pantalla grande
    //$(window).resize(function(){
        $(".icono-menu").click(function(){
            if($(window).width() > 1200){
                $(".contenedor-derecha").toggleClass("contenedor-derecha-activado");
            }
            
            funcionMenu();
        });
    //});
});














