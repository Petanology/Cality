$('#formRegistro').on('submit', function(e) {
    e.preventDefault();

    var contrasena = $('#contrasena').val();
    var contrasena2 = $('#contrasena2').val();

    if(contrasena !== contrasena2) {
        $('#mensajeVerificacion').removeClass('text-muted');
        $('#mensajeVerificacion').addClass('text-danger');
        $('#mensajeVerificacion').addClass('font-weight-bold');
        $('#contrasena2').focus();
        $('#contrasena').addClass('is-invalid');
        $('#contrasena2').addClass('is-invalid');
    } else {
        alert(0);
        $('#boton').click();
        //$('#boton').trigger('click');
        //$(this).submit();
    }
});