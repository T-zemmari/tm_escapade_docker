$(document).ready(function () {
  console.log("CATEGORIAS Y PRODUCTOS");

  $("#resto_imagenes_categoria").on("click", function () {
    // Verificar el número máximo de imágenes
    const maxImages = 5;
    const currentImageCount = $("#resto_imagenes_categoria_preview").children()
      .length;

    console.log(currentImageCount);
    if (currentImageCount >= maxImages) {
      alert("No se pueden agregar más de 5 imágenes.");
      return;
    }

    // Hacer clic en el input file oculto para imágenes adicionales
    $("#resto_imagenes_categoria_input").click();
  });

  $("#resto_imagenes_categoria_input").change(function () {
    // Mostrar la previsualización de las imágenes adicionales
    const fileInput = $(this);
    const files = fileInput[0].files;

    $.each(files, function (index, file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
        const image = $('<img class="img-thumbnail"/>');
        image.attr("src", e.target.result);
        image.attr("alt", "Additional Image Preview");
        image.css("width", "100px");
        image.css("height", "100px");

        const removeBtn = $(
          '<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>'
        );
        removeBtn.on("click", function () {
          imageContainer.remove();
          fileInput.val("");
        });

        imageContainer.append(image);
        imageContainer.append(removeBtn);
        $("#resto_imagenes_categoria_preview").append(imageContainer);
      };

      reader.readAsDataURL(file);
    });
  });

  $("#resto_imagenes_producto").on("click", function () {
    // Verificar el número máximo de imágenes
    const maxImages = 5;
    const currentImageCount = $("#resto_imagenes_producto_preview").children()
      .length;

    console.log(currentImageCount);
    if (currentImageCount >= maxImages) {
      alert("No se pueden agregar más de 5 imágenes.");
      return;
    }

    $("#resto_imagenes_producto_input").click();
  });

  $("#resto_imagenes_producto_input").change(function () {
    // Mostrar la previsualización de las imágenes adicionales
    const fileInput = $(this);
    const files = fileInput[0].files;

    $.each(files, function (index, file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
        const image = $('<img class="img-thumbnail"/>');
        image.attr("src", e.target.result);
        image.attr("alt", "Additional Image Preview");
        image.css("width", "100px");
        image.css("height", "100px");

        const removeBtn = $(
          '<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>'
        );
        removeBtn.on("click", function () {
          imageContainer.remove();
          fileInput.val("");
        });

        imageContainer.append(image);
        imageContainer.append(removeBtn);
        $("#resto_imagenes_producto_preview").append(imageContainer);
      };

      reader.readAsDataURL(file);
    });
  });
});

/*####################################################################################################################################################*/
/*###################################################### FUNCIONES PARA CATEGORIAS ###################################################################*/
/*####################################################################################################################################################*/

function crear_nueva_categoria() {
  let categoria_nombre = document.getElementById("categoria_nombre").value;
  let categoria_descripcion = document.getElementById(
    "categoria_descripcion"
  ).value;
  let categoria_estado = document.getElementById(
    "select_categoria_estado"
  ).value;
  let categoria_imagen_principal = document.getElementById(
    "categoria_imagen_principal"
  );
  let categoria_resto_imagenes = document.getElementById(
    "resto_imagenes_categoria_input"
  );

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

  formData.append("categoria_nombre", categoria_nombre);
  formData.append("categoria_descripcion", categoria_descripcion);
  formData.append("categoria_estado", categoria_estado);

  // Recolectar la imagen principal

  if (categoria_imagen_principal.files.length > 0) {
    formData.append(
      "categoria_imagen_principal",
      categoria_imagen_principal.files[0]
    );
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

  formData.append("accion", "guardar_nueva_categoria");

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
          $(`#btn_crear_nueva_categoria`).attr("disabled", false);
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
  if (
    categoria_id == undefined ||
    categoria_id == null ||
    isNaN(categoria_id)
  ) {
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
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "/admin/controlador/ajax/funciones_categorias_productos.php",
        {
          categoria_id: categoria_id,
          accion: "eliminar_categoria",
        },
        function (response) {
          console.log(response);
          let respuesta = JSON.parse(response);
          if (respuesta) {
            console.log(respuesta);
            let status = respuesta.status;
            if (status != "success") {
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
        }
      );
    }
  });
}

function modificar_categoria(categoria_id) {
  let categoria_nombre = document.getElementById(
    `categoria_nombre_${categoria_id}`
  ).value;
  let categoria_descripcion = document.getElementById(
    `categoria_descripcion_${categoria_id}`
  ).value;
  let categoria_estado = document.getElementById(
    `select_categoria_estado_${categoria_id}`
  ).value;
  let categoria_descatalogada = document.getElementById(
    `select_categoria_descatalogada_${categoria_id}`
  ).value;

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
  formData.append("categoria_id", categoria_id);
  formData.append("categoria_nombre", categoria_nombre);
  formData.append("categoria_descripcion", categoria_descripcion);
  formData.append("categoria_estado", categoria_estado);
  formData.append("categoria_descatalogada", categoria_descatalogada);
  formData.append("accion", "modificar_categoria");

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
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "/admin/controlador/ajax/funciones_categorias_productos.php",
        {
          media_id: id,
          accion: "eliminar_imagen_categoria",
        },
        function (result) {
          console.log(result);
          let resultado = JSON.parse(result);
          if (resultado) {
            console.log("RESULTADO eliminar media categoria", resultado);
            if (resultado.status != "success") {
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
  $(`#modificar_imagen_principal_categoria_${categoria_id}`).on(
    "change",
    function () {
      let nuevaImagen = this.files[0];

      Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>¿ Modificarás la imagen principal ?</strong></h4>`,
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Modificar",
        denyButtonText: `Cancelar`,
      }).then((result) => {
        if (result.isConfirmed) {
          let formData = new FormData();
          formData.append("imagen_principal", nuevaImagen);
          formData.append("categoria_id", categoria_id);
          formData.append("accion", "modificar_imagen_principal_categoria");

          // Realizar la petición AJAX

          $.ajax({
            url: "/admin/controlador/ajax/funciones_categorias_productos.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (result) {
              console.log(result);
              let resultado = JSON.parse(result);
              if (resultado) {
                console.log(
                  "RESULTADO modificar_imagen_principal_categoria",
                  resultado
                );
                if (resultado.status != "success") {
                  Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                    icon: "error",
                  });
                } else {
                  $(`#imagen_principal_actual_${categoria_id}`).attr(
                    "src",
                    `${resultado["nueva_url"]}`
                  );
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
    }
  );
}

function anyadir_mas_imagenes_a_la_categoria(categoria_id) {
  $(`#resto_imagenes_categoria_input_${categoria_id}`).click();

  // Escuchar cambios en el input de archivo
  $(`#resto_imagenes_categoria_input_${categoria_id}`).on(
    "change",
    function () {
      let nuevasImagenes = this.files;

      // Crear un objeto FormData y añadir datos
      let formData = new FormData();
      formData.append("categoria_id", categoria_id);
      formData.append("accion", "anyadir_mas_imagenes_categoria");

      // Agregar cada nueva imagen al FormData

      for (let i = 0; i < nuevasImagenes.length; i++) {
        formData.append("imagenes[]", nuevasImagenes[i]);
      }

      // Realizar la petición AJAX

      $.ajax({
        url: "/admin/controlador/ajax/funciones_categorias_productos.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
          console.log(result);
          let resultado = JSON.parse(result);
          if (resultado) {
            console.log(
              "RESULTADO anyadir_mas_imagenes_a_la_categoria",
              resultado
            );
            if (resultado.status != "success") {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>${resultado.message}</strong></h4>`,
                icon: "error",
              });
            } else {
              // Iterar sobre las nuevas imágenes agregadas

              $.each(
                resultado["datos_post"]["array_rutas_resto_imagenes"],
                function (index, imageData) {
                  const imageUrl = imageData["nueva_url"];
                  const imageId = imageData["id"];

                  // Crear un contenedor para la imagen y el botón de eliminación

                  const imageContainer = $('<div class="col-md-3 col-sm-3"/>');
                  const image = $('<img class="img-thumbnail"/>');
                  image.attr("src", imageUrl);
                  image.attr("alt", "Additional Image");
                  image.css("width", "100px");
                  image.css("height", "100px");

                  const removeBtn = $(
                    '<button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px">Eliminar</button>'
                  );
                  removeBtn.on("click", function () {
                    eliminar_imagen_secundaria_categoria(imageId);
                  });

                  // Agregar la imagen y el botón al contenedor

                  imageContainer.append(image);
                  imageContainer.append(removeBtn);

                  // Agregar el contenedor al contenedor de imágenes previas

                  $(`#resto_imagenes_categoria_preview_${categoria_id}`).append(
                    imageContainer
                  );
                }
              );

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
    }
  );
}

/*####################################################################################################################################################*/
/*###################################################### FUNCIONES PARA PRODUCTOS ####################################################################*/
/*####################################################################################################################################################*/

function crear_nuevo_producto() {

  // Obtener los valores del formulario
  let producto_nombre = $("#producto_nombre").val();
  let descripcion_corta = $("#descripcion_corta").val();
  let producto_descripcion = $("#producto_descripcion").val();
  let select_categoria = $("#select_categoria").val();
  let select_producto_estado = $("#select_producto_estado").val();
  let producto_imagen_principal = $("#producto_imagen_principal")[0].files[0];
  let resto_imagenes_producto_input = $("#resto_imagenes_producto_input")[0].files;


  let precio_de_coste = $("#precio_de_coste").val();
  let pvr = $("#pvr").val();
  let precio_de_venta = $("#precio_de_venta").val();

  let stock_minimo = $("#stock_minimo").val();
  let ean_producto = $("#ean_producto").val();
  let select_mostrar_en_web = $("#select_mostrar_en_web").val();
  let stock_inicial = $("#stock_inicial").val();

  if (producto_nombre.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el nombre del producto.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (descripcion_corta.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción corta del producto.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (producto_descripcion.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción del producto.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (select_categoria.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona una categoría.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (select_producto_estado === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona el estado del producto.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (!producto_imagen_principal) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Debes subir una imagen principal del producto.</strong></h4>`,
      icon: "error",
    });
    return false;
  }
  if (
    precio_de_coste.trim() === "" ||
    isNaN(precio_de_coste.trim()) ||
    precio_de_coste.trim() <= 0
  ) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>El precio de coste tiene que ser numerico y mayor o igual a 0.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (pvr.trim() === "" || isNaN(pvr.trim()) || pvr.trim() <= 0) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>El pvr tiene que ser numerico y mayor o igual a 0.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (
    precio_de_venta.trim() === "" ||
    isNaN(precio_de_venta.trim()) ||
    precio_de_venta.trim() <= 0
  ) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>El precio de venta tiene que ser numerico y mayor o igual a 0.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (select_mostrar_en_web.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona mostrar en web.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (
    stock_minimo.trim() === "" ||
    isNaN(stock_minimo.trim()) ||
    precio_de_coste.trim() <= 0
  ) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>El stock minimo tiene que ser numerico</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  // Crear un objeto FormData para enviar los datos al servidor

  let formData = new FormData();

  formData.append("producto_nombre", producto_nombre);
  formData.append("descripcion_corta", descripcion_corta);
  formData.append("producto_descripcion", producto_descripcion);
  formData.append("select_categoria", select_categoria);
  formData.append("select_producto_estado", select_producto_estado);
  formData.append("producto_imagen_principal", producto_imagen_principal);
  formData.append("precio_de_coste", precio_de_coste);
  formData.append("pvr", pvr);
  formData.append("precio_de_venta", precio_de_venta);
  formData.append("stock_minimo", stock_minimo);
  formData.append("ean_producto", ean_producto);
  formData.append("select_mostrar_en_web", select_mostrar_en_web);
  formData.append("stock_inicial", stock_inicial);

  // Recolectar imágenes adicionales

  $.each(resto_imagenes_producto_input, function (index, file) {
    formData.append("producto_resto_imagenes[]", file);
  });

  formData.append("accion", "guardar_nuevo_producto");

  // Realizar la petición AJAX

  $.ajax({
    url: "/admin/controlador/ajax/funciones_categorias_productos.php",
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {

      // Manejar la respuesta del servidor

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
          $("#btn_crear_nuevo_producto").attr("disabled", false);
        } else {
          window.location.href = "/admin/?pagina=lista_productos";
        }
      }
    },
    error: function (xhr, status, error) {
      // Manejar errores de la petición
      console.error(xhr.responseText);
      $("#btn_crear_nuevo_producto").attr("disabled", false);
    },
  });
}


function lista_informacion_producto_para_modificar(producto_id) {

    $.post('/admin/controlador/ajax/funciones_categorias_productos.php', {
        'accion': 'obtener_info_producto',
        'producto_id': producto_id
    }, function (result) {
        // console.log(result);
        let respuesta = JSON.parse(result);
        if (respuesta) {
            if (respuesta.status && respuesta.status != 'success') {
                Swal.fire({
                    html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                    icon: "error",
                });
            } else {
                console.log('lista_informacion_producto_para_modificar', respuesta);
                let info = respuesta.info_producto;
                renderizar_formulario_modificar_producto(info);
            }
        }
    })
}



function renderizar_formulario_modificar_producto(info) {

    if (info.id == undefined || info.id == null || info.id == '') {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    let array_categorias = info['categorias'];
    let categoria_del_producto = info['categoria_del_producto'];
    let opciones_select_categorias = ``;
    if (array_categorias.length > 0) {
        array_categorias.forEach(categoria => {
            opciones_select_categorias += `
            <option value="${categoria['id']}" ${categoria_del_producto == categoria['id'] ? 'selected' : ''}>${categoria['nombre']}<option>
            `;
        })
    }

    let array_resto_imagenes = info['resto_imagenes_producto'];
    let resto_de_las_imagenes = ``;
    if (array_resto_imagenes.length > 0) {
        array_resto_imagenes.forEach(imagen => {
            resto_de_las_imagenes += `
        <div class="col-md-3 col-sm-3" id="contenedor_producto_media_${imagen['id']}">
            <img class="col-md-3 col-sm-3" style="width: 100px;height:100px" src="${imagen['url_media']}" />
            <button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px" onclick="eliminar_imagen_secundaria_producto('${imagen['id']}')">Eliminar</button>
        </div>
        `;
        })

    }




    let HTML_FORMULARIO = `
    <form id="form_editar_producto" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7">
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Imagen principal</h2>
                                    </div>
                                </div>
                                <div class="card-body text-center pt-0">
                                    <div class="image-input-wrapper w-150px h-150px" style="width: 100% !important;">
                                        <img id="imagen_principal_actual_${info['id']}" style="height:100%;objet-fit:cover;" src="${info['url_imagen_principal']}" alt="${info['nombre']}">
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm mt-1 mb-1" style="width: 100%;" onclick="modificar_imagen_principal_producto('${info['id']}')">Cambiar</button>
                                    <div class="text-muted fs-7">Sube una imagen principal. Solo se aceptan *.png, *.jpg and *.jpeg</div>
                                    <input type="file" style="width: 0px;height:0px" id="input_modificar_imagen_principal_producto_${info['id']}">
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Categoria</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_categoria" id="select_categoria_${info['id']}" required>
                                        <option value="" selected="selected">Seleccionar</option>
                                        ${opciones_select_categorias}
                                    </select>
                                    <div class="text-muted fs-7">Selecciona una categoria</div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Activo</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_producto_estado" id="select_producto_estado_${info['id']}" required>
                                        <option value="">Seleccionar</option>
                                        <option value="1" ${info['activo'] == 1 ? 'selected' : ''}>Activo</option>
                                        <option value="0" ${info['activo'] == 0 ? 'selected' : ''}>No activo</option>
                                    </select>
                                    <div class="text-muted fs-7">Selecciona el estado del producto</div>
                                </div>
                            </div>
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Descatalogada</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_producto_descatalogada" id="select_producto_descatalogada_${info['id']}" required>
                                        <option value="">Seleccionar</option>
                                        <option value="1" ${info['descatalogado'] == 1 ? 'selected' : ''}>Descatalogada</option>
                                        <option value="0" ${info['descatalogado'] == 0 ? 'selected' : ''}>No Descatalogada</option>
                                    </select>
                                    <div class="text-muted fs-7">¿ La producto esta descatalogada ?</div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="kt_ecommerce_nuevo_producto" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Información del producto </h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                            <label class="required form-label">Nombre del producto</label>
                                                            <input type="text" name="producto_nombre" id="producto_nombre_${info['id']}" class="form-control mb-2" placeholder="Nombre" value="${info['nombre']}">
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                        <div class="col-xl-8 col-md-8 col-sm-12">
                                                            <label class="required form-label">Descripcion corta</label>
                                                            <input type="text" name="descripcion_corta" id="descripcion_corta_${info['id']}" class="form-control mb-2" placeholder="Descripción corta" value="${info['descripcion_corta']}">
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row" style="margin-top: 25px;min-height:300px">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <label class="form-label">Descripcion principal del producto</label>
                                                            <textarea class="form-control" name="producto_descripcion" id="producto_descripcion_${info['id']}" rows="8" placeholder="Escribe una breve descripción">${info['descripcon_larga']}</textarea>
                                                            <div class="text-muted fs-7">Establezca una descripción para el producto para una mejor visibilidad.</div>
                                                        </div>

                                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                                            <div class="card card-flush py-4" style="margin-top: 25px;">
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Resto de informacíon</h2>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <div class="row mb-2">
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Precio de coste</label>
                                                                            <input type="text" name="precio_de_coste" id="precio_de_coste_${info['id']}" class="form-control mb-2" placeholder="Coste" value="${info['precio_coste']}">
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Precio antes (PVR)</label>
                                                                            <input type="text" name="pvr" id="pvr_${info['id']}" class="form-control mb-2" placeholder="PVR" value="${info['precio_pvr']}">
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Precio de venta</label>
                                                                            <input type="text" name="precio_de_venta" id="precio_de_venta_${info['id']}" class="form-control mb-2" placeholder="Precio de venta" value="${info['precio_actual']}">
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Mostrar en web</label>
                                                                            <select class="form-select mb-2" name="select_mostrar_en_web" id="select_mostrar_en_web_${info['id']}" required>
                                                                                <option value="">Seleccionar</option>
                                                                                <option value="1" ${info['mostrar_en_web'] == 1 ? 'selected' : ''}>Mostrar</option>
                                                                                <option value="0" ${info['mostrar_en_web'] == 0 ? 'selected' : ''}>No mostrar</option>
                                                                            </select>
                                                                            <div class="text-muted fs-7">Mostrar en la web</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Ean</label>
                                                                            <input type="numbre" name="ean_producto" id="ean_producto_${info['id']}" class="form-control mb-2" placeholder="Ean" value="${info['ean']}">
                                                                            <div class="text-muted fs-7">Ean del producto</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Stock minimo</label>
                                                                            <input type="numbre" name="stock_minimo" id="stock_minimo_${info['id']}" class="form-control mb-2" placeholder="Stock minimo" value="${info['stock_minimo']}" >
                                                                            <div class="text-muted fs-7">No se vende si el stock < a la cantidad seleccionada</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                        <label class="form-label">Producto destacado</label>
                                                                            <select class="form-select mb-2" name="select_producto_destacado" id="select_producto_destacado_${info['id']}">
                                                                                <option value="">Seleccionar</option>
                                                                                <option value="1" ${info['producto_destacado'] == 1 ? 'selected' : ''}>Si</option>
                                                                                <option value="0" ${info['producto_destacado'] == 0 ? 'selected' : ''}>No</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Stock actual</label>
                                                                            <input type="numbre" name="modificar_stock" id="modificar_stock_${info['id']}" class="form-control mb-2" placeholder="Modificar stock" value="${info['stock_actual']}">
                                                                            <div class="text-muted fs-7">Modificar el stock actual > 0</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-md-12 col-sm-12">
                                                                <div class="card card-flush py-4" style="margin-top: 25px;">
                                                                    <div class="card-header">
                                                                        <div class="card-title">
                                                                            <h2>Resto de imagenes</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body pt-0">
                                                                        <div class="row mb-2">
                                                                            <div class="col-md-12">
                                                                                <button type="button" id="resto_imagenes_producto" class="btn btn-primary btn-sm" onclick="anyadir_mas_imagenes_al_producto('${info['id']}')">Añadir Imágenes</button>
                                                                                <div id="resto_imagenes_producto_preview_${info['id']}" class="row mb-2 mt-5" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                                ${resto_de_las_imagenes}
                                                                                </div>
                                                                                <input type="file" accept="image/*" nams="producto_resto_imagenes[]" id="resto_imagenes_producto_input_${info['id']}" class="form-control mb-2" style="display: none;" multiple />
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-muted fs-7">Establece la galería multimedia del producto.</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn_modificar_producto${info['id']}" class="btn btn-primary btn-sm" onclick="fn_modificar_producto('${info['id']}')">
                                        <span class="indicator-label">Guardar nuevo producto</span>
                                        <span class="indicator-progress">Porfavor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                    </form>
    
    
    `;

    $(`#body_modal_contenedor_formulario_modificar`).html(HTML_FORMULARIO);
    $(`#modal_modificar_producto`).modal('show');
}


function fn_modificar_producto(producto_id) {
    // Obtener los valores del formulario
    let producto_nombre = $(`#producto_nombre_${producto_id}`).val();
    let descripcion_corta = $(`#descripcion_corta_${producto_id}`).val();
    let producto_descripcion = $(`#producto_descripcion_${producto_id}`).val();
    let select_categoria = $(`#select_categoria_${producto_id}`).val();
    let select_producto_estado = $(`#select_producto_estado_${producto_id}`).val();
    let precio_de_coste = $(`#precio_de_coste_${producto_id}`).val();
    let pvr = $(`#pvr_${producto_id}`).val();
    let precio_de_venta = $(`#precio_de_venta_${producto_id}`).val();
    let stock_minimo = $(`#stock_minimo_${producto_id}`).val();
    let ean_producto = $(`#ean_producto_${producto_id}`).val();
    let select_mostrar_en_web = $(`#select_mostrar_en_web_${producto_id}`).val();
    let select_descatalogado = $(`#select_producto_descatalogada_${producto_id}`).val();
    let select_producto_destacado = $(`#select_producto_destacado_${producto_id}`).val();
    let cantidad_stock = $(`#modificar_stock_${producto_id}`).val();
    console.log("modificar_stock: ", cantidad_stock);


    // Validaciones de campos
    
    if (producto_nombre.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el nombre del producto.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (descripcion_corta.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción corta del producto.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (producto_descripcion.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción del producto.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (select_categoria.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona una categoría.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (select_producto_estado === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona el estado del producto.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (precio_de_coste.trim() === "" || isNaN(precio_de_coste.trim()) || precio_de_coste.trim() <= 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El precio de coste tiene que ser numérico y mayor o igual a 0.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (pvr.trim() === "" || isNaN(pvr.trim()) || pvr.trim() <= 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El PVR tiene que ser numérico y mayor o igual a 0.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (precio_de_venta.trim() === "" || isNaN(precio_de_venta.trim()) || precio_de_venta.trim() <= 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El precio de venta tiene que ser numérico y mayor o igual a 0.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (select_mostrar_en_web.trim() === "") {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona mostrar en la web..</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (stock_minimo.trim() === "" || isNaN(stock_minimo.trim()) || stock_minimo.trim() <= 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El stock mínimo tiene que ser numérico.</strong></h4>`,
            icon: "error",
        });
        return false;
    }

    if (cantidad_stock.trim() === "" || isNaN(cantidad_stock.trim()) || cantidad_stock.trim() < 0) {
        Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>El importe stock tiene que ser numérico.</strong></h4>`,
            icon: "error",
        });
        return false;
    }


    // Crear un objeto con los datos del producto

    let productoData = {
        producto_nombre: producto_nombre,
        descripcion_corta: descripcion_corta,
        producto_destacado: select_producto_destacado,
        producto_descripcion: producto_descripcion,
        select_categoria: select_categoria,
        select_producto_estado: select_producto_estado,
        precio_de_coste: precio_de_coste,
        pvr: pvr,
        precio_de_venta: precio_de_venta,
        stock_minimo: stock_minimo,
        ean_producto: ean_producto,
        select_mostrar_en_web: select_mostrar_en_web,
        producto_id: producto_id,
        producto_descatalogado: select_descatalogado,
        cantidad_stock: cantidad_stock,
       
    };

    // console.log("productoData: ", productoData);
    // return;


    try {
        $.post('/admin/controlador/ajax/funciones_categorias_productos.php', {
            'accion': 'modificar_producto',
            'data': productoData
        }, function (result) {
            console.log(result);
            let respuesta = JSON.parse(result);
            if (respuesta) {
                console.log('modificar_producto', respuesta);
                if (respuesta.status != 'success') {

                } else {
                    window.location.reload();
                }
            }
        })
    } catch (error) {
        console.log(error);
    }


}