$(document).ready(function () {
    console.log('PROVEEDORES');
    $('#btn_crear_nuevo_proveedor').on('click', function () {
        enviar_datos_nuevo_proveedor();
    });

})


function enviar_datos_nuevo_proveedor() {

    let formData = new FormData(document.getElementById('form_crear_proveedor'));
    formData.append('accion', 'guardar_nuevo_proveedor');

    // Realizar la petición AJAX

    $.ajax({
        url: '/admin/controlador/ajax/funciones_proveedor.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#btn_crear_nuevo_proveedor').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
        },
        success: function (response) {
            console.log(response);
            try {
                let respuesta = JSON.parse(response);
                if (respuesta.status && respuesta.status == 'success') {
                    window.location.href = "?pagina=proveedores";
                }
            } catch (error) {
                console.error('Error al parsear la respuesta JSON:', error);
            }
        },
        error: function (error) {
            console.error('Error en la petición AJAX:', error);
        },
        complete: function () {
            $('#btn_crear_nuevo_proveedor').prop('disabled', false).html('<span class="indicator-label">Guardar datos</span>');
        }
    });
}

function modificar_info_proveedor(id) {

    let formData = new FormData(document.getElementById(`form_editar_proveedor_${id}`));
    formData.append('accion', 'editar_proveedor');
    formData.append('id', id);

    // Realizar la petición AJAX
    $.ajax({
        url: '/admin/controlador/ajax/funciones_proveedor.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(`#btn_editar_proveedor_${id}`).prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
        },
        success: function (response) {
            console.log(response);
            try {
                let respuesta = JSON.parse(response);
                if (respuesta.status && respuesta.status == 'success') {
                    window.location.href = "?pagina=proveedores";
                }
            } catch (error) {
                console.error('Error al parsear la respuesta JSON:', error);
            }
        },
        error: function (error) {
            console.error('Error en la petición AJAX:', error);
        },
        complete: function () {
            $(`#btn_editar_proveedor_${id}`).prop('disabled', false).html('<span class="indicator-label">Guardar datos</span>');
        }
    });
}


function eliminar_proveedor(id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px;"><strong> ¿ Seguro que quieres eliminar ? </strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('Click eliminar ', id);

            try {
                $.post('/admin/controlador/ajax/funciones_proveedor.php', {
                    'accion': 'eliminar_proveedor',
                    'id': id,
                }, function (result) {
                    let respuesta = JSON.parse(result);
                    if (respuesta.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>${respuesta.message}</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        $(`#tr_proveedor_${id}`).hide(100);
                        let filas_ocultas = $('#kt_proveedor_tabla tbody tr:hidden').length;

                        if (filas_ocultas === $('#kt_proveedor_tabla tbody tr').length) {
                            window.location.reload();
                        }
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Proveedor eliminado correctamente</strong></h4>`,
                            icon: "success",
                        });
                    }
                })
            } catch (error) {
                console.log('error');
                console.error(error);
            }

        }
    });
}


