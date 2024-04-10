let ckEditors = {};


$(document).ready(function () {
    console.log('FUNCIONES ELEMENTOS WEB');

    if (document.getElementById('campo_imagen')) {
        document.getElementById('campo_imagen').addEventListener('change', function (event) {
            let vistaPrevia = document.getElementById('vista_previa_imagen');
            vistaPrevia.innerHTML = '';

            let archivos = event.target.files;
            if (archivos.length > 0) {
                let imagen = document.createElement('img');
                imagen.src = URL.createObjectURL(archivos[0]);
                vistaPrevia.appendChild(imagen);
            }
        });
    }

    if (document.getElementById('campo_video')) {
        document.getElementById('campo_video').addEventListener('change', function (event) {
            let vistaPrevia = document.getElementById('vista_previa_video');
            vistaPrevia.innerHTML = '';

            let archivos = event.target.files;
            if (archivos.length > 0) {
                let video = document.createElement('video');
                video.src = URL.createObjectURL(archivos[0]);
                video.controls = true; // Añadir controles de reproducción
                vistaPrevia.appendChild(video);
            }
        });
    }







    // var options = { selector: "#kt_docs_tinymce_basic", height: "480" };
    // if (KTThemeMode.getMode() === "dark") {
    //     options["skin"] = "oxide-dark";
    //     options["content_css"] = "dark";
    // }
    //tinymce.init(options);

    // $('.tr-anidado-elemento-contenido').each(function () {
    //     let elemento_id = $(this).attr('elementoid');
    //     let editorId = `#kt_docs_ckeditor_classic_${elemento_id}`;

    //     ClassicEditor
    //         .create(document.querySelector(editorId), {
    //             autoParagraph: false,
    //         })
    //         .then(editor => {
    //             ckEditors[elemento_id] = editor;
    //         })
    //         .catch(error => {
    //             console.error(error);
    //         });
    // });

    // ClassicEditor
    //     .create(document.querySelector(`#kt_docs_ckeditor_classic_modal_elementos`), {
    //         autoParagraph: false,
    //     })
    //     .then(editor => {
    //         console.log('aqui');
    //         ckEditors['nuevo_elemento'] = editor;
    //     })
    //     .catch(error => {
    //         console.error(error);
    //     });
});



// function guardar_contenido_elemento(elemento_id) {
//     let editor = ckEditors[elemento_id];
//     if (editor) {
//         let contenido = editor.getData();
//         console.log(contenido);
//         if (contenido != '') {

//             let data = {
//                 'id': elemento_id,
//                 'contenido': contenido,
//             }

//             $.post('/admin/controlador/ajax/funciones_elementos_web.php', {
//                 'data': data,
//                 'accion': 'editar_contenido_elemento',
//             }, function (response) {
//                 console.log('response guardar_contenido_elemento', response);
//                 let respuesta = JSON.parse(response);
//                 if (respuesta) {

//                 }
//             })

//         }
//     } else {
//         console.error('Editor no encontrado para el ID:', elemento_id);
//     }
// }

function mostrar_tr_elemento_anidado(elemento_id) {
    $(`#tr_anidado_elemento_${elemento_id}`).toggle(200);

}


function editar_contenido_elemento(elemento_id) {
    let contenido = $(`#text_area_tabla_elemento_${elemento_id}`).val();
    if (contenido != '') {
        let data = {
            'id': elemento_id,
            'contenido': contenido,
        }
        $.post('/admin/controlador/ajax/funciones_elementos_web.php', {
            'data': data,
            'accion': 'editar_contenido_elemento',
        }, function (response) {
            console.log('response editar_contenido_elemento', response);
            let respuesta = JSON.parse(response);
            if (respuesta) {
                console.log('Respuesta editar contenido elemento', respuesta);
                let status = respuesta.status;
                let guardado = respuesta.guardado;
                if (status == 'success') {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>El contenido ha sido modificado correctamente</strong></h4>`,
                        icon: "success",
                    });
                }
                if (status == 'error' || guardado == false) {
                    Swal.fire({
                        html: `<h4 style="margin-top:25px"><strong>No ha sido posible modificar el contenido</strong></h4>`,
                        icon: "error",
                    });
                }
            }
        })
    }
}


function filtrar_por_nombre() {
    let valor_input_buscar = $(`#buscar_elemento_por_nombre`).val().toUpperCase();
    $(`.filtrar_elementos`).each(function () {
        let nombre = $(this).attr('nombre').toUpperCase();
        if (valor_input_buscar == '' || nombre.includes(valor_input_buscar)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    })
}

function guardar_nuevo_elemento() {
    // Obtener valores de los campos
    let nombreElemento = $('#nombre_elemento').val();
    let refElementoId = $('#ref_elemento_id').val();
    let refElementoClase = $('#ref_elemento_clase').val();
    let selectEstado = $('#select_estado').val();
    let selectTipo = $('#select_tipo').val();
    let selectLugarWeb = $('#select_lugar_web').val();
    let esBanner = $('#select_es_banner').val();

    // Crear objeto FormData
    let formData = new FormData();

    // Agregar valores a FormData
    formData.append('nombre_elemento', nombreElemento);
    formData.append('ref_elemento_id', refElementoId);
    formData.append('ref_elemento_clase', refElementoClase);
    formData.append('select_estado', selectEstado);
    formData.append('select_tipo', selectTipo);
    formData.append('select_lugar_web', selectLugarWeb);
    formData.append('es_banner', esBanner);
    formData.append('accion', 'nuevo_elemento');

    // Definir el contenido basado en el tipo seleccionado
    if (selectTipo === 'texto') {
        formData.append('contenido', $('#text_area_elemento_html').val());
    } else if (selectTipo === 'img') {
        // Manejar el campo de imagen
        let imagenInput = $('#campo_imagen')[0];
        if (imagenInput.files.length > 0) {
            formData.append('imagen', imagenInput.files[0]);
        } else {
            console.error('No se seleccionó ninguna imagen.');
            return;
        }
    } else if (selectTipo === 'video') {
        // Manejar el campo de video
        formData.append('video', $('#campo_video').val());
    }

    // Realizar la solicitud AJAX con $.post
    $.post({
        url: '/admin/controlador/ajax/funciones_elementos_web.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            // Manejar la respuesta del servidor aquí
            console.log(response);
            let respuesta = JSON.parse(response);
            if (respuesta) {
                console.log('respuesta guardar_nuevo_elemento', respuesta);
                let status = respuesta.status;
                if (status != 'success') {
                    console.log('ERROR', respuesta);
                } else {
                    window.location.reload();
                }
            }
            // Puedes realizar acciones adicionales después de guardar
        },
        error: function (error) {
            console.error('Error en la solicitud AJAX', error);
        }
    });
}


function fn_modificar_archivo(elementoId, tipo) {
    let fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.accept = tipo === 'img' ? 'image/*' : 'video/*';

    fileInput.addEventListener('change', function () {
        let file = fileInput.files[0];
        if (file) {
            subir_nuevo_archivo_media_elemento(elementoId, tipo, file);
        }
    });

    fileInput.click();
}

function subir_nuevo_archivo_media_elemento(elementoId, tipo, archivo) {

    let formData = new FormData();
    formData.append('accion', 'modificar_media_elemento');
    formData.append('elemento_id', elementoId);
    formData.append('tipo', tipo);
    formData.append('archivo', archivo);

    try {
        $.post({
            url: '/admin/controlador/ajax/funciones_elementos_web.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                let respuesta = JSON.parse(response);
                if (respuesta) {
                    let status = respuesta.status;
                    if (status != 'success') {
                        Swal.fire({
                            html: `<h4 style="margin-top:25px">Operación fallida!! Intentalo mas tarde</strong></h4>`,
                            icon: "error",
                        });
                    } else {

                        Swal.fire({
                            html: `<h4 style="margin-top:25px">Archivo modificado correctamente</strong></h4>`,
                            icon: "success",
                        });

                        let nueva_url = respuesta.nueva_url;
                        let tipo = respuesta.tipo;
                        if (tipo == 'img') $(`#img_src_elemento_${elementoId}`).attr('src', nueva_url);
                        if (tipo == 'video') $(`#video_src_elemento_${elementoId}`).attr('src', nueva_url);


                    }
                }

            },
            error: function (error) {
                console.error(error);
            }
        });
    } catch (error) {
        console.log('Error al subir archivo:', error);
    }
}



function modificar_estado_elemento(elemento_id) {

    let estado = 0;
    if ($(`#check_activo_elemento_${elemento_id}`).is(':checked')) estado = 1;

    let data = {
        'id': elemento_id,
        'estado': estado,
    }
    console.log('data', data)
    $.post('/admin/controlador/ajax/funciones_elementos_web.php', {
        'data': data,
        'accion': 'modificar_estado_elemento',
    }, function (response) {
        console.log('response editar_estado_elemento', response);
        let respuesta = JSON.parse(response);
        if (respuesta) {

            console.log('Respuesta modificar estado elemento', respuesta);
            let status = respuesta.status;
            let modificado = respuesta.modificado;
            let estado = respuesta.estado;

            if (status == 'success') {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>El elemento esta ${estado == 1 ? 'Activado' : 'Desactivado'}</strong></h4>`,
                    icon: "success",
                });
            }
            if (status == 'error' || modificado == false) {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>No ha sido posible modificar el estado del elemento</strong></h4>`,
                    icon: "error",
                });
            }
        }
    })

}




function mostrar_campos_segun_tipo() {
    var tipoSeleccionado = document.getElementById("select_tipo").value;
    ocultar_campos();
    if (tipoSeleccionado === "texto") {
        mostrar_campo("elemento-texto");
    } else if (tipoSeleccionado === "img") {
        mostrar_campo("elemento-imagen");
    } else if (tipoSeleccionado === "video") {
        mostrar_campo("elemento-video");
    }
}

function ocultar_campos() {
    var campos = document.querySelectorAll(".elemento-texto, .elemento-imagen, .elemento-video");
    campos.forEach(function (campo) {
        campo.style.display = "none";
    });
}

function mostrar_campo(campo) {
    var campoMostrar = document.querySelector("." + campo);
    if (campoMostrar) {
        campoMostrar.style.display = "block";
    }
}