"use strict";

// Class definition
var KTSignupGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;
    var passwordMeter;

    // Handle form validation
    var handleValidation = function () {
        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'La dirección de correo electrónico es obligatoria'
                            },
                            emailAddress: {
                                message: 'El valor no es una dirección de correo electrónico válida'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'La contraseña es obligatoria'
                            },
                            callback: {
                                message: 'Por favor, introduce una contraseña válida',
                                callback: function (input) {
                                    if (input.value.length > 0) {
                                        return validatePassword();
                                    }
                                }
                            }
                        }
                    },
                    'confirm-password': {
                        validators: {
                            notEmpty: {
                                message: 'La confirmación de la contraseña es obligatoria'
                            },
                            identical: {
                                compare: function () {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'La contraseña y su confirmación no son iguales'
                            }
                        }
                    },
                    'codigo-registro': {
                        validators: {
                            notEmpty: {
                                message: 'El código de registro es obligatorio'
                            }
                            // Puedes agregar más validaciones según sea necesario
                        }
                    },
                    'toc': {
                        validators: {
                            notEmpty: {
                                message: 'Debes aceptar los términos y condiciones'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger({
                        event: {
                            password: false
                        }
                    }),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  // comment to enable invalid state icons
                        eleValidClass: '' // comment to enable valid state icons
                    })
                }
            }
        );
    };

    // Handle form submission
    var handleSubmit = function () {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Validate the form
            validator.validate().then(function (status) {
                if (status === 'Valid') {
                    // If the form is valid, proceed with Ajax request
                    submitForm();
                } else {
                    // If the form is invalid, show an error message
                    handleFormError();
                }
            });
        });
    };

    // Handle Ajax submission
    var submitForm = function () {
        // Show loading indicator
        submitButton.setAttribute('data-kt-indicator', 'on');

        // Disable the submit button to prevent multiple clicks
        submitButton.disabled = true;

        // Get form data
        let data = {
            'email': form.querySelector('[name="email"]').value,
            'nombre': form.querySelector('[name="nombre"]').value,
            'password': form.querySelector('[name="password"]').value,
            'codigo_registro': form.querySelector('[name="codigo-registro"]').value,
            'accion': 'registro',
        };

        // Make Ajax request
        axios.post('admin/controlador/ajax/login_registro.php', data)
            .then(function (response) {
                // Handle successful response
                console.log(response);
                if (response.data && response.data.status === 'success') {
                    handleFormSubmit();
                } else {
                    // Handle unsuccessful response
                    let message='';
                    if (response.data && response.data.mensaje_error!=undefined && response.data.mensaje_error!=null && response.data.mensaje_error!='' ){
                        message=response.data.mensaje_error;
                    }
    
                    handleFormError(message);
                }
            })
            .catch(function (error) {
                // Handle error
                handleFormError();
            })
            .then(function () {
                // Hide loading indicator
                submitButton.removeAttribute('data-kt-indicator');

                // Enable the submit button
                submitButton.disabled = false;
            });
    };

    // Handle form submit success
    var handleFormSubmit = function () {
        // Show success message
        Swal.fire({
            text: "Has registrado tu cuenta con éxito!",
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok, entendido!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                form.reset();  // reset form
                //passwordMeter.reset();  // reset password meter

                // Redirect to the desired URL
                //var redirectUrl = form.getAttribute('data-kt-redirect-url');
                var redirectUrl = '/admin_login';
                if (redirectUrl) {
                    location.href = redirectUrl;
                }
            }
        });
    }

    // Handle form submit error
    var handleFormError = function (message='') {
        // Show error message
        let error='Lo siento, parece que se han detectado algunos errores. Por favor, inténtalo de nuevo.';
        if(message!='')error=message;
        Swal.fire({
            text: error,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, entendido!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    }

    // Password input validation
    var validatePassword = function () {
        var password = form.querySelector('[name="password"]').value;

        // Al menos 8 caracteres, una letra mayúscula, una letra minúscula y un carácter especial
        var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
        return passwordRegex.test(password);
    }

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_up_form');
            submitButton = document.querySelector('#kt_sign_up_submit');
            passwordMeter = KTPasswordMeter.getInstance(form.querySelector('[data-kt-password-meter="true"]'));

            handleValidation();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSignupGeneral.init();
});
