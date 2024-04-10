$(document).ready(function () {
    console.log('USUARIOS');
})

function desacticar_suscripcion_manualmente(suscripcion_id) {

    let estado = 0;
    if ($(`#check_suscipcion_activa_${suscripcion_id}`).is(':checked')) estado = 1;

    let data = {
        'id': suscripcion_id,
        'estado': estado,
    }
    console.log('data', data)
    $.post('/admin/controlador/ajax/funciones_suscribirse.php', {
        'data': data,
        'accion': 'modificar_estado_suscripcion',
    }, function (response) {
        console.log('response desacticar_suscripcion_manualmente', response);
        let respuesta = JSON.parse(response);
        if (respuesta) {
            console.log('Respuesta desacticar_suscripcion_manualmente', respuesta);
            let status = respuesta.status;
            let modificado = respuesta.modificado;
            let estado = respuesta.estado;

            if (status == 'success') {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>La suscripción esta  ${estado == 1 ? 'Activada' : 'Desactivada'}</strong></h4>`,
                    icon: "success",
                });
            }
            if (status == 'error' || modificado == false) {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>No ha sido posible modificar el estado de la suscripción</strong></h4>`,
                    icon: "error",
                });
            }
        }
    })

}

function filtrar_suscripciones_por_email() {
    let valor_input_buscar = $(`#input_filtrar_por_email`).val().toUpperCase();
    $(`.filtrar-por_email`).each(function () {
        let email = $(this).attr('email').toUpperCase();
        if (valor_input_buscar == '' || email.includes(valor_input_buscar)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}
