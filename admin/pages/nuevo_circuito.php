<style>
    .servicio_inlcuido_image_upload {
        display: block;
        position: relative;
        cursor: pointer;
    }

    .servicio_inlcuido_image_upload img {
        max-width: 160px;
    }

    .servicio_inlcuido_image_upload input[type="file"] {
        display: none;
    }
</style>

<div id="kt_app_content_container" class="app-container container-xxl">

    <form id="form_nuevo_circuito" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="apps/ecommerce/catalog/products.html">
        <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
            <div class="card card-flush py-4">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Imagen para el landing</h2>
                    </div>
                </div>
                <div class="card-body text-center pt-0">
                    <style>
                        .image-input-placeholder {
                            background-image: url('assets/media/svg/files/blank-image.svg');
                        }

                        [data-bs-theme="dark"] .image-input-placeholder {
                            background-image: url('assets/media/svg/files/blank-image-dark.svg');
                        }
                    </style>
                    <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                            <i class="ki-duotone ki-pencil fs-7">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" id="nuevo_servicio_landing_image_input">
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
                        <h2>Estado</h2>
                    </div>
                    <div class="card-toolbar">
                        <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                    </div>
                </div>
                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                    <select class="form-select mb-2" name="select_estado_circuito" id="select_estado_circuito" required>
                        <option value="" selected="selected">Seleccionar</option>
                        <option value="activo" data-select2-id="select2-data-135-ttuo">Activo</option>
                        <option value="no_activo" data-select2-id="select2-data-136-g08t">No activo</option>
                    </select>
                    <div class="text-muted fs-7">Selecciona el estado del circuito</div>
                </div>
            </div>
            <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Tipo de servicio</h2>
                    </div>
                </div>
                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                    <select class="form-select mb-2" name="select_tipo_servicio" id="select_tipo_servicio" required>
                        <option value="" selected="selected">Seleccionar</option>
                        <option value="tour" data-select2-id="select2-data-135-ttuo">Tour</option>
                        <option value="circuito" data-select2-id="select2-data-135-ttuo">Circuito</option>
                        <option value="oferta" data-select2-id="select2-data-136-g08t">Oferta</option>
                    </select>
                    <div class="text-muted fs-7">Seleccionar Circuito | oferta | circuito-oferta</div>
                </div>
            </div>
            <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                <div class="card-header">
                    <div class="card-title">
                        <h2>Particular | Empresa</h2>
                    </div>
                </div>
                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                    <select class="form-select mb-2" name="select_particular_o_empresa_servicio" id="select_particular_o_empresa_servicio" required>
                        <option value="" selected="selected">Seleccionar</option>
                        <option value="Empresa" data-select2-id="select2-data-135-ttuo">Particular</option>
                        <option value="Particular" data-select2-id="select2-data-136-g08t">Empresa</option>
                        <option value="Ambos" data-select2-id="select2-data-136-g08t">Ambos</option>
                    </select>
                    <div class="text-muted fs-7">Seleccionar particular | empresa | ambos</div>
                </div>
            </div>

        </div>
        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
            <!--<ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-n2" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_add_product_general" aria-selected="true" role="tab">General</a>
                </li>
            </ul>-->
            <div class="tab-content">
                <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general" role="tab-panel">
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Nuevo circuito</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <label class="required form-label">Titlulo corto</label>
                                    <input type="text" name="titulo_circuito" id="titulo_circuito" class="form-control mb-2" placeholder="titulo corto" value="" required>
                                    <div class="text-muted fs-7">El titulo corto en el nombre del servicio (máx 100 caracteres)</div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <label class="required form-label">Titlulo largo</label>
                                    <input type="text" name="titulo_circuito_largo" id="titulo_circuito_largo" class="form-control mb-2" placeholder="titulo largo" value="" required>
                                    <div class="text-muted fs-7">El titulo largo servira como mini descripción (máx 255 caracteres)</div>
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <div>
                                    <label class="form-label">Description del cricuito</label>
                                    <textarea class="form-control" name="descripcion_circuito_oferta" id="descripcion_circuito_oferta" rows="10" placeholder="Escribe una breve descripción" required></textarea>
                                    <div class="text-muted fs-7">Establezca una descripción para el servicio para una mejor visibilidad.</div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <label class="form-label">Descripción secundaria 1 (OPCIONAL)</label>
                                    <textarea class="form-control" name="descripcion_secundaria_uno" id="descripcion_secundaria_uno" rows="8" placeholder="Escribe una breve descripción (opcional)"></textarea>
                                </div>
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <label class="form-label">Descripción secundaria 2 (OPCIONAL)</label>
                                    <textarea class="form-control" name="descripcion_secundaria_dos" id="descripcion_secundaria_dos" rows="8" placeholder="Escribe una breve descripción (opcional)"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Medios</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <h3>Imagen Principal</h3>
                                        <button type="button" id="selectMainImageBtn" class="btn btn-success btn-sm" required>Seleccionar Imagen Principal</button>
                                        <div id="mainImagePreview" class="mb-2">
                                            <!-- Imagen principal se mostrará aquí -->
                                        </div>
                                        <input type="file" accept="image/*" id="mainImageInput" class="form-control mb-2" style="display: none;" />
                                    </div>
                                    <div class="col-md-6">
                                        <h3>Imágenes Adicionales</h3>
                                        <button type="button" id="addImageBtn" class="btn btn-primary btn-sm">Añadir Imágenes</button>
                                        <div id="additionalImagesPreviewContainer" class="row mb-2" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                            <!-- Imágenes adicionales se mostrarán aquí -->
                                        </div>
                                        <input type="file" accept="image/*" id="additionalImagesInput" class="form-control mb-2" style="display: none;" multiple />
                                    </div>
                                </div>
                                <div class="text-muted fs-7">Establece la galería multimedia del circuito Imagen principal + (máximo 5 imágenes).</div>
                            </div>
                        </div>
                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Servicios incluidos</h2>
                                </div>
                                <div class="card-toolbar">
                                    <div class="card-toolbar">
                                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nuevo_servicio_inlcuido">
                                                Añadir incluido
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <?php
                                $info_items_inlcuidos = [];
                                $sql_incluidos = mysql_query("SELECT * FROM tabla_incluidos WHERE tipo='servicios' ORDER BY nombre ASC");
                                while ($fetch_ = mysql_fetch_assoc($sql_incluidos)) :
                                    $info_items_inlcuidos[] = $fetch_;
                                endwhile;

                                ?>
                                <hr>
                                <div class="accordion accordion-icon-collapse" id="kt_accordion_servicios_incluidos">
                                    <div class="mb-5">
                                        <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_servicios_incluidos_item_2">
                                            <span class="accordion-icon">
                                                <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i>
                                            </span>
                                            <h3 class="fs-4 fw-semibold mb-0 ms-4">Listado : (<span style="color:red" id="cantidad_items_servicios_incluir"><?= count($info_items_inlcuidos) ?></span>)</h3>
                                        </div>

                                        <div id="kt_accordion_servicios_incluidos_item_2" class="collapse fs-6 ps-10 mt-2 show" data-bs-parent="#kt_accordion_servicios_incluidos">
                                            <div class="table-responsive">
                                                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                    <thead>
                                                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                            <th class="p-0 pb-3 min-w-100px text-start">Icono</th>
                                                            <th class="p-0 pb-3 min-w-100px text-start pe-13">Servicio</th>
                                                            <th class="p-0 pb-3 w-50px text-start">incluido</th>
                                                            <th class="p-0 pb-3 w-50px text-end">Vincular</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbody_nuevos_incluidos">
                                                        <?php foreach ($info_items_inlcuidos as $item) : ?>
                                                            <tr id="tr_fila_servicios_incluidos_o_no_incluidos_<?= $item['id'] ?>">
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="symbol symbol-50px me-3">
                                                                            <img src="<?= $item['url_icono'] ?? '' ?>" class="" alt="">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="text-start pe-13">
                                                                    <span class="text-gray-600 fw-bold fs-6"><?= $item['nombre'] ?? '' ?></span>
                                                                </td>
                                                                <td class="text-start">
                                                                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2">
                                                                        <input type="checkbox" value="" id_incluido="<?= $item['id'] ?? '' ?>" class="form-check-input" id="input_incluir_item_<?= $item['id'] ?? '' ?>" />
                                                                    </div>
                                                                </td>
                                                                <td class="text-end">
                                                                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2">
                                                                        <input type="checkbox" value="" id_incluido="<?= $item['id'] ?? '' ?>" class="form-check-input checkboxes-items-vincular" id="input_vincular_item_<?= $item['id'] ?? '' ?>" />
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" tabindex="-1" id="modal_nuevo_servicio_inlcuido">
                                    <div class="modal-dialog modal-lg  modal-dialog-centered">
                                        <div class="modal-content shadow-none">
                                            <div class="modal-header">
                                                <h2>Crear servicio incluido</h2>
                                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                            </div>
                                            <div class="modal-body" style="padding: 15px !important;">

                                                <form id="form_nuevo_servicio_incluido" enctype="multipart/form-data">
                                                    <div class="card-body" style="padding: 5px !important;">
                                                        <div class="d-flex flex-wrap flex-sm-nowrap">
                                                            <div class="me-7 mb-4">
                                                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                                    <label for="icono_servicio_incluido" class="servicio_inlcuido_image_upload">
                                                                        <img src="assets/custom_icons/icono_1.png" alt="image" id="icono_preview" style="width: 100px;height:100px;border-radius:50%">
                                                                        <input type="file" name="icono_servicio_incluido" id="icono_servicio_incluido" class="form-control" accept="image/*" onchange="preview_servicio_inlcuido_icono(this)">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="row mt-2">
                                                                    <div class="col-md-7 col-sm-7">
                                                                        <label for="titulo_servicio_incluido"><strong>Titulo</strong></label>
                                                                        <input type="text" id="titulo_servicio_incluido" class="form-control" placeholder="Titulo servicio incluido">
                                                                        <small style="color: red;">Recuerda subir una imagen como icono como referencia</small>
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-3">
                                                                        <label for="select_tipo"><strong>Tipo</strong></label>
                                                                        <select name="select_tipo" id="select_tipo" class="form-control">
                                                                            <option value="servicios" selected>Servicios</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-2 col-sm-2" style="text-align: start;">
                                                                        <label for="titulo_servicio_incluido"><strong>Mostrar</strong></label>
                                                                        <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                                                                            <input class="form-check-input" id="check_mostrar_para_seleccionar" type="checkbox" value="" checked />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="display: flex;justify-content:center;align-items:center">
                                                            <div class="col-12">
                                                                <button type="button" style="width:100%" class="btn btn-success btn-sm" onclick="guardar_nuevo_servicio_incluido()">Guardar</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class=" text-muted fs-7">Escoge los servicios incluidos y los no incluidos.
                                </div>
                            </div>
                        </div>

                        <div class="card card-flush py-4">
                            <div class="card-header">
                                <div class="card-title">
                                    <h2>Precio del cicuito</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="required form-label">Precio completo</label>
                                            <input type="text" name="precio_circuito_oferta" id="precio_circuito_oferta" class="form-control mb-2" placeholder="Precio del circuito" value="" required onkeyup="calcular_cantidad_a_ingresar()">
                                            <div class="text-muted fs-7">Establece el precio del producto.</div>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="required form-label">Porcentaje</label>
                                            <select class="form-select mb-2" name="select_porcentaje_circuito_oferta" id="select_porcentaje_circuito_oferta" required onchange="calcular_cantidad_a_ingresar()">
                                                <option value="0" selected="selected">Seleccionar</option>
                                                <option value="5" data-select2-id="select2-data-135-ttuo">5%</option>
                                                <option value="10" data-select2-id="select2-data-136-g08t">10%</option>
                                                <option value="15" data-select2-id="select2-data-136-g08t">15%</option>
                                                <option value="20" data-select2-id="select2-data-136-g08t">20%</option>
                                            </select>
                                            <div class="text-muted fs-7">Establece el porcentaje que se debe adelentar.</div>
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="required form-label">Cantidad a ingresar</label>
                                            <input type="number" readonly name="cantidad_a_ingresar" id="cantidad_a_ingresar" class="form-control mb-2" placeholder="Cantidad que se debe de adelantar" value="" required>
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
                <a href="?pagina=tours_y_circuitos" class="btn btn-danger me-5" id="btn_cancelar_nuevo_servicio">Cancel</a>
                <button type="button" id="btn_crear_nuevo_servicio_circuito_oferta" class="btn btn-primary btn-sm">
                    <span class="indicator-label">Guardar el circuito</span>
                    <span class="indicator-progress">Porfavor espere...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
        </div>
    </form>


</div>