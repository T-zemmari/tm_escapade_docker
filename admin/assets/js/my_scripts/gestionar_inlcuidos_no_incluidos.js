$(document).ready(function () {
    console.log('GESTIONAR INCLUIDOS O NO INCLUIDOS');
})


function fn_eliminar_item_incluido_o_no_incluido(id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Quieres eliminar el item ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'item_id': id,
                'accion': 'eliminar_item_inlcuido_o_no_incluido',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO fn_eliminar_item_incluido_o_no_incluido', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Item eliminado correctamente</strong></h4>`,
                            icon: "success",
                        });
                        $(`#tr_fila_servicios_incluidos_o_no_incluidos_${id}`).hide();
                        // if ($(`.contenedor_media_${id}`).length === 0) {
                        //     $(`#addImageBtn_${id}`).show();
                        // }
                    }
                }
            }
            );
        }
    });
}


function fn_guardar_nuevo_servicio_incluido_1() {
    let tituloServicio = $('#titulo_servicio_incluido').val();
    let tipo = $(`#select_tipo`).val();
    let iconoServicio = $('#icono_servicio_incluido')[0].files[0];
    let check_mostrar_para_seleccionar = 0;
    if ($(`#check_mostrar_para_seleccionar`).is(':checked')) {
        check_mostrar_para_seleccionar = 1;
    }

    // Validar que todos los campos estén seleccionados
    if (!tituloServicio || !iconoServicio) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, complete todos los campos.(Debes subir un icono para el servicio incluido)</strong></h4>`,
            icon: "error",
        });
        return;
    }

    // Crear un objeto FormData con los datos del formulario
    let formData = new FormData();

    formData.append('titulo_servicio', tituloServicio);
    formData.append('icono_servicio_incluido', iconoServicio);
    formData.append('accion', 'nuevo_servicio_incluido');
    formData.append('check_mostrar_para_seleccionar', check_mostrar_para_seleccionar);
    formData.append('select_tipo', tipo);

    let cantidad_anterior = $(`#cantidad_items_servicios_incluir`).text();
    // Enviar la solicitud AJAX al controlador PHP
    $.ajax({
        url: '/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response);
            let respuesta = JSON.parse(response);
            console.log(respuesta);
            if (respuesta) {
                if (respuesta.status != 'success') {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>Error con la generacion del servicio incluido , intentalo mas tarde </strong></h4>`,
                        icon: "error",
                    });
                } else {
                    let nombreServicio = respuesta.datos_post.titulo_servicio;
                    let tipo = respuesta.datos_post.select_tipo;
                    let nuevoServicioId = respuesta.datos_post.last_id;
                    let icono = respuesta.datos_post.url_icono_servicio_incluido;
                    let check_mostrar_para_seleccionar = respuesta.datos_post.check_mostrar_para_seleccionar;
                    let HTML_MOSTRAR_PARA_SELECCIONAR = `
                        <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                            <input class="form-check-input" onchange="modificar_estado_mostrar_para_seleccionar('${nuevoServicioId}')" id="check_mostrar_para_seleccionar_${nuevoServicioId}" type="checkbox" value=""/>
                        </div>
                    `;
                    if (check_mostrar_para_seleccionar == 1) {
                        HTML_MOSTRAR_PARA_SELECCIONAR = `
                        <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                            <input class="form-check-input" onchange="modificar_estado_mostrar_para_seleccionar('${nuevoServicioId}')" id="check_mostrar_para_seleccionar_${nuevoServicioId}" type="checkbox" value="" checked/>
                        </div>
                    `;
                    }
                    // Agregar el nuevo servicio al select

                    let HTML = `
                        <tr class="buscar-item-por-nombre" nombre="${nombreServicio}" id="tr_fila_servicio_incluido_o_no_incluido_${nuevoServicioId}">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-3">
                                        <img src="${icono}" class="" alt="">
                                    </div>
                                </div>
                            </td>
                            <td class="text-start pe-13">
                                <span class="text-gray-600 fw-bold fs-6">${nombreServicio}</span>
                            </td>
                            <td class="text-start pe-13">
                            <span class="text-gray-600 fw-bold fs-6">${tipo}</span>
                            </td>
                            <td class="text-start pe-13">
                                ${HTML_MOSTRAR_PARA_SELECCIONAR}
                            </td>
                            <td class="text-end">
                                <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_item_incluido_o_no_incluido('${nuevoServicioId}')">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </td>
                        </tr>
                    `;
                    $('#tbody_nuevos_incluidos').prepend(HTML);
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>El nuevo servicio incluido ha sido guardado correctamente..</strong></h4>`,
                        icon: "success",
                    });

                    $(`#modal_nuevo_servicio_inlcuido`).modal('hide');
                    $(`#titulo_servicio_incluido`).val('');
                    $(`#icono_servicio_incluido`).val('');

                    $(`#cantidad_items_servicios_incluir`).text(parseInt(cantidad_anterior) + 1);

                }
            }

        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Se produjo un error al intentar guardar el nuevo servicio incluido.');
        }
    });
}


function filtrar_tabla_inlcuido_no_incluido_por_nombre() {
    let info_input = $(`#buscar_items_incluido_no_incluido_por_nombre`).val();
    if (info_input != undefined && info_input != null && info_input != '') {
        info_input = info_input.toLowerCase();
    }

    $('.buscar-item-por-nombre').each(function () {
        let nombre = $(this).attr('nombre');
        if (nombre != '') {
            nombre = nombre.toLowerCase();
        }
        if (info_input == '' || nombre.includes(info_input)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}


function modificar_estado_mostrar_para_seleccionar(id) {

    let checked = 0;
    let info = ' dejara de ser visible para poder escogerlo ';
    if ($(`#check_mostrar_para_seleccionar_${id}`).is(':checked')) {
        checked = 1;
        info = ' volvera a ser visible para poder escogerlo ';
    };


    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ El item ${info} ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Modificar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'item_id': id,
                'checked': checked,
                'accion': 'modificar_estado_mostrar_para_seleccionar',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO modificar_estado_mostrar_para_seleccionar', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Estado modificado correctamente</strong></h4>`,
                            icon: "success",
                        });
                    }
                }
            }
            );
        }
    });
}