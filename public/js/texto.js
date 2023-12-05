$(document).ready(function () {
    $('.descripcion p').each(function () {
        var contenido = $(this).text();
        if (contenido.length > 400) {
            $(this).addClass('descripcion-larga');
        }else{
            $(this).addClass('descripcion-corta');
        }
    });
});