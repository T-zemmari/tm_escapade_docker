$("#owl_carousel_4").owlCarousel({
    navigation: false,
    slideSpeed: 300,
    paginationSpeed: 500,
    items: 1,
    singleItem: true,
    autoPlay: 4000
});

function suscribirse() {
    let email = $(`#susc_email_id`).val();

    // Validar el formato del correo electrónico
    if (!isValidEmail(email)) {
        Swal.fire({
            html: `<h4 style="margin-top:25px">Formato de correo electrónico incorrecto</strong></h4>`,
            icon: "error",
        });
        return;
    }

    $.post('/controlador/ajax/funciones_suscribirse.php', {
        'accion': 'cliente_suscripcion',
        'email': email,
    }, function (result) {
        let respuesta = JSON.parse(result);
        if (respuesta) {
            $(`#susc_email_id`).val('');
            Swal.fire({
                html: `<h4 style="margin-top:25px">Gracias por tu suscripción</strong></h4>`,
                icon: "success",
            });
        }
    });
}

// Función para validar el formato de correo electrónico
function isValidEmail(email) {
    // Expresión regular para validar el formato de correo electrónico
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}