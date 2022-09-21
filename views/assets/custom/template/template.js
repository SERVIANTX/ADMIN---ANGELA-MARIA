var ruta = "http://admin2.angelamaria.com/";
// var ruta = "https://admin.e-angelamaria.me/";



function nuevoAdmin() {
    window.location.href = ruta + "administradores/nuevo";
}

function nuevaCategoria() {
    window.location.href = ruta + "categorias/nuevo";
}

function nuevaSubCategoria() {
    window.location.href = ruta + "subcategorias/nuevo";
}

function nuevaMarca() {
    window.location.href = ruta + "marcas/nuevo";
}

function nuevoProducto() {
    window.location.href = ruta + "productos/nuevo";
}

function nuevoBannerSuperior() {
    window.location.href = ruta + "bannerssup/nuevo";
}

function nuevoBannerDefault() {
    window.location.href = ruta + "bannersdef/nuevo";
}

function nuevoBannerHorizontal() {
    window.location.href = ruta + "bannershor/nuevo";
}

function nuevoBannerVertical() {
    window.location.href = ruta + "bannersvert/nuevo";
}

function papelera() {
    window.location.href = ruta + "papelera";
}





function nuevoMensaje() {
    window.location.href = ruta + "correo/enviar";
}

/* <!-- Aca esta el script para que se introdusca el nombre del icono --> */

$('#icon_convert').iconpicker().on('change', function(e) {
            $("#icono-category").val(e.icon);
});

/* Función para copiar */

function copyToClipDireccion() {

    var content = document.getElementById('direccion');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Direccion copiado");

}

function copyToClipCorreo() {

    var content = document.getElementById('correo');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Correo copiado");

}

function copyToClipCelular() {

    var content = document.getElementById('celular');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Celular copiado");

}

function copyToClipFacebook() {

    var content = document.getElementById('facebook');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Facebook copiado");

}

function copyToClipInstagram() {

    var content = document.getElementById('instagram');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Instagram copiado");

}

function copyToClipWhatsapp() {

    var content = document.getElementById('whatsapp');

    content.select();
    document.execCommand('copy');

    fncNotie(1, "Whatsapp copiado");

}

/*================================================================
    TODO: Modal para actualizar la dirección
================================================================*/

$(document).on("click", ".editDireccion", function(){

    $("[name='idDireccion']").val($(this).attr("idDireccion"));
    $("[name='direccion']").val($(this).attr("direccion"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editDireccion").modal()

})

/*================================================================
    TODO: Modal para actualizar el Correo electrónico
================================================================*/

$(document).on("click", ".editEmail", function(){

    $("[name='idEmail']").val($(this).attr("idEmail"));
    $("[name='email']").val($(this).attr("email"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editEmail").modal()

})

/*================================================================
    TODO: Modal para actualizar el Celular
================================================================*/

$(document).on("click", ".editCelular", function(){

    $("[name='idCelular']").val($(this).attr("idCelular"));
    $("[name='celular']").val($(this).attr("celular"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editCelular").modal()

})

/*================================================================
    TODO: Modal para actualizar Facebook
================================================================*/

$(document).on("click", ".editFacebook", function(){

    $("[name='idFacebook']").val($(this).attr("idFacebook"));
    $("[name='facebook']").val($(this).attr("facebook"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editFacebook").modal()

})

/*================================================================
    TODO: Modal para actualizar la dirección
================================================================*/

$(document).on("click", ".editInstagram", function(){

    $("[name='idInstagram']").val($(this).attr("idInstagram"));
    $("[name='instagram']").val($(this).attr("instagram"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editInstagram").modal()

})

/*================================================================
    TODO: Modal para actualizar el Correo electrónico
================================================================*/

$(document).on("click", ".editWhatsapp", function(){

    $("[name='idWhatsapp']").val($(this).attr("idWhatsapp"));
    $("[name='whatsapp']").val($(this).attr("whatsapp"));
    $("[name='mensajeWhatsapp']").val($(this).attr("mensajeWhatsapp"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editWhatsapp").modal()

})


/*================================================================
    TODO: Modal para actualizar la contraseña del usuario
================================================================*/

$(document).on("click", ".editPasswordUser", function(){

    $("[name='idPasswordUser']").val($(this).attr("idPasswordUser"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editPasswordUser").modal()

})

/*================================================================
    TODO: Modal para actualizar el celular del usuario
================================================================*/

$(document).on("click", ".editCelularUser", function(){

    $("[name='idCelularUser']").val($(this).attr("idCelularUser"));
    $("[name='celularUser']").val($(this).attr("celularUser"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editCelularUser").modal()

})

/*================================================================
    TODO: Modal para actualizar el celular del usuario
================================================================*/

$(document).on("click", ".editPictureUser", function(){

    $("[name='idPictureUser']").val($(this).attr("idPictureUser"));
    $("[name='pictureUser']").val($(this).attr("pictureUser"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editPictureUser").modal()

})
