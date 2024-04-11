$(document).ready(function () {
    console.log('FUNCIONES ADMIN')
})

function eliminar_admin_empresa(id) {

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
                $.post('/admin/controlador/ajax/funciones_admin.php', {
                    'accion': 'eliminar_admin',
                    'id': id,
                }, function (result) {
                    console.log(result);
                    let respuesta = JSON.parse(result);
                    if (respuesta.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>${respuesta.message}</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        $(`#tr_admin_${id}`).hide(100);
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Admin eliminado correctamente</strong></h4>`,
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

function modificar_perfil_admin(id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px;"><strong> ¿ Seguro que quieres modificar ? </strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Modificar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData(document.getElementById(`form_editar_perfil_admin_${id}`));
            formData.append('accion', 'editar_admin_perfil');
            formData.append('admin_profile_id', id);
            // Realizar la petición AJAX
            $.ajax({
                url: '/admin/controlador/ajax/funciones_admin.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $(`#btn_editar_admin_perfil_${id}`).prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
                },
                success: function (response) {
                    console.log(response);
                    try {
                        let respuesta = JSON.parse(response);
                        console.log('nueva_direccion_fiscal', respuesta);
                        if (respuesta.status && respuesta.status == 'success') {
                            $(`#modal_editar_perfil_admin_${id}`).modal('hide');
                            window.location.href = "?pagina=administradores";
                        }
                    } catch (error) {
                        console.error('Error al parsear la respuesta JSON:', error);
                    }
                },
                error: function (error) {
                    console.error('Error en la petición AJAX:', error);
                },
                complete: function () {
                    $(`#btn_editar_admin_perfil_${id}`).prop('disabled', false).html('<span class="indicator-label">Guardar datos</span>');
                }
            });
        }
    });
}