var page;

var ruta_server = "http://server.angelamaria.com/";
// var ruta_server = "https://server.e-angelamaria.me/";


function execDatatable(text){

/*=====================================================================
    TODO: Validamos tabla de Administradores
=====================================================================*/

if($(".tableAdmins").length > 0){

    var url = "ajax/data-administradores.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_user"},
        {"data": "actions", "orderable":false},
        {"data": "picture_user", "orderable":false, "search":false},
        {"data": "displayname_user"},
        {"data": "email_user"},
        {"data": "address_user"},
        {"data": "phone_user"},
        {"data": "rol_user"},
        {"data": "status_user"},
        {"data": "date_created_user"}
    ];

    page = "administradores";

}

/*=====================================================================
    TODO: Validamos tabla de Usuarios
=====================================================================*/

if($(".tableUsers").length > 0){

    var url = "ajax/data-usuarios.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_customer"},
        {"data": "actions", "orderable":false},
        {"data": "picture_customer", "orderable":false, "search":false},
        {"data": "displayname_customer"},
        {"data": "username_customer"},
        {"data": "email_customer"},
        {"data": "method_customer"},
        {"data": "status_customer"},
        {"data": "date_created_customer"}
    ];

    page = "usuarios";

}

/*=====================================================================
    TODO: Validamos tabla de Suscriptores
=====================================================================*/

if($(".tableSus").length > 0){

    var url = "ajax/data-subscribers.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_subscriber"},
        {"data": "email_subscriber"},
        {"data": "status_subscriber"},
        {"data": "date_created_subscriber"}
    ];

    page = "subscribers";

}

/*=====================================================================
    TODO: Validamos tabla de Categorias
=====================================================================*/

if($(".tableCategorias").length > 0){

    var url = "ajax/data-categorias.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_category"},
        {"data": "picture_category", "orderable":false, "search":false},
        {"data": "name_category"},
        {"data": "url_category"},
        {"data": "icon_category"},
        {"data": "views_category"},
        {"data": "date_created_category"},
        {"data": "actions", "orderable":false}

    ];

    page = "categorias";

}

/*=====================================================================
    TODO: Validamos tabla de Subcategorias
=====================================================================*/

if($(".tableSubcategorias").length > 0){

    var url = "ajax/data-subcategorias.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_subcategory"},
        {"data": "name_subcategory"},
        {"data": "name_category"},
        {"data": "title_list_subcategory"},
        {"data": "url_subcategory"},
        {"data": "views_subcategory"},
        {"data": "date_created_subcategory"},
        {"data": "actions", "orderable":false}

    ];

    page = "subcategorias";

}

/*=====================================================================
    TODO: Validamos tabla de Marcas
=====================================================================*/

if($(".tableMarcas").length > 0){

    var url = "ajax/data-marcas.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_brand"},
        {"data": "picture_brand", "orderable":false, "search":false},
        {"data": "name_brand"},
        {"data": "url_brand"},
        {"data": "date_created_brand"},
        {"data": "actions", "orderable":false}

    ];

    page = "marcas";

}

/*=====================================================================
    TODO: Validamos tabla de Productos
=====================================================================*/

if($(".tableProductos").length > 0){

    var url = "ajax/data-productos.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_product"},
        {"data": "actions", "orderable":false},
        {"data": "status_product"},
        {"data": "picture_product", "orderable":false, "search":false},
        {"data": "name_product"},
        {"data": "price_product"},
        {"data": "stock_product"},
        {"data": "views_product"},
        {"data": "date_created_product"}
    ];

    page = "productos";

}

/*=====================================================================
    TODO: Validamos tabla de Ofertas
=====================================================================*/

if($(".tableOfertas").length > 0){

    var url = "ajax/data-ofertas.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_product"},
        {"data": "actions", "orderable":false},
        {"data": "productoffer_product"},
        {"data": "picture_product", "orderable":false, "search":false},
        {"data": "name_product"},
        {"data": "stock_product"},
        {"data": "date_created_product"}
    ];

    page = "ofertas";

}

/*=====================================================================
    TODO: Validamos tabla del Banner Superior
=====================================================================*/

if($(".tableBannersSup").length > 0){

    var url = "ajax/data-bannerssup.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_tbanner"},
        {"data": "picture_tbanner", "orderable":false},
        {"data": "name_product"},
        {"data": "status_tbanner"},
        {"data": "date_created_tbanner"},
        {"data": "actions", "orderable":false}
    ];

    page = "bannerssup";

}

/*=====================================================================
    TODO: Validamos tabla del Banner Default
=====================================================================*/

if($(".tableBannersDef").length > 0){

    var url = "ajax/data-bannersdef.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_dbanner"},
        {"data": "picture_dbanner", "orderable":false},
        {"data": "name_product"},
        {"data": "status_dbanner"},
        {"data": "date_created_dbanner"},
        {"data": "actions", "orderable":false}
    ];

    page = "bannersdef";

}

/*=====================================================================
    TODO: Validamos tabla del Banner Horizontal
=====================================================================*/

if($(".tableBannersHor").length > 0){

    var url = "ajax/data-bannershor.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_hbanner"},
        {"data": "picture_hbanner", "orderable":false},
        {"data": "name_product"},
        {"data": "status_hbanner"},
        {"data": "date_created_hbanner"},
        {"data": "actions", "orderable":false}
    ];

    page = "bannershor";

}

/*=====================================================================
    TODO: Validamos tabla del Banner Vertical
=====================================================================*/

if($(".tableBannersVert").length > 0){

    var url = "ajax/data-bannersvert.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_vbanner"},
        {"data": "picture_vbanner", "orderable":false},
        {"data": "name_product"},
        {"data": "status_vbanner"},
        {"data": "date_created_vbanner"},
        {"data": "actions", "orderable":false}
    ];

    page = "bannersvert";

}

/*=====================================================================
    TODO: Validamos tabla de Ordenes
=====================================================================*/

if($(".tableOrdenes").length > 0){

    var url = "ajax/data-ordenes.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_order"},
        {"data": "date_order"},
        {"data": "displayname_customer"},
        {"data": "address_order"},
        {"data": "phone_order"},
        {"data": "status_order"},
        {"data": "payment_order"},
        {"data": "detalles", "orderable":false}
    ];

    page = "ordenes";

}

/*=====================================================================
    TODO: Validamos tabla de Traking
=====================================================================*/

if($(".tableTraking").length > 0){

    var url = "ajax/data-traking.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_order"},
        {"data": "date_order"},
        {"data": "displayname_customer"},
        {"data": "status_order"},
        {"data": "displayname_user"}
    ];

    page = "seguimientos";

}

/*=====================================================================
    TODO: Validamos tabla de Asignar Orden
=====================================================================*/

if($(".tableAsignarOrden").length > 0){

    var url = "ajax/data-asignar-orden.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_order"},
        {"data": "date_order"},
        {"data": "displayname_customer"},
        {"data": "status_order"},
        {"data": "displayname_user"}
    ];

    page = "seguimientos";

}



/*=====================================================================
    TODO: Validamos tabla de Review
=====================================================================*/

if($(".tableReviews").length > 0){

    var url = "ajax/data-reviews.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_review"},
        {"data": "text_review"},
        {"data": "stars_review", "orderable":false},
        {"data": "id_user_review"},
        {"data": "id_product_review"},
        {"data": "date_created_review"}
    ];

    page = "reviews";

}



/*=====================================================================
    TODO: Validamos tabla de Politicas
=====================================================================*/

if($(".tablePoliticas").length > 0){

    var url = "ajax/data-politicas.php?text="+text+"&between1="+$("#between1").val()+"&between2="+$("#between2").val()+"&token="+localStorage.getItem("token_user");

    var columns = [
        {"data": "id_pageview"},
        {"data": "type_pageview"},
        {"data": "date_updated_pageview"},
        {"data": "actions", "orderable":false}
    ];

    page = "politicas";

}

/*=====================================================================
    TODO: Ejecutamos DataTable
=====================================================================*/

    var adminsTable = $("#TablaAdministradores").DataTable({

        "responsive": true,
        "lengthChange": true,
        "aLengthMenu":[[10, 50, 100, 500, 1000],[10, 50, 100, 500, 1000]],
        "autoWidth": false,
        "processing": true,
        "serverSide": true,
        "order": [[0,"desc"]],
        "columnDefs": [
            {"className": "dt-center", "targets": "_all"}
        ],
        "ajax":{
            "url": url,
            "type":"POST"
        },
        "columns": columns,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "<img src='views/assets/custom/img/fondo-dt.webp' style='max-width: 60%;'>",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
        buttons: {
            dom: {
                container: {
                    tag: 'div',
                    className: 'flexcontent'
                },
                buttonLiner: {
                    tag: null
                }
            },
            buttons: [
            //Botón para Excel
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel mr-2"></i>Excel',
                footer: true,
                title: 'Reporte del Minimarket Angela Maria',
                titleAttr: 'Excel',
                filename: 'Reporte del Minimarket Angela Maria',
                className: 'btnDT btn-app export excel',
                /* exportOptions: {
                    columns: [0, 2,]
                }, */
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                text: '<i class="far fa-file-pdf mr-2"></i>PDF',
                footer: true,
                title: 'Reporte del Minimarket Angela Maria',
                filename: 'Reporte del Minimarket Angela Maria',
                className: 'btnDT btn-app export pdf',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                text: '<i class="fas fa-file-csv mr-2"></i>CSV',
                footer: true,
                filename: 'Reporte del Minimarket Angela Maria',
                className: 'btnDT btn-app export csv'
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                text: '<i class="fas fa-copy mr-2"></i>Copiar',
                footer: true,
                title: 'Titulo de tabla copiada',
                titleAttr: 'Copiar',
                title: 'Reporte del Minimarket Angela Maria',
                filename: 'Reporte del Minimarket Angela Maria',
                className: 'btnDT btn-app export barras',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                text: '<i class="fas fa-print mr-2"></i>Imprimir',
                footer: true,
                title: 'Reporte del Minimarket Angela Maria',
                titleAttr: 'Imprimir',
                className: 'btnDT btn-app export imprimir'
            },
            //Botón para ocultar
            {
                extend: 'colvis',
                text: '<i class="fas fa-columns"></i>',
                postfixButtons: ['colvisRestore'],
            }
        ],
    },
        fnDrawCallback:function(oSettings){
            if(oSettings.aoData.length == 0){
                $('.dataTables_paginate').hide();
                $('.dataTables_info').hide();
            }
        }

    })

        if(text == "flat"){

            $("#TablaAdministradores").on("draw.dt", function(){

                setTimeout(function(){

                    adminsTable.buttons().container().appendTo('#TablaAdministradores_wrapper .col-md-6:eq(0)');

                },100);

            })

        }

};

execDatatable("html");

/*================================================================
    TODO: Ejecutar reporte
================================================================*/

function reportActive(event){

    if(event.target.checked){

        $("#TablaAdministradores").dataTable().fnClearTable();
        $("#TablaAdministradores").dataTable().fnDestroy();

        setTimeout(function(){

            execDatatable("flat");

        },100);

    }else{

        $("#TablaAdministradores").dataTable().fnClearTable();
        $("#TablaAdministradores").dataTable().fnDestroy();

        setTimeout(function(){

            execDatatable("html");

        },100);

    }

}

/*================================================================
    TODO: Rango de fechas
================================================================*/

$('#daterange-btn').daterangepicker(
    {

        /*================================================================
            TODO: Traducir daterangepicker a español
        ================================================================*/

    "locale": {
        "format": "YYYY-MM-DD",
        "separator": " - ",
        "applyLabel": "Aplicar",
        "cancelLabel": "Cancelar",
        "fromLabel": "Desde",
        "toLabel": "Hasta",
        "customRangeLabel": "Rango Personalizado",
        "daysOfWeek": [
            "Do",
            "Lu",
            "Ma",
            "Mi",
            "Ju",
            "Vi",
            "Sa"
        ],
        "monthNames": [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre"
        ],
        "firstDay": 1
    },

        ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
        'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Último Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Este Año': [moment().startOf('year'), moment().endOf('year')],
        'Último Año'  : [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
    },

        startDate: moment($("#between1").val()),
        endDate  : moment($("#between2").val())

    },

    function (start, end) {

        window.location = page+"?start="+start.format('YYYY-MM-DD')+"&end="+end.format('YYYY-MM-DD');

    },

)

/*================================================================
    TODO: Cambiar estado del producto
================================================================*/

function changeState(event, idProduct){

    if(event.target.checked){

        var state = 1;

    }else{

        var state = 0;

    }


    var data = new FormData();
    data.append("state", state);
    data.append("idProduct", idProduct);
    data.append("token", localStorage.getItem("token_user"));


    $.ajax({
        url: "ajax/ajax-state-producto.php",
        method: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response){

            if(response == 200){

                setTimeout(function(){

                    window.location = page;

                },1200);

                fncNotie(1, "El registro a sido actualizado");

            }else{

                fncNotie(3, "Error al actualizar el registro");
            }

        }

    })

}

/*================================================================
    TODO: Eliminar registro
================================================================*/

$(document).on("click",".removeItem",function(){

    var idItem = $(this).attr("idItem");
    var table = $(this).attr("table");
    var suffix = $(this).attr("suffix");
    var page = $(this).attr("page");

    fncSweetAlert("confirm","¿Estás segur@ de eliminar este registro?","").then(resp=>{

        if(resp){

            var data = new FormData();
            data.append("idItem", idItem);
            data.append("table", table);
            data.append("suffix", suffix);
            data.append("token", localStorage.getItem("token_user"));

            $.ajax({

                url: "ajax/ajax-delete.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response){

                    if(response == 200){

                        fncSweetAlert(
                            "success",
                            "El registro ha sido eliminado con éxito.",
                            "/"+page
                        );

                    }else if(response == "no-delete"){

                        fncSweetAlert(
                            "error",
                            "El registro tiene datos relacionados.",
                            ""
                        );

                    }else{

                        fncNotie(3, "Error al eliminar el registro.");

                    }

                }

            })

        }

    })
})

/*================================================================
    TODO: Eliminar ofertas
================================================================*/

$(document).on("click",".removeOffer",function(){

    var idItem = $(this).attr("idItem");
    var table = $(this).attr("table");
    var suffix = $(this).attr("suffix");
    var page = $(this).attr("page");

    fncSweetAlert("confirm","¿Estás segur@ de quitar esta oferta?","").then(resp=>{

        if(resp){

            var data = new FormData();
            data.append("idItem", idItem);
            data.append("table", table);
            data.append("suffix", suffix);
            data.append("token", localStorage.getItem("token_user"));

            $.ajax({

                url: "ajax/ajax-deleteoferta.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                success: function (response){

                    if(response == 200){

                        fncSweetAlert(
                            "success",
                            "La oferta de este producto ha sido quitado con éxito.",
                            "/"+page
                        );

                    }else{

                        fncNotie(3, "Error al quitar la oferta de este producto.");

                    }

                }

            })

        }

    })
})

/*================================================================
    TODO: Modal para ver los detalles de los administradores
================================================================*/

$(document).on("click", ".infoAdmin", function(){

    /*================================================================
        TODO: Limpiamos la ventana modal
    ================================================================*/

    $(".orderBody").html("");

    var id_user = $(this).attr("id_user");
    var displayname_user = $(this).attr("displayname_user");
    var username_user = $(this).attr("username_user");
    var picture_user = $(this).attr("picture_user");
    var rol_user = $(this).attr("rol_user");
    var email_user = $(this).attr("email_user");
    var country_user = $(this).attr("country_user");
    var city_user = $(this).attr("city_user");
    var address_user = $(this).attr("address_user");
    var method_user = $(this).attr("method_user");
    var phone_user = $(this).attr("phone_user");


    if(rol_user == "admin"){

        $(".orderBody").append(`

        <section class="profile-area">

            <div class="profile-header">

                <div class="user-profile-images">
                    <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

                    <div class="profile-image">
                        <img src="`+ ruta_server +`views/img/users/`+id_user+`/`+picture_user+`" alt="image">
                    </div>

                    <div class="user-profile-text">
                        <h3><mark>`+displayname_user+`</mark></h3>
                        <span class="d-block"><mark>Administrador</mark></span>
                    </div>
                </div>

                <div class="user-profile-nav">

                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class=" user-info-box">
                            <br>

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de contacto : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-15">
                                        <li class="d-flex">
                                            <i class="bx bx-envelope mr-2"></i>
                                            <span class="d-inline-block">Correo : <a class="d-inline-block">`+email_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-user mr-2'></i>
                                            <span class="d-inline-block">Usuario : <a class="d-inline-block">`+username_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <span class="d-inline-block">Telefono : <a href="tel:`+phone_user+`" class="d-inline-block">`+phone_user+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="card user-info-box">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de personal : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex">
                                            <i class="bx bx-map mr-2"></i>
                                            <span class="d-inline-block">Pais : <a class="d-inline-block">`+country_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-map-alt mr-2"></i>
                                            <span class="d-inline-block">Ciudad : <a class="d-inline-block">`+city_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-map-pin mr-2'></i>
                                            <span class="d-inline-block">Dirección : <a class="d-inline-block">`+address_user+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        `)

        $("#infoAdmin").modal()

    }

    if(rol_user == "repart"){

        $(".orderBody").append(`

        <section class="profile-area">

            <div class="profile-header">

                <div class="user-profile-images">
                    <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

                    <div class="profile-image">
                        <img src="`+ ruta_server +`views/img/users/`+id_user+`/`+picture_user+`" alt="image">
                    </div>

                    <div class="user-profile-text">
                        <h3><mark>`+displayname_user+`</mark></h3>
                        <span class="d-block"><mark>Repartidor</mark></span>
                    </div>
                </div>

                <div class="user-profile-nav">

                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class=" user-info-box">
                            <br>

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de contacto : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-15">
                                        <li class="d-flex">
                                            <i class="bx bx-envelope mr-2"></i>
                                            <span class="d-inline-block">Correo : <a class="d-inline-block">`+email_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-user mr-2'></i>
                                            <span class="d-inline-block">Usuario : <a class="d-inline-block">`+username_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <span class="d-inline-block">Telefono : <a href="tel:`+phone_user+`" class="d-inline-block">`+phone_user+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="card user-info-box">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de personal : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex">
                                            <i class="bx bx-map mr-2"></i>
                                            <span class="d-inline-block">Pais : <a class="d-inline-block">`+country_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-map-alt mr-2"></i>
                                            <span class="d-inline-block">Ciudad : <a class="d-inline-block">`+city_user+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-map-pin mr-2'></i>
                                            <span class="d-inline-block">Dirección : <a class="d-inline-block">`+address_user+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        `)

        $("#infoAdmin").modal()

    }

})

/*================================================================
    TODO: Modal para ver los detalles de los Clientes
================================================================*/

$(document).on("click", ".infoCustomer", function(){

    /*================================================================
        TODO: Limpiamos la ventana modal
    ================================================================*/

    $(".orderBody").html("");

    var id_customer = $(this).attr("id_customer");
    var displayname_customer = $(this).attr("displayname_customer");
    var username_customer = $(this).attr("username_customer");
    var picture_customer = $(this).attr("picture_customer");
    var rol_customer = $(this).attr("rol_customer");
    var email_customer = $(this).attr("email_customer");
    var country_customer = $(this).attr("country_customer");
    var city_customer = $(this).attr("city_customer");
    var address_customer = $(this).attr("address_customer");
    var method_customer = $(this).attr("method_customer");
    var phone_customer = $(this).attr("phone_customer");


    if(method_customer == "direct"){

        $(".orderBody").append(`

    <section class="profile-area">

        <div class="profile-header">

            <div class="user-profile-images">
                <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

                <div class="profile-image">
                    <img src="`+ ruta_server +`views/img/customers/`+id_customer+`/`+picture_customer+`" alt="image">
                </div>

                <div class="user-profile-text">
                    <h3><mark>`+displayname_customer+`</mark></h3>
                    <span class="d-block"><mark>Cliente</mark></span>
                </div>
            </div>

            <div class="user-profile-nav">

            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-lg-6">
                        <div class=" user-info-box">
                        <br>

                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>Detalles de contacto : </h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-unstyled mb-15">
                                    <li class="d-flex">
                                        <i class="bx bx-envelope mr-2"></i>
                                        <span class="d-inline-block">Correo : <a class="d-inline-block">`+email_customer+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class='bx bx-user mr-2'></i>
                                        <span class="d-inline-block">Usuario : <a class="d-inline-block">`+username_customer+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="bx bx-phone mr-2"></i>
                                        <span class="d-inline-block">Telefono : <a href="tel:`+phone_customer+`" class="d-inline-block">`+phone_customer+`</a></span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>



                    <div class="col-lg-6">
                        <div class="card user-info-box">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>Detalles de personal : </h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="d-flex">
                                        <i class="bx bx-map mr-2"></i>
                                        <span class="d-inline-block">Pais : <a class="d-inline-block">`+country_customer+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="bx bx-map-alt mr-2"></i>
                                        <span class="d-inline-block">Ciudad : <a class="d-inline-block">`+city_customer+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class='bx bx-map-pin mr-2'></i>
                                        <span class="d-inline-block">Dirección : <a class="d-inline-block">`+address_customer+`</a></span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


        `)

        $("#infoAdmin").modal()

    }else{

        $(".orderBody").append(`

        <section class="profile-area">

            <div class="profile-header">

                <div class="user-profile-images">
                    <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

                    <div class="profile-image">
                        <img src="`+picture_customer+`" alt="image">
                    </div>

                    <div class="user-profile-text">
                        <h3><mark>`+displayname_customer+`</mark></h3>
                        <span class="d-block"><mark>Cliente</mark></span>
                    </div>
                </div>

                <div class="user-profile-nav">

                </div>

            </div>

            <br>

            <div class="row">
                <div class="col-lg-12">

                    <div class="row">

                        <div class="col-lg-6">
                            <div class=" user-info-box">
                            <br>

                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de contacto : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-15">
                                        <li class="d-flex">
                                            <i class="bx bx-envelope mr-2"></i>
                                            <span class="d-inline-block">Correo : <a class="d-inline-block">`+email_customer+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-user mr-2'></i>
                                            <span class="d-inline-block">Usuario : <a class="d-inline-block">`+username_customer+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-phone mr-2"></i>
                                            <span class="d-inline-block">Telefono : <a href="tel:`+phone_customer+`" class="d-inline-block">`+phone_customer+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="card user-info-box">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3>Detalles de personal : </h3>
                                </div>

                                <div class="card-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex">
                                            <i class="bx bx-map mr-2"></i>
                                            <span class="d-inline-block">Pais : <a class="d-inline-block">`+country_customer+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class="bx bx-map-alt mr-2"></i>
                                            <span class="d-inline-block">Ciudad : <a class="d-inline-block">`+city_customer+`</a></span>
                                        </li>
                                        <li class="d-flex">
                                            <i class='bx bx-map-pin mr-2'></i>
                                            <span class="d-inline-block">Dirección : <a class="d-inline-block">`+address_customer+`</a></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>


        `)

        $("#infoAdmin").modal()

    }




})

/*================================================================
    TODO: Modal para asignar repartidor
================================================================*/

$(document).on("click", ".infoAsignarRepartidor", function(){

    $("[name='idOrden']").val($(this).attr("idOrden"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#infoAsignarRepartidor").modal()

})

/*================================================================
    TODO: Modal para actualizar el precio del producto
================================================================*/

$(document).on("click", ".editPrecio", function(){

    $("[name='idProduct']").val($(this).attr("idProduct"));
    $("[name='priceProduct']").val($(this).attr("priceProduct"));
    $("[name='stockProduct']").val($(this).attr("stockProduct"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editPrecio").modal()

})

/*================================================================
    TODO: Modal para actualizar el stock del producto
================================================================*/

$(document).on("click", ".editCantidad", function(){

    $("[name='idProduct']").val($(this).attr("idProduct"));
    $("[name='stockProduct']").val($(this).attr("stockProduct"));
    $("[name='priceProduct']").val($(this).attr("priceProduct"));

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#editCantidad").modal()

})

/*================================================================
    TODO: Modal para informacion de ofertas
================================================================*/
$(document).on("click", ".infoOffert", function(){

    /*================================================================
        TODO: Limpiamos la ventana modal
    ================================================================*/

    $(".orderBody").html("");

    var id_type = $(this).attr("type");
    var id_value = $(this).attr("value");
    var id_date = $(this).attr("date");
    var id_name = $(this).attr("name_product");
    var id_img = $(this).attr("img");

    $(".orderBody").append(`

    <section class="profile-area">

        <div class="profile-header">

            <div class="user-profile-images">
            <img src="views/assets/plugins/fiva/img/profile-banner2.jpg" class="cover-image" alt="image">

            <div class="profile-image">
                <img src="`+id_img+`" alt="image">
            </div>

                <div class="user-profile-text">
                    <h3><mark>`+id_name+`</mark></h3>
                    <span class="d-block"><mark>Ofertas</mark></span>
                </div>
            </div>

            <div class="user-profile-nav">

            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-lg-6">
                        <div class=" user-info-box">
                        <br>

                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3>Detalles de oferta : </h3>
                            </div>

                            <div class="card-body">
                                <ul class="list-unstyled mb-15">
                                    <li class="d-flex">
                                        <i class="bx bx-envelope mr-2"></i>
                                        <span class="d-inline-block">Estado de oferta:  <a class="d-inline-block">`+id_type+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class='bx bx-user mr-2'></i>
                                        <span class="d-inline-block">Porcentaje de la Oferta: <a class="d-inline-block">`+id_value+`</a></span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="bx bx-phone mr-2"></i>
                                        <span class="d-inline-block">Fecha de la oferta : <a href="tel:" class="d-inline-block">`+id_date+`</a></span>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    `)

    $("#infoOffert").modal()




})

/*================================================================
    TODO: Modal para DNI
================================================================*/

$(document).on("click", ".infoDocument", function(){

    $("[name='id_order']").val($(this).attr("id_order"));
    var imgDNI = $(this).attr("dni_order");
    $("#imgDJR").attr("src", imgDNI);

    /*================================================================
        TODO: Aparecemos la ventana Modal
    ================================================================*/

    $("#infoDocument").modal()

})