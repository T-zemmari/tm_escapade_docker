$(document).ready(function () {
    console.log('DATOS FISCALES');
    $('#btn_crear_datos_fiscales').on('click', function () {
        enviar_datos_fiscales();
    });
    $('#btn_modificar_datos_fiscales').on('click', function () {
        editar_datos_fiscales();
    });
  

})

function enviar_datos_fiscales() {

    let formData = new FormData(document.getElementById('form_datos_fiscales'));
    formData.append('accion', 'guardar_datos_fiscales');

    // Realizar la petición AJAX
    $.ajax({
        url: '/admin/controlador/ajax/funciones_datos_fiscales.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#btn_crear_datos_fiscales').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
        },
        success: function (response) {
            console.log(response);
            try {
                let respuesta = JSON.parse(response);
                console.log('nuevos datos_fiscales',respuesta);
                if (respuesta.status && respuesta.status == 'success') {
                    window.location.href = "?pagina=datos_fiscales";
                }
            } catch (error) {
                console.error('Error al parsear la respuesta JSON:', error);
            }
        },
        error: function (error) {
            console.error('Error en la petición AJAX:', error);
        },
        complete: function () {
            $('#btn_crear_datos_fiscales').prop('disabled', false).html('<span class="indicator-label">Guardar datos</span>');
        }
    });
}

function editar_datos_fiscales() {

    let form = document.getElementById('form_datos_fiscales_modificar');
    let adress_id = $(`#input_hidden_adress_id`).val();
    let datos_fiscales_id = $(`#input_hidden_datos_fiscales_id`).val();
    let url_logo_anterior = $(`#input_hidden_logo_anterior`).val();

    let formData = new FormData(form);
    formData.append('accion', 'editar_datos_fiscales');
    formData.append('adress_id', adress_id);
    formData.append('datos_fiscales_id', datos_fiscales_id);
    formData.append('url_logo_anterior', url_logo_anterior);

    // Realizar la petición AJAX
    $.ajax({
        url: '/admin/controlador/ajax/funciones_datos_fiscales.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#btn_modificar_datos_fiscales').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Guardando...');
        },
        success: function (response) {
            //console.log(response);
            try {
                let respuesta = JSON.parse(response);
                //console.log('editar datos fiscales',respuesta);
                if (respuesta.status && respuesta.status == 'success') {
                    window.location.href = "?pagina=datos_fiscales";
                }
            } catch (error) {
                console.error('Error al parsear la respuesta JSON:', error);
            }
        },
        error: function (error) {
            console.error('Error en la petición AJAX:', error);
        },
        complete: function () {
            $('#btn_modificar_datos_fiscales').prop('disabled', false).html('<span class="indicator-label">Guardar datos</span>');
        }
    });
}

function validar_documento() {

    let tipo_documento = $(`#select_tipo_de_documento`).val();
    let documento = $(`#documento_id`).val();
    let mensajeContainer = $(`#documento_id`).siblings('.fv-plugins-message-container');

    // Verificar si el documento_id está vacío
    if (documento.trim() === '') {
        mensajeContainer.html(''); // Limpiar el mensaje si no hay error
        return;
    }

    let mensajeError = '';

    // Realizar la validación según el tipo de documento
    switch (tipo_documento) {
        case 'cif':
            // Validar CIF España
            if (!validarCIF(documento)) {
                mensajeError = 'El CIF no es válido';
            }
            break;

        case 'dni':
            // Validar DNI España
            if (!validarDNI(documento)) {
                mensajeError = 'El DNI no es válido';
            }
            break;

        case 'nie':
            // Validar NIE España
            if (!validarNIE(documento)) {
                mensajeError = 'El NIE no es válido';
            }
            break;

        default:
            // Otro tipo de documento
            mensajeError = 'El tipo de documento no es válido';
            break;
    }

    // Mostrar el mensaje de error en el contenedor
    mensajeContainer.html(mensajeError);

    // Puedes aplicar estilos al contenedor o cambiar clases según si hay error o no
    if (mensajeError !== '') {
        mensajeContainer.addClass('invalid-feedback');
    } else {
        mensajeContainer.removeClass('invalid-feedback');
    }
}

// Función para validar CIF España
function validarCIF(cif) {
    cif = cif.toUpperCase();
    // Comprobar longitud y formato
    if (!/^([A-W]|\d)\d{7}([0-9A-J])$/.test(cif)) {
        return false;
    } else {
        return true;
    }

}

// Función para validar DNI España
function validarDNI(dni) {
    const regexDNI = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
    if (!regexDNI.test(dni)) {
        return false;
    }
    const numeroDNI = dni.substring(0, 8);
    const letraDNI = dni.charAt(8).toUpperCase();
    const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
    const letraEsperada = letras.charAt(numeroDNI % 23);
    return letraDNI === letraEsperada;
}

// Función para validar NIE España
function validarNIE(nie) {
    const regexNIE = /^([A-Z]){1}([0-9]){7}([A-Z]){1}$/;
    if (!regexNIE.test(nie)) {
        return false;
    } else {
        return true;
    }
}



