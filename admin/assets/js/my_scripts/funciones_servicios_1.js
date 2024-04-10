$(document).ready(function () {

    $('#btn_crear_nuevo_servicio_circuito_oferta').on('click', function () {

        $(`#btn_crear_nuevo_servicio_circuito_oferta`).attr('disabled', true);
        $(`#btn_cancelar_nuevo_servicio`).hide();

        if (validar_formulario_servicio()) {

            // Recolectar datos del formulario
            const formData = new FormData($('#form_nuevo_circuito')[0]);
            formData.append('accion', 'guardar_nuevo_circuito');

            // Recolectar la imagen principal
            const landingImage = $('#nuevo_servicio_landing_image_input')[0];
            if (landingImage.files.length > 0) {
                formData.append('landing_image', landingImage.files[0]);
            }

            const mainImageInput = $('#mainImageInput')[0];
            if (mainImageInput.files.length > 0) {
                formData.append('main_image', mainImageInput.files[0]);
            }

            // Recolectar imágenes adicionales
            const additionalImagesInput = $('#additionalImagesInput')[0];
            $.each(additionalImagesInput.files, function (index, file) {
                formData.append('additional_images[]', file);
            });

            let array_servicios_incluidos = [];
            let array_servicios_no_incluidos = [];

            $('.checkboxes-items-vincular').each(function () {
                let incluido_id = $(this).attr('id_incluido');
                if ($(this).is(':checked')) {
                    if ($(`#input_incluir_item_${incluido_id}`).is(':checked')) {
                        array_servicios_incluidos.push(incluido_id);
                    } else {
                        array_servicios_no_incluidos.push(incluido_id);
                    }
                }
            })

            formData.append('array_servicios_incluidos', JSON.stringify(array_servicios_incluidos));
            formData.append('array_servicios_no_incluidos', JSON.stringify(array_servicios_no_incluidos));

            // Realizar la petición AJAX
            $.ajax({
                url: '/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    // Puedes agregar un indicador de carga aquí
                },
                success: function (response) {
                    // Manejar la respuesta del servidor
                    console.log(response);
                    let respuesta = JSON.parse(response);
                    if (respuesta) {
                        console.log(respuesta);
                        let status = respuesta.status;
                        if (status != 'success') {
                            Swal.fire({
                                html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                                icon: "error",
                            });
                            $(`#btn_crear_nuevo_servicio_circuito_oferta`).attr('disabled', false);
                            $(`#btn_cancelar_nuevo_servicio`).show();
                        } else {
                            window.location.href = '/admin/?pagina=tours_y_circuitos';
                        }
                    }
                },
                error: function (xhr, status, error) {
                    // Manejar errores de la petición
                    console.error(xhr.responseText);
                    $(`#btn_crear_nuevo_servicio_circuito_oferta`).attr('disabled', false);
                    $(`#btn_cancelar_nuevo_servicio`).show();
                },
                complete: function () {
                    // Puedes quitar el indicador de carga aquí
                    $(`#btn_crear_nuevo_servicio_circuito_oferta`).attr('disabled', false);
                    $(`#btn_cancelar_nuevo_servicio`).show();
                }
            });
        } else {
            $(`#btn_crear_nuevo_servicio_circuito_oferta`).attr('disabled', false);
            $(`#btn_cancelar_nuevo_servicio`).show();
        }

    });

    $('#addImageBtn').on('click', function () {
        // Verificar el número máximo de imágenes
        const maxImages = 5;
        const currentImageCount = $('#additionalImagesPreviewContainer').children().length;

        if (currentImageCount >= maxImages) {
            alert('No se pueden agregar más de 5 imágenes.');
            return;
        }

        // Hacer clic en el input file oculto para imágenes adicionales
        $('#additionalImagesInput').click();
    });

    $('#selectMainImageBtn').on('click', function () {
        // Hacer clic en el input file oculto para la imagen principal
        $('#mainImageInput').click();
    });

    $('#mainImageInput').change(function () {
        // Mostrar la previsualización de la imagen principal
        const fileInput = $(this);
        const file = fileInput[0].files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const mainImageContainer = $('<div class="mb-2"/>');
                const mainImage = $('<img class="img-thumbnail"/>');
                mainImage.attr('src', e.target.result);
                mainImage.attr('alt', 'Main Image Preview');
                mainImage.css('width', '100px');
                mainImage.css('height', '100px');

                mainImageContainer.append(mainImage);
                $('#mainImagePreview').html(mainImageContainer);
            };

            reader.readAsDataURL(file);
        }
    });

    $('#additionalImagesInput').change(function () {
        // Mostrar la previsualización de las imágenes adicionales
        const fileInput = $(this);
        const files = fileInput[0].files;

        $.each(files, function (index, file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
                const image = $('<img class="img-thumbnail"/>'); // Crear un elemento img
                image.attr('src', e.target.result); // Establecer el atributo src en el elemento img
                image.attr('alt', 'Additional Image Preview');
                image.css('width', '100px');
                image.css('height', '100px');

                const removeBtn = $('<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>');
                removeBtn.on('click', function () {
                    imageContainer.remove();
                    fileInput.val(''); // Borrar el valor del input file
                });

                imageContainer.append(image);
                imageContainer.append(removeBtn);
                $('#additionalImagesPreviewContainer').append(imageContainer);
            };

            reader.readAsDataURL(file);
        });
    });

});

function calcular_cantidad_a_ingresar(servicio_id = null) {

    let precio = '';
    let porcentaje = '';
    let cantidadInput = '';
    // Obtener referencias a los elementos del formulario

    if (servicio_id != undefined && servicio_id != null && !isNaN(servicio_id)) {
        precio = parseFloat(document.getElementById(`precio_circuito_oferta_${servicio_id}`).value);
        porcentaje = parseFloat(document.getElementById(`select_porcentaje_circuito_oferta_${servicio_id}`).value);
        cantidadInput = document.getElementById(`cantidad_a_ingresar_${servicio_id}`);
    } else {
        precio = parseFloat(document.getElementById('precio_circuito_oferta').value);
        porcentaje = parseFloat(document.getElementById('select_porcentaje_circuito_oferta').value);
        cantidadInput = document.getElementById('cantidad_a_ingresar');
    }

    // Validar que el precio y el porcentaje sean números válidos
    if (isNaN(precio) || isNaN(porcentaje)) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa un precio y un porcentaje válidos.</strong></h4>`,
            icon: "error",
        });
        return;
    }

    // Calcular la cantidad a ingresar
    let cantidadIngresar = (precio * porcentaje) / 100;

    // Asignar el resultado al campo cantidad_a_ingresar
    cantidadInput.value = cantidadIngresar.toFixed(2);
}

function validar_formulario_servicio(origen) {
    // Obtener referencias a los elementos del formulario
    let titulo = document.getElementById('titulo_circuito');
    let descripcion = document.getElementById('descripcion_circuito_oferta');
    let estado = document.getElementById('select_estado_circuito');
    let select_particular_o_empresa_servicio = document.getElementById('select_particular_o_empresa_servicio');
    let tipoServicio = document.getElementById('select_tipo_servicio');
    let precio = document.getElementById('precio_circuito_oferta');
    let porcentaje = document.getElementById('select_porcentaje_circuito_oferta');
    let cantidad = document.getElementById('cantidad_a_ingresar');
    let mainImageInput = document.getElementById('mainImageInput');
    let landingImage = document.getElementById('nuevo_servicio_landing_image_input');

    // Validar que los campos obligatorios no estén vacíos

    if (!landingImage.files || landingImage.files.length === 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa la imagen para el landing .</strong></h4>`,
            icon: "error",
        });
        return false;
    }



    if (titulo.value.trim() === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa un título del circuito.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (select_particular_o_empresa_servicio.value.trim() === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Selecciona si es para empresa , particular o ambos.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (descripcion.value.trim() === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción del circuito.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (estado.value === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona un estado del circuito.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (tipoServicio.value === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona un tipo de servicio.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (!precio.value || precio.value.trim() === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el precio del circuito.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (porcentaje.value === '' || porcentaje.value === 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona un porcentaje.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (cantidad.value.trim() === '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa la cantidad a ingresar.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (!mainImageInput.files || mainImageInput.files.length === 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona una imagen principal.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    // Si todos los campos están llenos, el formulario es válido
    return true;
}


function fn_eliminar_servicio(servicio_id) {

    if (servicio_id == undefined || servicio_id == null || isNaN(servicio_id)) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Operación fallida (No se puede eliminar el servicio)</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Seguro que quieres eliminar el servicio ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {


            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'servicio_id': servicio_id,
                'accion': 'eliminar_servicio_circuito',
            }, function (response) {
                console.log(response);
                let respuesta = JSON.parse(response);
                if (respuesta) {
                    console.log(respuesta);
                    let status = respuesta.status;
                    if (status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        $(`#card_servicio_circ_${servicio_id}`).hide();
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>El servicio ha sido eliminado correctamente</strong></h4>`,
                            icon: "success",
                        });
                    }
                }
            });
        }
    });
}


function modificar_servicio_circuito(servicioId) {

    let data = {
        'servicio_id': servicioId,
        'select_estado_circuito': $('#select_estado_circuito_' + servicioId).val(),
        'select_tipo_servicio': $('#select_tipo_servicio_' + servicioId).val(),
        'titulo_circuito': $('#titulo_circuito_' + servicioId).val(),
        'titulo_circuito_largo': $('#titulo_circuito_largo_' + servicioId).val(),
        'descripcion_circuito_oferta': $('#descripcion_circuito_oferta_' + servicioId).val(),
        'precio_circuito_oferta': $('#precio_circuito_oferta_' + servicioId).val(),
        'select_porcentaje_circuito_oferta': $('#select_porcentaje_circuito_oferta_' + servicioId).val(),
        'cantidad_a_ingresar': $('#cantidad_a_ingresar_' + servicioId).val(),
        'mostrar_en_la_web': $('#select_mostrar_en_la_web_' + servicioId).val(),
        'select_particular_o_empresa_servicio': $('#select_particular_o_empresa_servicio_' + servicioId).val(),
        'descripcion_secundaria_uno': $('#descripcion_secundaria_uno_' + servicioId).val(),
        'descripcion_secundaria_dos': $('#descripcion_secundaria_dos_' + servicioId).val(),
    };

    // console.log('data', data);
    // return;

    // Realizar petición AJAX

    $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
        'data': data,
        'accion': 'editar_servicio_circuito',
    }, function (result) {
        console.log(result);
        let resultado = JSON.parse(result);
        if (resultado) {
            console.log('RESULTADO modificar_servicio_circuito', resultado);
            if (resultado.status != 'success') {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                    icon: "error",
                });
            } else {
                window.location.reload();
            }
        }
    }
    );
}


function eliminar_imagen(id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Quieres eliminar la imagen ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'media_id': id,
                'accion': 'eliminar_imagen_servicio',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO eliminar media servicio', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Imagen eliminada correctamente</strong></h4>`,
                            icon: "success",
                        });
                        $(`#contenedor_media_${id}`).hide();
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

function anyadir_mas_imagenes_al_servicio(servicio_id) {
    // Simular clic en el input de archivo para seleccionar imágenes
    $(`#additionalImagesInput_${servicio_id}`).click();

    // Escuchar cambios en el input de archivo
    $(`#additionalImagesInput_${servicio_id}`).on('change', function () {
        // Obtener las nuevas imágenes seleccionadas
        let nuevasImagenes = this.files;

        // Crear un objeto FormData y añadir datos
        let formData = new FormData();
        formData.append('servicio_id', servicio_id);
        formData.append('accion', 'anyadir_mas_imagenes_servicio');

        // Agregar cada nueva imagen al FormData
        for (let i = 0; i < nuevasImagenes.length; i++) {
            formData.append('imagenes[]', nuevasImagenes[i]);
        }

        // Realizar la petición AJAX
        $.ajax({
            url: '/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php',
            type: 'POST',
            data: formData,
            contentType: false, // No establecer contentType
            processData: false, // No procesar datos
            beforeSend: function () {
                // Puedes agregar un código para mostrar un indicador de carga o deshabilitar el botón durante la carga
            },
            success: function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO anyadir_mas_imagenes_al_servicio', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>${resultado.message}</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        //$(`#additionalImagesPreviewContainer_${servicio_id}`).empty();
                        $.each(resultado['datos_post']['array_rutas_resto_imagenes'], function (index, imageData) {
                            const imageUrl = imageData['nueva_url'];
                            const imageId = imageData['id'];

                            const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
                            const image = $('<img class="img-thumbnail"/>');
                            image.attr('src', imageUrl);
                            image.attr('alt', 'Additional Image');
                            image.css('width', '100px');
                            image.css('height', '100px');

                            const removeBtn = $('<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>');
                            removeBtn.on('click', function () {
                                eliminar_imagen(imageId);
                            });

                            imageContainer.append(image);
                            imageContainer.append(removeBtn);
                            $(`#additionalImagesPreviewContainer_${servicio_id}`).append(imageContainer);
                        });
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>${resultado.message}</strong></h4>`,
                            icon: "success",
                        });
                    }
                }
            },
            error: function (error) {
                console.error(error);
                // Puedes manejar errores durante la petición aquí
            },
            complete: function () {
                // Puedes agregar un código que se ejecute después de completar la petición
            }
        });
    });
}

function escoger_otra_imagen_principal(servicio_id) {
    // Simular clic en el input de archivo
    $(`#mainImageInput_${servicio_id}`).click();

    // Escuchar cambios en el input de archivo
    $(`#mainImageInput_${servicio_id}`).on('change', function () {
        // Obtener la nueva imagen seleccionada
        let nuevaImagen = this.files[0];

        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>¿ Modificarás la imagen principal ?</strong></h4>`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Modificar",
            denyButtonText: `Cancelar`
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear un objeto FormData y añadir datos
                let formData = new FormData();
                formData.append('imagen_principal', nuevaImagen);
                formData.append('servicio_id', servicio_id);
                formData.append('accion', 'modificar_imagen_principal_servicio');

                // Realizar la petición AJAX
                $.ajax({
                    url: '/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php',
                    type: 'POST',
                    data: formData,
                    contentType: false, // No establecer contentType
                    processData: false, // No procesar datos
                    beforeSend: function () {
                        // Puedes agregar un código para mostrar un indicador de carga o deshabilitar el botón durante la carga
                    },
                    success: function (result) {
                        console.log(result);
                        let resultado = JSON.parse(result);
                        if (resultado) {
                            console.log('RESULTADO escoger_otra_imagen_principal', resultado);
                            if (resultado.status != 'success') {
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                                    icon: "error",
                                });
                            } else {
                                $(`#imagen_principal_${servicio_id}`).attr('src', `${resultado['nueva_url']}`);
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>La imagen principal ha sido modificada correctamente</strong></h4>`,
                                    icon: "success",
                                });
                            }
                        }
                    },
                    error: function (error) {
                        console.error(error);
                        // Puedes manejar errores durante la petición aquí
                    },
                    complete: function () {
                        // Puedes agregar un código que se ejecute después de completar la petición
                    }
                });
            }
        });
    });
}

function modificar_servicio_landing_img(servicio_id) {
    console.log('AQUII')
    // Simular clic en el input de archivo
    $(`#modificar_servicio_landing_image_input_${servicio_id}`).click();

    // Escuchar cambios en el input de archivo
    $(`#modificar_servicio_landing_image_input_${servicio_id}`).on('change', function () {
        // Obtener la nueva imagen seleccionada
        let nuevaImagen = this.files[0];

        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>¿ Modificarás la imagen landing ?</strong></h4>`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Modificar",
            denyButtonText: `Cancelar`
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear un objeto FormData y añadir datos
                let formData = new FormData();
                formData.append('imagen_landing', nuevaImagen);
                formData.append('servicio_id', servicio_id);
                formData.append('accion', 'modificar_landing_imagen_servicio');

                // Realizar la petición AJAX
                $.ajax({
                    url: '/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php',
                    type: 'POST',
                    data: formData,
                    contentType: false, // No establecer contentType
                    processData: false, // No procesar datos
                    beforeSend: function () {
                        // Puedes agregar un código para mostrar un indicador de carga o deshabilitar el botón durante la carga
                    },
                    success: function (result) {
                        console.log(result);
                        let resultado = JSON.parse(result);
                        if (resultado) {
                            console.log('RESULTADO modificar_servicio_landing_img', resultado);
                            if (resultado.status != 'success') {
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                                    icon: "error",
                                });
                            } else {
                                $(`#imagen_landing_actual_${servicio_id}`).attr('src', `${resultado['nueva_url']}`);
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>La imagen landing ha sido modificada correctamente</strong></h4>`,
                                    icon: "success",
                                });
                            }
                        }
                    },
                    error: function (error) {
                        console.error(error);
                        // Puedes manejar errores durante la petición aquí
                    },
                    complete: function () {
                        // Puedes agregar un código que se ejecute después de completar la petición
                    }
                });
            }
        });
    });
}

function toggle_titulo_servicio(servicio_id, titulo_completo) {
    let titulo_element = document.getElementById(`span_titulo_servicio_completo_${servicio_id}`);
    let ver_mas_btn = document.getElementById(`ver_mas_btn_${servicio_id}`);

    if (titulo_element.innerText === titulo_completo) {
        titulo_element.innerText = titulo_completo.substring(0, 50) + '... ';
        ver_mas_btn.innerText = "más";
    } else {
        titulo_element.innerText = titulo_completo;
        ver_mas_btn.innerText = "menos";
    }
}

function filtrar_servicios_por_titulo() {
    let info_input = $(`#input_text_buscar_servicios_tours`).val();
    if (info_input != undefined && info_input != null && info_input != '') {
        info_input = info_input.toLowerCase();
    }

    $('.filtrar-servicios').each(function () {
        let titulo_servicio = $(this).attr('titulo');
        if (titulo_servicio != '') {
            titulo_servicio = titulo_servicio.toLowerCase();
        }
        if (info_input == '' || titulo_servicio.includes(info_input)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}

function preview_servicio_inlcuido_icono(input) {
    const file = input.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const imgPreview = document.getElementById('icono_preview');
            imgPreview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
}


function guardar_nuevo_servicio_incluido() {
    // Obtener los valores de los campos del formulario
    let tituloServicio = $('#titulo_servicio_incluido').val();
    let tipo = $(`#select_tipo`).val();
    // Verificar si se ha seleccionado una imagen
    let iconoServicio = $('#icono_servicio_incluido')[0].files[0];
    let check_mostrar_para_seleccionar = 0;
    if ($(`#check_mostrar_para_seleccionar`).is(':checked')) {
        check_mostrar_para_seleccionar = 1;
    }

    // console.log($(`#check_mostrar_para_seleccionar`).is(':checked'));return;

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
                    let nuevoServicioId = respuesta.datos_post.last_id;
                    let icono = respuesta.datos_post.url_icono_servicio_incluido;
                    // Agregar el nuevo servicio al select

                    let HTML = `
                        <tr id="tr_fila_servicio_incluido_o_no_incluido_${nuevoServicioId}">
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
                            <td class="text-end">
                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2">
                                    <input type="checkbox" value="" class="form-check-input" id="input_incluir_item_${nuevoServicioId}" />
                                </div>
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

function fn_desvincular_item_incluido_o_no_incluido_del_servicio(item_id, servicio_id) {

    Swal.fire({
        html: "<h4>El item se desvinculara del servicio <br> ¿ Seguro que quieres continuar ?</br> La vista se va a refrescar</h4>",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Desvincular",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            console.log('fn_desvincular_item_incluido_o_no_incluido_del_servicio', item_id, servicio_id);
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'accion': 'desvincular_incluidos_del_servicio',
                'item_id': item_id,
                'servicio_id': servicio_id,
            }, function (result) {
                console.log(result);
                let respuesta = JSON.parse(result);
                if (respuesta) {
                    if (respuesta.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ocurrio un error , intentalo de nuevo mas tarde</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>La operación se realizo con exito</strong></h4>`,
                            icon: "success",
                        });
                        window.location.reload();
                    }
                }
            })

        }
    });
}

function modificar_estado_es_incluido(id) {


    let checked = 0;
    let info = 'NO INCLUIDO';
    if ($(`#check_es_incluido_${id}`).is(':checked')) {
        checked = 1;
        info = 'INCLUIDO';
    };
    // console.log(id);
    // console.log(checked);
    // console.log(info);
    // return;
    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ El servicio se mostrara como </br> ${info} ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Modificar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'item_id': id,
                'checked': checked,
                'accion': 'modificar_es_incluido',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO modificar_estado_es_incluido', resultado);
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

function fn_incluir_nuevo_item_al_servicio(item_id, servicio_id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>El nuevo item se vinculara con el servicio </br> ¿ Quieres seguir ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Vincular",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_servicios_circuitos_ofertas.php', {
                'item_id': item_id,
                'servicio_id': servicio_id,
                'accion': 'vincular_item_con_el_servicio',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO fn_incluir_nuevo_item_al_servicio', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error ! intentalo mas tarde o contacta con el administrador.</strong></h4>`,
                            icon: "error",
                        });
                    } else {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>Operación realizada con exito</strong></h4>`,
                            icon: "success",
                        });
                        window.location.reload();
                    }
                }
            }
            );
        }
    });
}
