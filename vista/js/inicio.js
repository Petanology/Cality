/* funcion menú */
$(document).ready(function(){
    $(".icono-menu").click(function(){
        $(".primero").toggleClass("primero-activado");
        $(".segundo").toggleClass("segundo-activado");
        $(".tercero").toggleClass("tercero-activado");
    });
});