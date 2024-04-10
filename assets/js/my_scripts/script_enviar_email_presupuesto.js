function enviar_datos_presupuesto() {
    // Obtener los valores de los campos del formulario
    let nombre = document.getElementById('name').value.trim();
    let email = document.getElementById('email').value.trim();
    let telefono = document.getElementById('phone').value.trim();
    let asunto = document.getElementById('asunto').value.trim();
    let mensaje = document.getElementById('message').value.trim();
    let fecha_desde = document.getElementById('fecha_desde').value.trim();
    let fecha_hasta = document.getElementById('fecha_hasta').value.trim();
    let total_viajeros = document.getElementById('total_viajeros').value.trim();
    let total_ninyos_menores_de_12 = document.getElementById('total_ninyos_menores_de_12').value.trim();

    // Validar los campos del formulario
    if (nombre === '' || email === '' || telefono === '' || asunto === '' || mensaje === '' || total_viajeros === '' || total_ninyos_menores_de_12 === '') {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, complete todos los campos del formulario.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    // Validar el formato del correo electrónico
    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, introduzca una dirección de correo electrónico válida.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    let telefonoRegex = /^(?:(?:\+|00)34)?(?:6(?:[0-9] ?){8}|[679](?:[0-9] ?){8})$/;
    if (!telefonoRegex.test(telefono)) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, introduzca un número de teléfono válido para España o Europa.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    let numeroRegex = /^[1-9][0-9]*$/;
    // Validar que el número de viajeros sea mayor o igual a 1
    if (!/^([1-9][0-9]*)$/.test(total_viajeros) || parseInt(total_viajeros) < 1) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, introduzca un número válido mayor o igual a 1 para el número de viajeros.</strong></h4>`,
            icon: "error",
        });
        return;
    }
    // Validar que el número de niños sea un número válido o esté vacío
    if (parseInt(total_ninyos_menores_de_12) < 0) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, introduzca un número válido para el número de niños.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    if (parseInt(total_ninyos_menores_de_12) > parseInt(total_viajeros)) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El número de niños no puede ser mayor que el número de viajeros.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    // Validar las fechas
    let fechaDesde = new Date(fecha_desde);
    let fechaHasta = new Date(fecha_hasta);
    let hoy = new Date();
    hoy.setHours(0, 0, 0, 0);

    if (fechaDesde.getTime() < hoy.getTime()) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>La fecha desde no puede ser menor que hoy.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    if (fechaHasta.getTime() < hoy.getTime()) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>La fecha hasta no puede ser menor que hoy.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    if (fechaHasta.getTime() < fechaDesde.getTime()) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>La fecha hasta no puede ser menor que la fecha desde.</strong></h4>`,
            icon: "error",
        });
        return;
    }


    // Crear objeto con los datos del formulario
    let data = {
        'nombre': nombre,
        'email': email,
        'telefono': telefono,
        'asunto': asunto,
        'mensaje': mensaje,
        'total_viajeros': total_viajeros,
        'total_ninyos_menores_de_12': total_ninyos_menores_de_12,
        'fecha_desde': fecha_desde,
        'fecha_hasta': fecha_hasta,
    };

    // Enviar los datos mediante una petición AJAX
    $.post('controlador/emails/enviar_emails.php', {
        'accion': 'recoger_info_presupuesto',
        'data': data,
    }, function (result) {
        console.log(result);
        let respuesta = JSON.parse(result);
        if (respuesta) {
            console.log('RESPUESTA PARSEADA enviar_datos_presupuesto', respuesta);
            if (respuesta.status != 'success') {
                swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>Operación fallida, por favor intente pasados unos minutos.</strong></h4>`,
                    icon: "error",
                });
            } else {
                swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>${respuesta.message}.</strong></h4>`,
                    icon: "success",
                });
                // Resetear cada campo del formulario después de un envío exitoso
                document.getElementById('name').value = '';
                document.getElementById('email').value = '';
                document.getElementById('phone').value = '';
                document.getElementById('asunto').value = '';
                document.getElementById('message').value = '';
                document.getElementById('fecha_desde').value = '';
                document.getElementById('fecha_hasta').value = '';
                document.getElementById('total_viajeros').value = '';
                document.getElementById('total_ninyos_menores_de_12').value = '';
            }
        }
    }).fail(function (error) {
        swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Operación fallida, por favor intente pasados unos minutos.</strong></h4>`,
            icon: "error",
        });
        console.error(error);
    });
}
