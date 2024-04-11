$(document).ready(function () {
  console.log("COMPLEMENTOS");
  //limitarDescripcion();
  $("#btn_crear_nuevo_servicio_complemento").on("click", function () {
    $(`#btn_crear_nuevo_servicio_complemento`).attr("disabled", true);

    if (validar_formulario_complemento()) {
      // Recolectar datos del formulario
      const formData = new FormData($("#form_nuevo_complemento_servicio")[0]);
      formData.append("accion", "guardar_nuevo_complemento");

      // Recolectar la imagen principal
      const mainImageInput = $("#complemento_imagen_principal")[0];
      if (mainImageInput.files.length > 0) {
        formData.append("main_image", mainImageInput.files[0]);
      }

      // Recolectar imágenes adicionales
      const additionalImagesInput = $("#additionalImagesInput")[0];
      $.each(additionalImagesInput.files, function (index, file) {
        formData.append("additional_images[]", file);
      });


      let array_servicios_incluidos = [];
      let array_servicios_no_incluidos = [];

      $('.checkboxes-items-inlcuir').each(function () {
        if ($(this).is(':checked')) {
          array_servicios_incluidos.push($(this).attr('id_incluido'));
        } else {
          array_servicios_no_incluidos.push($(this).attr('id_incluido'));
        }
      })

      formData.append('array_servicios_incluidos', JSON.stringify(array_servicios_incluidos));
      formData.append('array_servicios_no_incluidos', JSON.stringify(array_servicios_no_incluidos));

      // Realizar la petición AJAX
      $.ajax({
        url: "/admin/controlador/ajax/funciones_complementos_servicios.php",
        type: "POST",
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
            if (status != "success") {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                icon: "error",
              });
              $(`#btn_crear_nuevo_servicio_complemento`).attr(
                "disabled",
                false
              );
            } else {
              window.location.href = "/admin/?pagina=complementos";
            }
          }
        },
        error: function (xhr, status, error) {
          // Manejar errores de la petición
          console.error(xhr.responseText);
          $(`#btn_crear_nuevo_servicio_complemento`).attr("disabled", false);
        },
        complete: function () {
          // Puedes quitar el indicador de carga aquí
          $(`#btn_crear_nuevo_servicio_complemento`).attr("disabled", false);
        },
      });
    } else {
      $(`#btn_crear_nuevo_servicio_complemento`).attr("disabled", false);
    }
  });


});


function fn_modificar_complemento(complemento_id) {


  $(`#btn_modificar_servicio_complemento_${complemento_id}`).attr("disabled", true);

  let data = {
    'select_complemento_tiene_caducidad': $(`#select_complemento_tiene_caducidad_${complemento_id}`).val(),
    'select_estado_complemento': $(`#select_estado_complemento_${complemento_id}`).val(),
    'titulo_complemento': $(`#titulo_complemento_${complemento_id}`).val(),
    'complemento_fecha_ini': $(`#complemento_fecha_ini_${complemento_id}`).val(),
    'complemento_fecha_fin': $(`#complemento_fecha_fin_${complemento_id}`).val(),
    'descripcion_complemento': $(`#descripcion_complemento_${complemento_id}`).val(),
    'precio_complemento': $(`#precio_complemento_${complemento_id}`).val(),
    'select_porcentaje_complemento': $(`#select_porcentaje_complemento_${complemento_id}`).val(),
    'cantidad_a_ingresar': $(`#cantidad_a_ingresar_${complemento_id}`).val(),
    'complemento_id': complemento_id,
  }

  // Realizar la petición AJAX

  try {
    $.post('/admin/controlador/ajax/funciones_complementos_servicios.php', {
      'accion': 'editar_complemento',
      'data': data
    }, function (result) {
      console.log(result);
      let respuesta = JSON.parse(result);
      if (respuesta) {
        console.log(respuesta);
        let status = respuesta.status;
        if (status != "success") {
          Swal.fire({
            html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
            icon: "error",
          });
          $(`#btn_modificar_servicio_complemento_${complemento_id}`).attr("disabled", false);
        } else {
          window.location.href = "/admin/?pagina=complementos";
        }
      }
    })
  } catch (err) {
    console.log('ERRRRORRRR');
    console.error(err);
    $(`#btn_modificar_servicio_complemento_${complemento_id}`).attr("disabled", true);
  }



}

function fn_mostrar_formulario_modificar_complemento(complemento_id) {

  $.post(
    "/admin/controlador/ajax/funciones_complementos_servicios.php",
    {
      'complemento_id': complemento_id,
      'accion': "obtener_info_complemento",
    },
    function (result) {
      //console.log(result);
      let respuesta = JSON.parse(result);
      if (respuesta) {
        console.log('respuesta obtener_info_complemento', respuesta);
        let info = respuesta.info_complemento;


        let HTML_RESTO_IMAGENES = ``;


        let array_resto_imagenes = info.resto_imagenes_info_completa;
        if (array_resto_imagenes.length > 0) {
          array_resto_imagenes.forEach(item => {
            HTML_RESTO_IMAGENES += `
            <div class="col-md-3 col-sm-3">
                <img class="img-thumbnail" src="${item.url_archivo}" alt="Additional Image Preview" style="width:100%;height:auto"/>
                <button type="button" class="btn btn-danger btn-sm mt-1" style="width:100%" onclick="eliminar_imagen(${item.id})">Eliminar</button>
            </div>     
            `;
          })
        }


        let info_servicios_incluidos = info.array_info_servicios_inluidos;
        let items_por_incluido_id = info_servicios_incluidos.items_del_servicio;


        let HTML_SERVICIOS_YA_RELACIONADOS = ``;


        if (items_por_incluido_id.length > 0) {
          items_por_incluido_id.forEach(item => {
            HTML_SERVICIOS_YA_RELACIONADOS += `
              <tr id="tr_incluidos_y_no_inlcuidos_del_complemento_${item['id']}">
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3">
                            <img src="${item['mas_info']['url_icono']}" class="" alt="${item['mas_info']['nombre']}">
                        </div>
                    </div>
                </td>
                <td class="text-start pe-13">
                    <span class="text-gray-600 fw-bold fs-6">${item['mas_info']['nombre']}</span>
                </td>
                <td class="text-start pe-13">
                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                        <input class="form-check-input" onchange="modificar_estado_es_incluido('${item['id']}')" id="check_es_incluido_${item['id']}" type="checkbox" value="" ${item['es_incluido'] == 1 ? 'checked' : ''} />
                    </div>
                </td>
                <td class="text-end">
                    <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_desvincular_item_incluido_o_no_incluido_del_complemento('${item['mas_info']['id']}','${info['id']}')">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </td>
                </tr>
             `;
          })

        }

        let HTML_ACCORDION_1_INFO_INCLUIDOS_DEL_COMPLEMENTO = `


        <hr>
        <div class="accordion accordion-icon-collapse" id="kt_accordion_incluidos_y_no_incluidos_del_complemento_${info.id}">
            <div class="mb-5">
                <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_incluidos_y_no_incluidos_del_complemento_item_${info.id}">
                    <span class="accordion-icon">
                        <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i>
                    </span>
                    <h3 class="fs-4 fw-semibold mb-0 ms-4">Listado : (<span style="color:red" id="cantidad_items_servicios_incluir">${items_por_incluido_id.length}</span>)</h3>
                </div>

                <div id="kt_accordion_incluidos_y_no_incluidos_del_complemento_item_${info.id}" class="collapse fs-6 ps-10 mt-2 show" data-bs-parent="#kt_accordion_incluidos_y_no_incluidos_del_complemento_${info.id}">
                    <div class="table-responsive">
                        <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                            <thead>
                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                    <th class="p-0 pb-3 min-w-100px text-start">Icono</th>
                                    <th class="p-0 pb-3 min-w-100px text-start pe-13">Servicio</th>
                                    <th class="p-0 pb-3 min-w-100px text-start pe-13">Incluido</th>
                                    <th class="p-0 pb-3 w-50px text-end">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_incluidos_y_no_inlcuidos_del_complemento_${info.id}">                         
                              ${HTML_SERVICIOS_YA_RELACIONADOS}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
                 
        `;


        let servicio_nuevos_a_mostrar = info.servicios_nuevos_a_mostrar;
        let HTML_SERVICIOS_NUEVOS_A_INCLUIR = ``;

        if (servicio_nuevos_a_mostrar.length > 0) {
          servicio_nuevos_a_mostrar.forEach(nuevo_item => {
            HTML_SERVICIOS_NUEVOS_A_INCLUIR += `
            <tr id="tr_fila_nuevos_a_incluir_complemento_${nuevo_item.id}">
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-3">
                            <img src="${nuevo_item['url_icono']}" class="" alt="${nuevo_item['url_icono']}">
                        </div>
                    </div>
                </td>
                <td class="text-start pe-13">
                    <span class="text-gray-600 fw-bold fs-6">${nuevo_item['nombre']}</span>
                </td>
                <td class="text-end">
                    <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;" onclick="fn_incluir_nuevo_item_al_complemento('${nuevo_item['id']}','${info.id}')">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </td>
            </tr>
            `;
          })

        }


        let HTML_ACCORDION_2_INFO_INCLUIDOS_COMPLEMENTO = `
        
        <div class="accordion accordion-icon-collapse" id="kt_accordion_servicios_a_incluir_${info.id}">
        <div class="mb-5">
            <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_servicios_a_incluir_item_${info.id}">
                <span class="accordion-icon">
                    <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i>
                </span>
                <h3 class="fs-4 fw-semibold mb-0 ms-4">Listado : (<span style="color:red" id="cantidad_items_servicios_incluir">${servicio_nuevos_a_mostrar.length}</span>)</h3>
            </div>

            <div id="kt_accordion_servicios_a_incluir_item_${info.id}" class="collapse fs-6 ps-10 mt-2 show" data-bs-parent="#kt_accordion_servicios_a_incluir_${info.id}">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                <th class="p-0 pb-3 min-w-100px text-start">Icono</th>
                                <th class="p-0 pb-3 min-w-100px text-start pe-13">Servicio</th>
                                <th class="p-0 pb-3 w-50px text-end">Incluir</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_nuevos_a_incluir_complemento_${info.id}">                           
                              ${HTML_SERVICIOS_NUEVOS_A_INCLUIR}                         
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        `;

        let HTML_MODIFICAR_COMPLEMENTO = `
        <form id="form_modificar_complemento_servicio" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Imagen principal</h2>
                                </div>
                            </div>
                            <div class="card-body text-center pt-0">
                                <style>
                                    .image-input-placeholder {
                                        background-image: url('${info.imagen_principal}');
                                    }

                                    [data-bs-theme="dark"] .image-input-placeholder {
                                        background-image: url('${info.imagen_principal}');
                                    }
                                </style>
                                <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                    <div class="image-input-wrapper w-150px h-150px"></div>
                                    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-pencil fs-7">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="file" name="avatar" id="modificar_complemento_imagen_principal" accept=".png, .jpg, .jpeg">
                                        <input type="hidden" name="avatar_remove">
                                    </label>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" aria-label="Cancel avatar" data-bs-original-title="Cancel avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" aria-label="Remove avatar" data-bs-original-title="Remove avatar" data-kt-initialized="1">
                                        <i class="ki-duotone ki-cross fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                </div>
                                <div class="text-muted fs-7">Sube una imagen principal. Solo se aceptan *.png, *.jpg and *.jpeg</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Tiene caducidad</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                </div>
                            </div>
                            <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                <select class="form-select mb-2" name="select_complemento_tiene_caducidad_" id="select_complemento_tiene_caducidad_${info.id}" required>
                                    <option value="" selected="selected">Seleccionar</option>
                                    <option value="1" ${info.tiene_fecha_caducidad == 1 ? 'selected' : ''}>Si</option>
                                    <option value="0" ${info.tiene_fecha_caducidad == 0 ? 'selected' : ''}>No</option>
                                </select>
                                <div class="text-muted fs-7">Selecciona si tiene caducidad</div>
                            </div>
                            
                        </div>
                        
                        <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Estado</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                </div>
                            </div>
                            <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                <select class="form-select mb-2" name="select_estado_complemento" id="select_estado_complemento_${info.id}" required>
                                    <option value="">Seleccionar</option>
                                    <option value="1" ${info.active == 1 ? 'selected' : ''}>Activo</option>
                                    <option value="0" ${info.active == 1 ? 'selected' : ''}>No activo</option>
                                </select>
                                <div class="text-muted fs-7">Selecciona el estado del complemento</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="kt__modificar_complemento" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Detalles</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Titlulo del complemento</label>
                                                        <input type="text" name="titulo_complemento" id="titulo_complemento_${info.id}" class="form-control mb-2" placeholder="complemento" value="${info.titulo_complemento}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Inicio</label>
                                                        <input type="date" name="complemento_fecha_ini" id="complemento_fecha_ini_${info.id}" class="form-control mb-2" value="${info.fecha_ini != null && info.fecha_ini != '0000-00-00 00:00:00' && info.fecha_ini.split(' ')[0] ? info.fecha_ini.split(' ')[0] : ''}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Fin</label>
                                                        <input type="date" name="complemento_fecha_fin" id="complemento_fecha_fin_${info.id}" class="form-control mb-2" value="${info.fecha_fin != null && info.fecha_fin != '0000-00-00 00:00:00' && info.fecha_fin.split(' ')[0] ? info.fecha_fin.split(' ')[0] : ''}">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-12 col-sm-12">
                                                        <label class="form-label">Description del complemento</label>
                                                        <textarea class="form-control" name="descripcion_complemento" id="descripcion_complemento_${info.id}" rows="20" placeholder="Escribe una breve descripción">${info.descripcion_complemento}</textarea>
                                                        <div class="text-muted fs-7">Establezca una descripción para el servicio para una mejor visibilidad.</div>
                                                    </div>
                                                    <div class="col-xl-6 col-md-12 col-sm-12">
                                                        <div class="card card-flush py-4" style="margin-top: 25px;min-height:500px">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>Resto de imagenes</h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0">
                                                                <div class="row mb-2">
                                                                    <div class="col-md-12">
                                                                        <button type="button" id="addImageBtn" class="btn btn-primary btn-sm">Añadir Imágenes</button>
                                                                        <div id="additionalImagesPreviewContainer_${info.id}" class="row mb-2" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                            ${HTML_RESTO_IMAGENES}
                                                                        </div>
                                                                        <input type="file" accept="image/*" id="additionalImagesInpu_${info.id}t" class="form-control mb-2" style="display: none;" multiple />
                                                                    </div>
                                                                </div>
                                                                <div class="text-muted fs-7">Establece la galería multimedia del complemento (máximo 5 imágenes).</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                  <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>¿ Que incluye y Que no incluye ?</h2>
                                        </div>
                                    </div>
                                    <div class="card-body pt-0">
                                        ${HTML_ACCORDION_1_INFO_INCLUIDOS_DEL_COMPLEMENTO}
                                    </div>
                                  </div>


                                    <div class="card card-flush py-4">
                                          <div class="card-header">
                                              <div class="card-title">
                                                  <h2>Incluir mas servicio</h2>
                                              </div>
                                              <div class="card-toolbar">
                                                  <div class="card-toolbar">
                                                      <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                                          <a href="?pagina=gestionar_servicios_incluidos" class="btn btn-primary btn-sm">
                                                              Gestionar mas servicios incluidos
                                                          </a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="card-body pt-0">
                                              <hr>
                                              ${HTML_ACCORDION_2_INFO_INCLUIDOS_COMPLEMENTO}
                                              <div class=" text-muted fs-7">
                                                  Escoge los servicios incluidos y los no incluidos.
                                              </div>
                                          </div>
                                    </div>

                                    <div class="card card-flush py-4">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>Precio del complemento</h2>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Precio completo</label>
                                                        <input type="text" name="precio_complemento" id="precio_complemento_${info.id}" class="form-control mb-2" value="${info.precio_complemento}" placeholder="Precio del complemento" value="" onkeyup="calcular_cantidad_complemento_a_ingresar('${info.id}')">
                                                        <div class="text-muted fs-7">Establece el precio del complemento.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Porcentaje</label>
                                                        <select class="form-select mb-2" name="select_porcentaje_complemento" id="select_porcentaje_complemento_${info.id}"  onchange="calcular_cantidad_complemento_a_ingresar('${info.id}')">
                                                            <option value="0">Seleccionar</option>
                                                            <option value="5" ${info.porcentaje_complemento == 5 ? 'selected' : ''}>5%</option>
                                                            <option value="10" ${info.porcentaje_complemento == 10 ? 'selected' : ''}>10%</option>
                                                            <option value="15" ${info.porcentaje_complemento == 15 ? 'selected' : ''}>15%</option>
                                                            <option value="20" ${info.porcentaje_complemento == 20 ? 'selected' : ''}>20%</option>
                                                        </select>
                                                        <div class="text-muted fs-7">Establece el porcentaje que se debe adelentar.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Cantidad a ingresar</label>
                                                        <input type="number" readonly name="cantidad_a_ingresar" id="cantidad_a_ingresar_${info.id}" class="form-control mb-2" placeholder="Cantidad que se debe de adelantar" value="${info.cantidad_a_adelantar}">
                                                        <div class="text-muted fs-7">Establece la cantidad que se debe adelentar</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success btn-sm" type="button" id="btn_modificar_servicio_complemento_${info.id}" onclick="fn_modificar_complemento('${info.id}')">
                                  Modificar el complemento
                            </button>
                        </div>
                    </div>
                </form>
        
        `;


        $(`#body_modal_modificar_servicio_complemento`).html(HTML_MODIFICAR_COMPLEMENTO);
        $(`#modal_modificar_servicio_complemento`).modal('show');

      }
    }
  );
}

function validar_formulario_complemento() {
  // Obtener referencias a los elementos del formulario
  let titulo = document.getElementById("titulo_complemento");
  let descripcion = document.getElementById("descripcion_complemento");
  let estado = document.getElementById("select_estado_complemento");
  let precio = document.getElementById("precio_complemento");
  let porcentaje = document.getElementById("select_porcentaje_complemento");
  let cantidad = document.getElementById("cantidad_a_ingresar");
  let mainImageInput = document.getElementById("complemento_imagen_principal");
  let tiene_caducidad = document.getElementById(
    "select_complemento_tiene_caducidad"
  );
  let fecha_ini = document.getElementById("complemento_fecha_ini");
  let fecha_fin = document.getElementById("complemento_fecha_fin");

  // Validar que los campos obligatorios no estén vacíos

  if (
    tiene_caducidad.value.trim() == "1" &&
    (fecha_ini.value.trim() === "" || fecha_fin.value.trim() === "")
  ) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Comprueba las fechas.</strong></h4>`,
      icon: "error",
    });

    return false;
  }
  if (titulo.value.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa un título del complemento.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (descripcion.value.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa una descripción del complemento.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (estado.value === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona un estado del complemento.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (!precio.value || precio.value.trim() === "") {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, ingresa el precio del complemento.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (porcentaje.value === "" || porcentaje.value === 0) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Por favor, selecciona un porcentaje.</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  if (cantidad.value.trim() === "") {
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

  if (tiene_caducidad.value.trim() == "1") {
    let fechaIniValue = new Date(fecha_ini.value);
    let fechaFinValue = new Date(fecha_fin.value);
    let hoy = new Date();

    // Convertir hoy a una cadena en formato YYYY-MM-DD para comparación
    let hoyFormatoString = hoy.toISOString().split("T")[0];

    if (fechaIniValue.toISOString().split("T")[0] < hoyFormatoString) {
      Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>La fecha de inicio no puede ser anterior a hoy.</strong></h4>`,
        icon: "error",
      });
      return false;
    }

    if (
      fechaFinValue.toISOString().split("T")[0] < hoyFormatoString ||
      fechaFinValue.toISOString().split("T")[0] <
      fechaIniValue.toISOString().split("T")[0]
    ) {
      Swal.fire({
        html: `<h4 style="margin-top:25px"><strong>La fecha de fin no puede ser anterior a hoy ni anterior a la fecha de inicio.</strong></h4>`,
        icon: "error",
      });
      return false;
    }
  }

  // Si todos los campos están llenos, el formulario es válido
  return true;
}

function calcular_cantidad_complemento_a_ingresar(complemento_id = null) {
  let precio = "";
  let porcentaje = "";
  let cantidadInput = "";
  // Obtener referencias a los elementos del formulario

  if (
    complemento_id != undefined &&
    complemento_id != null &&
    !isNaN(complemento_id)
  ) {
    precio = parseFloat(
      document.getElementById(`precio_complemento_${complemento_id}`).value
    );
    porcentaje = parseFloat(
      document.getElementById(`select_porcentaje_complemento_${complemento_id}`)
        .value
    );
    cantidadInput = document.getElementById(
      `cantidad_a_ingresar_${complemento_id}`
    );
  } else {
    precio = parseFloat(document.getElementById("precio_complemento").value);
    porcentaje = parseFloat(
      document.getElementById("select_porcentaje_complemento").value
    );
    cantidadInput = document.getElementById("cantidad_a_ingresar");
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

function limitarDescripcion() {
  let descripciones = document.querySelectorAll(".descripcion-complemento");

  descripciones.forEach(function (descripcion) {
    let contenido = descripcion.innerHTML;
    let limite = 100;

    if (contenido.length > limite) {
      let resumen = contenido.substring(0, limite);
      let resto = contenido.substring(limite);

      descripcion.innerHTML =
        resumen +
        '<span class="resto" style="display:none;">' +
        resto +
        "</span>" +
        '<a href="#" class="ver-mas" onclick="verMas(this);">... Ver más</a>';
    }
  });
}

function verMas(enlace) {
  var resto = enlace.previousSibling;
  var verMenos =
    '<a href="#" class="ver-menos" onclick="verMenos(this);"> Ver menos</a>';
  resto.style.display = "inline";
  enlace.style.display = "none";
  resto.insertAdjacentHTML("afterend", verMenos);
}

function verMenos(enlace) {
  var resto = enlace.previousSibling.previousSibling;
  var verMas =
    '<a href="#" class="ver-mas" onclick="verMas(this);">... Ver más</a>';
  resto.style.display = "none";
  enlace.style.display = "none";
  resto.insertAdjacentHTML("afterend", verMas);
}

function fn_anyadir_complemento_al_servicio(complemento_id, servicio_id) {
  let data = {
    servicio_id: servicio_id,
    complemento_id: complemento_id,
  };
  console.log(data);
  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>Vas a añadir el complemento del servicio ¿ Quieres seguir ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Añadir",
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "/admin/controlador/ajax/funciones_complementos_servicios.php",
        {
          data: data,
          accion: "anyadir_complemento_a_servicio",
        },
        function (result) {
          console.log(result);
          let respuesta = JSON.parse(result);
          if (respuesta) {
            console.log(respuesta);
            let status = respuesta.status;
            if (status != "success") {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                icon: "error",
              });
            } else {
              window.location.href = "/admin/?pagina=tours_y_circuitos";
            }
          }
        }
      );
    }
  });
}

function fn_eliminar_complemento_del_servicio(complemento_id, servicio_id) {
  let data = {
    servicio_id: servicio_id,
    complemento_id: complemento_id,
  };
  console.log(data);

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>Vas a eliminar el complemento del servicio ¿ Quieres seguir ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Eliminar",
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {
      $.post(
        "/admin/controlador/ajax/funciones_complementos_servicios.php",
        {
          data: data,
          accion: "eliminar_complemento_del_servicio",
        },
        function (result) {
          console.log(result);
          let respuesta = JSON.parse(result);
          if (respuesta) {
            console.log(respuesta);
            let status = respuesta.status;
            if (status != "success") {
              Swal.fire({
                html: `<h4 style="margin-top:25px"><strong>Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.</strong></h4>`,
                icon: "error",
              });
            } else {
              window.location.href = "/admin/?pagina=tours_y_circuitos";
            }
          }
        }
      );
    }
  });
}

function mostrar_complemento_en_web(complemento_id) {

  let ver_en_web = 0;
  if ($(`#check_ver_en_web_complemento_servicio_${complemento_id}`).is(':checked')) ver_en_web = 1;

  let data = {
    'id': complemento_id,
    'ver_en_web': ver_en_web,
  }
  console.log('data', data);

  let HTML = ``;
  if (ver_en_web == 0) {
    HTML = `El complemento no se mostrara en la web ¿ Quieres seguir ?`;
  } else {
    HTML = `El complemento se va a mostrar en la web ¿ Quieres seguir ?`;
  }

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>${HTML}</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Seguir",
    denyButtonText: `Cancelar`,
  }).then((result) => {
    if (result.isConfirmed) {

      $.post('/admin/controlador/ajax/funciones_complementos_servicios.php', {
        'data': data,
        'accion': 'mostrar_complemento_servicio_en_web',
      }, function (response) {
        console.log('response mostrar_complemento_en_web', response);
        let respuesta = JSON.parse(response);
        if (respuesta) {
          console.log('Respuesta mostrar_complemento_en_web', respuesta);
          let status = respuesta.status;
          let modificado = respuesta.modificado;
          let ver_en_web = respuesta.ver_en_web;

          if (status == 'success') {
            Swal.fire({
              html: `<h4 style="margin-top:25px"><strong>El complemento  ${ver_en_web == 1 ? ' se puede ver en la web' : ' no se vera en la web'}</strong></h4>`,
              icon: "success",
            });
          }
          if (status == 'error' || modificado == false) {
            Swal.fire({
              html: `<h4 style="margin-top:25px"><strong>No ha sido posible modificar el estado del complemento</strong></h4>`,
              icon: "error",
            });
          }
        }
      })
    }
  })



}


function fn_eliminar_complemento(complemento_id) {
  if (complemento_id == undefined || complemento_id == null || isNaN(complemento_id)) {
    Swal.fire({
      html: `<h4 style="margin-top:25px"><strong>Operación fallida (No se puede eliminar el complemento)</strong></h4>`,
      icon: "error",
    });
    return false;
  }

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>¿ Seguro que quieres eliminar ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Eliminar",
    denyButtonText: `Cancelar`
  }).then((result) => {
    if (result.isConfirmed) {


      $.post('/admin/controlador/ajax/funciones_complementos_servicios.php', {
        'complemento_id': complemento_id,
        'accion': 'eliminar_complemento',
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
            $(`#tr_complemento_${complemento_id}`).hide();
            Swal.fire({
              html: `<h4 style="margin-top:25px"><strong>El complemento ha sido eliminado correctamente</strong></h4>`,
              icon: "success",
            });
          }
        }
      });
    }
  });
}

function guardar_nuevo_servicio_incluido_complemento() {
  let tituloServicio = $('#titulo_servicio_incluido').val();
  let tipo = $('#select_tipo').val();
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
          $(`#contenedor_nuevo_item_incluido_o_no_incluido`).hide();

        }
      }

    },
    error: function (xhr, status, error) {
      console.error(error);
      alert('Se produjo un error al intentar guardar el nuevo servicio incluido.');
    }
  });
}


function fn_incluir_nuevo_item_al_complemento(item_id, complemento_id) {

  Swal.fire({
    html: `<h4 style="margin-top:25px"><strong>El nuevo item se vinculara con el servicio </br> ¿ Quieres seguir ?</strong></h4>`,
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Vincular",
    denyButtonText: `Cancelar`
  }).then((result) => {
    if (result.isConfirmed) {
      $.post('/admin/controlador/ajax/funciones_complementos_servicios.php', {
        'item_id': item_id,
        'complemento_id': complemento_id,
        'accion': 'vincular_item_con_el_complemento',
      }, function (result) {
        console.log(result);
        let resultado = JSON.parse(result);
        if (resultado) {
          console.log('RESULTADO fn_incluir_nuevo_item_al_complemento', resultado);
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

function fn_desvincular_item_incluido_o_no_incluido_del_complemento(item_id, complemento_id) {

  Swal.fire({
    html: "<h4>El item se desvinculara del servicio <br> ¿ Seguro que quieres continuar ?</br> La vista se va a refrescar</h4>",
    showDenyButton: true,
    showCancelButton: false,
    confirmButtonText: "Desvincular",
    denyButtonText: `Cancelar`
  }).then((result) => {
    if (result.isConfirmed) {
      console.log('fn_desvincular_item_incluido_o_no_incluido_del_complemento', item_id, complemento_id);
      $.post('/admin/controlador/ajax/funciones_complementos_servicios.php', {
        'accion': 'desvincular_incluidos_del_complemento',
        'item_id': item_id,
        'complemento_id': complemento_id,
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
