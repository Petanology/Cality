/* funcion menú */
$(document).ready(function(){
    
    // funcion general de  menú
    function funcionMenu(){
        // animación icono
        $(".primero").toggleClass("primero-activado");
        $(".segundo").toggleClass("segundo-activado");
        $(".tercero").toggleClass("tercero-activado");
        $(".divisor-menu").toggleClass("divisor-activado");
        
        // Agrandar / empequeñecer menú
        $("#ul-menu").toggleClass("menu-tooltip");
        $("#ul-menu").toggleClass("menu-normal");
        $("#menu").toggleClass("menu-activado");    
        $(".fondo-toggle").toggleClass("fondo-toggle-activado");  
        $("#contenedor-derecha").toggleClass("contenedor-derecha-activado");
    }
    
    
    // clic en fondo oscuro
    $("#fondo-toggle").click(function(){
        funcionMenu();
    });
    
    // click en icono de menú
    $(".icono-menu").click(function(){
        funcionMenu();
    });
    
    // Función de sub grupos desplegables
    $("#ul-menu li a[href='#']").click(function(){
        
        $(this).toggleClass("item_menu_activado");
        $(this).siblings(".submenu-item").slideToggle(300);
        
    });
    
    
    $(".submenu-item ul li a").click(function(){
        $(".item-seleccionado-actual").removeClass("item-seleccionado-actual");
        $(this).addClass("item-seleccionado-actual");

    });
});














