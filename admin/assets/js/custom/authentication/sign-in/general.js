"use strict";

// Class definition
var KTSigninGeneral = function () {
    // Elements
    var form;
    var submitButton;
    var validator;

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
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',  
                        eleValidClass: '' 
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
                    Swal.fire({
                        text: "Por favor, completa los campos correctamente.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
    };

    // Handle Ajax submission
    var submitForm = function () {
        // Show loading indicator
        form.setAttribute('data-kt-indicator', 'on');
        
        // Disable the submit button to prevent multiple clicks
        submitButton.disabled = true;

        // Get form data
        let data = {
            'email': $('#login_admin_email').val(),
            'password': $('#login_admin_password').val(),
            'accion': 'login',
        };

        // Make Ajax request
        axios.post('controlador/ajax/login_registro.php', data)
            .then(function (response) {
                // Handle successful response
                console.log(response);
                if (response.data && response.data.status === 'success') {
                    form.reset();

                    Swal.fire({
                        text: "Has iniciado sesión correctamente!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    //const redirectUrl = form.getAttribute('data-kt-redirect-url');
                     const redirectUrl = '/admin?pagina=admin_perfil';
                  
                    if (redirectUrl) {
                        location.href = redirectUrl;
                    }

                } else {
                    // Handle unsuccessful response
                    Swal.fire({
                        text: "Lo siento, el correo electrónico o la contraseña son incorrectos. Por favor, inténtalo de nuevo.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, entendido!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            })
            .catch(function (error) {
                // Handle error
                Swal.fire({
                    text: "Lo siento, parece que se han detectado algunos errores. Por favor, inténtalo de nuevo.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, entendido!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            })
            .then(function () {
                // Hide loading indicator
                form.removeAttribute('data-kt-indicator');
                
                // Enable the submit button
                submitButton.disabled = false;
            });
    };

    // Public functions
    return {
        // Initialization
        init: function () {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');

            handleValidation();
            handleSubmit();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTSigninGeneral.init();
});
