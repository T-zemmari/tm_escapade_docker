$(document).ready(function () {
    console.log('Login');

    $(`#btn_registro`).click(function () {
        //let name = $(`#register_input_name`).val();
        //let lastname = $(`#register_input_lastname`).val();
        let email = $(`#register_input_email`).val();
        let password = $(`#register_input_password`).val();
        let re_password = $(`#register_input_repeat_password`).val();

        // Validaciones en el lado del cliente
        let isValid = true;

        // Validación para el correo electrónico
        if (email.trim() === '' || !/\S+@\S+\.\S+/.test(email)) {
            $(`#register_email_error`).text("Correo electrónico no válido");
            isValid = false;
        } else {
            $(`#register_email_error`).text("");
        }

        // Validación para la contraseña
        if (password.trim() === '' || !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/.test(password)) {
            $(`#register_pass_error`).text("Contraseña no válida. Debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula y un número.");
            isValid = false;
        } else {
            $(`#register_pass_error`).text("");
        }

        if (re_password.trim() === '' || re_password !== password) {
            $(`#repeat_pass_error`).text("Las contraseñas deben coincidir");
            isValid = false;
        } else {
            $(`#repeat_pass_error`).text("");
        }

        if (!isValid) {
            return;
        }

        let data = {
            'email': email,
            'password': password,
        }

        $.post('/controlador/ajax/funciones_registro_login_tienda.php', {
            'accion': 'registro',
            'data': data,
        }, function (result) {
            console.log(result);
            let respuesta = JSON.parse(result);
            if (respuesta) {
                let status = respuesta.status;
                if (status != 'success') {
                    alert(respuesta.mensaje)
                } else {
                    login(email, password);
                }
            }
        });
    });

    $(`#btn_login`).click(function () {
        let email = $(`#input_login_email`).val();
        let password = $(`#input_login_password`).val();

        // Validaciones en el lado del cliente
        let isValid = true;

        if (email.trim() === '' || !/\S+@\S+\.\S+/.test(email)) {
            $(`#login_email_error`).text("Correo electrónico no válido");
            isValid = false;
        } else {
            $(`#login_email_error`).text("");
        }

        // Validación para la contraseña
        if (password.trim() === '') {
            $(`#login_pass_error`).text("Contraseña no válida");
            isValid = false;
        } else {
            $(`#login_pass_error`).text("");
        }

        if (!isValid) {
            return;
        }

        login(email, password);
    });

});

function login(email, password) {
    let loginData = {
        'email': email,
        'password': password,
    };

    $.post('/controlador/ajax/funciones_registro_login_tienda.php', {
        'accion': 'login',
        'data': loginData,
    }, function (loginResult) {
        console.log(loginResult)
        let loginRespuesta = JSON.parse(loginResult);
        if (loginRespuesta && loginRespuesta.status === 'success') {
            window.location.href = 'tienda.php';
        } else {
            alert('Error en el login');
        }
    });
}