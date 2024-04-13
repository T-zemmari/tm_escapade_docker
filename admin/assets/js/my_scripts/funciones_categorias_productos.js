$(document).ready(function () {
    console.log('CATEGORIAS Y PRODUCTOS');

    $('#resto_imagenes_categoria').on('click', function () {
        // Verificar el número máximo de imágenes
        const maxImages = 5;
        const currentImageCount = $('#resto_imagenes_categoria_preview').children().length;

        console.log(currentImageCount);
        if (currentImageCount >= maxImages) {
            alert('No se pueden agregar más de 5 imágenes.');
            return;
        }

        // Hacer clic en el input file oculto para imágenes adicionales
        $('#resto_imagenes_categoria_input').click();
    });


    $('#resto_imagenes_categoria_input').change(function () {
        // Mostrar la previsualización de las imágenes adicionales
        const fileInput = $(this);
        const files = fileInput[0].files;

        $.each(files, function (index, file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
                const image = $('<img class="img-thumbnail"/>');
                image.attr('src', e.target.result); 
                image.attr('alt', 'Additional Image Preview');
                image.css('width', '100px');
                image.css('height', '100px');

                const removeBtn = $('<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>');
                removeBtn.on('click', function () {
                    imageContainer.remove();
                    fileInput.val('');
                });

                imageContainer.append(image);
                imageContainer.append(removeBtn);
                $('#resto_imagenes_categoria_preview').append(imageContainer);
            };

            reader.readAsDataURL(file);
        });
    });

});


/*####################################################################################################################################################*/
/*###################################################### FUNCIONES PARA CATEGORIAS ###################################################################*/
/*####################################################################################################################################################*/


function crear_nueva_categoria() {

    let categoria_nombre = document.getElementById('categoria_nombre').value;
    let categoria_descripcion = document.getElementById('categoria_descripcion').value;
    let categoria_estado = document.getElementById('select_categoria_estado').value;
    let categoria_imagen_principal = document.getElementById('categoria_imagen_principal');
    let categoria_resto_imagenes = document.getElementById('resto_imagenes_categoria_input');

    //console.log('categoria_estado',categoria_estado);return;

    if (categoria_nombre.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el nombre de la categoria.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (categoria_estado.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona el estado.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (categoria_descripcion.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción de la categoria.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    // Crear un objeto FormData para enviar los datos al servidor

    let formData = new FormData();

    formData.append('categoria_nombre', categoria_nombre);
    formData.append('categoria_descripcion', categoria_descripcion);
    formData.append('categoria_estado', categoria_estado);

    // Recolectar la imagen principal

    if (categoria_imagen_principal.files.length > 0) {
        formData.append("categoria_imagen_principal", categoria_imagen_principal.files[0]);
    }

    if (categoria_imagen_principal.files.length === 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Debes subir una imagen principal</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    // Recolectar imágenes adicionales
    $.each(categoria_resto_imagenes.files, function (index, file) {
        formData.append("categoria_resto_imagenes[]", file);
    });

    formData.append("accion", 'guardar_nueva_categoria');

    // Realizar la petición AJAX

    $.ajax({
        url: "/admin/controlador/ajax/funciones_categorias_productos.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            let respuesta = JSON.parse(response);
            if (respuesta) {
                console.log(respuesta);
                let status = respuesta.status;
                if (status != "success") {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                        icon: "error",
                    });
                    $(`#btn_crear_nueva_categoria`).attr(
                        "disabled",
                        false
                    );
                } else {
                    window.location.href = "/admin/?pagina=lista_categorias";
                }
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            $(`#btn_crear_nueva_categoria`).attr("disabled", false);
        },
        complete: function () {
            $(`#btn_crear_nueva_categoria`).attr("disabled", false);
        },
    });

}

function fn_eliminar_categoria(categoria_id) {

    if (categoria_id == undefined || categoria_id == null || isNaN(categoria_id)) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Operación fallida (La categoria no ha sido eliminada)</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Seguro que quieres eliminar la categoria ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_categorias_productos.php', {
                'categoria_id': categoria_id,
                'accion': 'eliminar_categoria',
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
                        $(`#tr_categoria_${categoria_id}`).hide();
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>La categoria ha sido eliminada correctamente</strong></h4>`,
                            icon: "success",
                        });
                    }
                }
            });
        }
    });
}


function modificar_categoria(categoria_id) {

    let categoria_nombre = document.getElementById(`categoria_nombre_${categoria_id}`).value;
    let categoria_descripcion = document.getElementById(`categoria_descripcion_${categoria_id}`).value;
    let categoria_estado = document.getElementById(`select_categoria_estado_${categoria_id}`).value;
    let categoria_descatalogada = document.getElementById(`select_categoria_descatalogada_${categoria_id}`).value;

    // Validar que los campos obligatorios no estén vacíos

    if (categoria_nombre.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el nombre de la categoría.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (categoria_descripcion.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción de la categoría.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (categoria_estado.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona el estado de la categoría.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (categoria_descatalogada.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona el estado de descatalogado de la categoría.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    // Crear un objeto FormData para enviar los datos al servidor
    
    let formData = new FormData();
    formData.append('categoria_id', categoria_id);
    formData.append('categoria_nombre', categoria_nombre);
    formData.append('categoria_descripcion', categoria_descripcion);
    formData.append('categoria_estado', categoria_estado);
    formData.append('categoria_descatalogada', categoria_descatalogada);
    formData.append('accion', 'modificar_categoria');

    // Realizar la petición AJAX

    $.ajax({
        url: "/admin/controlador/ajax/funciones_categorias_productos.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            console.log(response);
            let respuesta = JSON.parse(response);
            if (respuesta) {
                console.log(respuesta);
                let status = respuesta.status;
                if (status != "success") {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                        icon: "error",
                    });
                } else {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>La categoría ha sido modificada correctamente.</strong></h4>`,
                        icon: "success",
                    }).then(() => {
                        window.location.reload();
                    });
                }
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        },
    });
}


function eliminar_imagen_secundaria_categoria(id) {

    Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Quieres eliminar la imagen ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Eliminar",
        denyButtonText: `Cancelar`
    }).then((result) => {
        if (result.isConfirmed) {
            $.post('/admin/controlador/ajax/funciones_categorias_productos.php', {
                'media_id': id,
                'accion': 'eliminar_imagen_categoria',
            }, function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO eliminar media categoria', resultado);
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
                        $(`#contenedor_categoria_media_${id}`).hide();
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



function modificar_imagen_principal_categoria(categoria_id) {

    $(`#modificar_imagen_principal_categoria_${categoria_id}`).click();

    // Escuchar cambios en el input de archivo
    $(`#modificar_imagen_principal_categoria_${categoria_id}`).on('change', function () {

        let nuevaImagen = this.files[0];

        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>¿ Modificarás la imagen principal ?</strong></h4>`,
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Modificar",
            denyButtonText: `Cancelar`
        }).then((result) => {
            if (result.isConfirmed) {

                let formData = new FormData();
                formData.append('imagen_principal', nuevaImagen);
                formData.append('categoria_id', categoria_id);
                formData.append('accion', 'modificar_imagen_principal_categoria');

                // Realizar la petición AJAX

                $.ajax({
                    url: '/admin/controlador/ajax/funciones_categorias_productos.php',
                    type: 'POST',
                    data: formData,
                    contentType: false, 
                    processData: false,
                    success: function (result) {
                        console.log(result);
                        let resultado = JSON.parse(result);
                        if (resultado) {
                            console.log('RESULTADO modificar_imagen_principal_categoria', resultado);
                            if (resultado.status != 'success') {
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                                    icon: "error",
                                });
                            } else {
                                $(`#imagen_principal_actual_${categoria_id}`).attr('src', `${resultado['nueva_url']}`);
                                Swal.fire({
                                    html: `<h4 style="margin-top:25px"><strong>La imagen principal ha sido modificada correctamente</strong></h4>`,
                                    icon: "success",
                                });
                            }
                        }
                    },
                    error: function (error) {
                        console.error(error);
                    },

                });
            }
        });
    });
}


function anyadir_mas_imagenes_a_la_categoria(categoria_id) {

    $(`#resto_imagenes_categoria_input_${categoria_id}`).click();

    // Escuchar cambios en el input de archivo
    $(`#resto_imagenes_categoria_input_${categoria_id}`).on('change', function () {

        let nuevasImagenes = this.files;

        // Crear un objeto FormData y añadir datos
        let formData = new FormData();
        formData.append('categoria_id', categoria_id);
        formData.append('accion', 'anyadir_mas_imagenes_categoria');

        // Agregar cada nueva imagen al FormData

        for (let i = 0; i < nuevasImagenes.length; i++) {
            formData.append('imagenes[]', nuevasImagenes[i]);
        }

        // Realizar la petición AJAX

        $.ajax({
            url: '/admin/controlador/ajax/funciones_categorias_productos.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
                console.log(result);
                let resultado = JSON.parse(result);
                if (resultado) {
                    console.log('RESULTADO anyadir_mas_imagenes_a_la_categoria', resultado);
                    if (resultado.status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px"><strong>${resultado.message}</strong></h4>`,
                            icon: "error",
                        });
                    } else {

                        // Iterar sobre las nuevas imágenes agregadas

                        $.each(resultado['datos_post']['array_rutas_resto_imagenes'], function (index, imageData) {
                            const imageUrl = imageData['nueva_url'];
                            const imageId = imageData['id'];

                            // Crear un contenedor para la imagen y el botón de eliminación

                            const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
                            const image = $('<img class="img-thumbnail"/>');
                            image.attr('src', imageUrl);
                            image.attr('alt', 'Additional Image');
                            image.css('width', '100px');
                            image.css('height', '100px');

                            const removeBtn = $('<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>');
                            removeBtn.on('click', function () {
                                eliminar_imagen_secundaria_categoria(imageId);
                            });

                            // Agregar la imagen y el botón al contenedor

                            imageContainer.append(image);
                            imageContainer.append(removeBtn);

                            // Agregar el contenedor al contenedor de imágenes previas

                            $(`#resto_imagenes_categoria_preview_${categoria_id}`).append(imageContainer);
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
        });
    });
}




