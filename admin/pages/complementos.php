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

    .contenedor_nuevo_item_incluido_o_no_incluido {
        padding: 10px;
    }
</style>

<div id="kt_app_content_container" class="app-container">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar">
                </div>
            </div>
            <div class="card-toolbar">

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nuevo_servicio_complemento">
                            Crear nuevo complemento
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_customers_table_wrapper_proveedor" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <?php $array_complementos = bt_obtener_complementos();
                //echo '<pre>';
                // print_r($array_complementos);
                // echo '</pre>';
                ?>

                <?php if (isset($array_complementos) && count($array_complementos) > 0) : ?>

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_complemento_tabla">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th>Imagen principal</th>
                                    <th style="width: 200px;text-align: start;">Resto imagenes</th>
                                    <th style="width: 200px;text-align: center;">Complemento</th>                                  
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th style="text-align: center;">Activo</th>
                                    <th style="text-align: center;">Descripción</th>
                                    <th style="text-align: end;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($array_complementos as $complemento) : ?>
                                    <tr class="odd" id="tr_complemento_<?= $complemento['id'] ?? '' ?>">
                                        <td style="text-align:start; vertical-align:middle;">
                                            <a style="display:flex;width:80px;height:80px;border-radius:50%" class="image-popup-link" href="<?= $complemento['imagen_principal'] ?>">
                                                <img style="width:100%;border-radius:50%" class="imagen-escritorio-custom-style" src="<?= $complemento['imagen_principal'] ?>" alt="img_e<?= $contador++ ?>">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="contenedor-imagenes" style="display: flex;justify-content:flex-start;align-items:center;flex-wrap:wrap;gap:10px">
                                                <?php
                                                $contador_2 = 1;
                                                foreach ($complemento['resto_imagenes_info_completa'] as $imagen) : ?>
                                                    <a style="display:flex;width:40px;height:40px;border-radius:50%" class="image-popup-link" href="<?= $imagen['url_archivo'] ?>">
                                                        <img style="width:100%;border-radius:50%" class="imagen-escritorio-custom-style" src="<?= $imagen['url_archivo'] ?>" alt="img_e<?= $contador_2++ ?>">
                                                    </a>
                                                <?php endforeach ?>
                                            </div>
                                        </td>
                                        <td style="text-align: center;"><?= $complemento['titulo_complemento'] ?? '' ?></td>
                                        <td><?= isset($complemento['fecha_ini']) && $complemento['fecha_ini'] != '' && $complemento['fecha_ini'] != '0000-00-00 00:00:00' ? explode(' ', $complemento['fecha_ini'])[0] : '' ?></td>
                                        <td><?= isset($complemento['fecha_fin']) && $complemento['fecha_fin'] != '' && $complemento['fecha_fin'] != '0000-00-00 00:00:00' ? explode(' ', $complemento['fecha_fin'])[0] : ''  ?></td>
                                        <td style="text-align: center;"><?= isset($complemento['active']) && $complemento['active'] ?  'Si' : 'No' ?></td>
                                        <td style="text-align:start">
                                            <textarea class="form-control" readonly id="text_area_descripcion_<?= $complemento['id'] ?? '' ?>" rows="8"><?= $complemento['descripcion_complemento'] ?? '' ?></textarea>
                                        </td>
                                        <td class="text-end">
                                            <a class="obtener-complemento-id" complemento_id="<?= $complemento['id'] ?? '' ?>" onclick="fn_mostrar_formulario_modificar_complemento('<?= $complemento['id'] ?? '' ?>')">
                                                <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_complemento('<?= $complemento['id'] ?>')">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>

                    </div>
                <?php else : ?>
                    <div class="row mt-5">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="alert alert-warning">Lista de complementos vacia</div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modal_nuevo_servicio_complemento">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h2>Crear nuevo complemento</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body" style="padding: 15px !important;">
                <form id="form_nuevo_complemento_servicio" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework">
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
                                        <input type="file" name="avatar" id="complemento_imagen_principal" accept=".png, .jpg, .jpeg">
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
                                <select class="form-select mb-2" name="select_complemento_tiene_caducidad" id="select_complemento_tiene_caducidad" required>
                                    <option value="" selected="selected">Seleccionar</option>
                                    <option value="1" data-select2-id="select2-data-135-ttuo">Si</option>
                                    <option value="0" data-select2-id="select2-data-136-g08t">No</option>
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
                                <select class="form-select mb-2" name="select_estado_complemento" id="select_estado_complemento" required>
                                    <option value="" selected="selected">Seleccionar</option>
                                    <option value="1" data-select2-id="select2-data-135-ttuo">Activo</option>
                                    <option value="0" data-select2-id="select2-data-136-g08t">No activo</option>
                                </select>
                                <div class="text-muted fs-7">Selecciona el estado del complemento</div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="kt_ecommerce_nuevo_complemento" role="tab-panel">
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
                                                        <label class="required form-label">Titlulo del servicio</label>
                                                        <input type="text" name="titulo_complemento" id="titulo_complemento" class="form-control mb-2" placeholder="complemento" value="" required>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Inicio</label>
                                                        <input type="date" name="complemento_fecha_ini" id="complemento_fecha_ini" class="form-control mb-2">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Fin</label>
                                                        <input type="date" name="complemento_fecha_fin" id="complemento_fecha_fin" class="form-control mb-2">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-12 col-sm-12">
                                                        <label class="form-label">Description del cricuito</label>
                                                        <textarea class="form-control" name="descripcion_complemento" id="descripcion_complemento" rows="8" placeholder="Escribe una breve descripción" required></textarea>
                                                        <div class="text-muted fs-7">Establezca una descripción para el servicio para una mejor visibilidad.</div>
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
                                                                        <button type="button" id="addImageBtn" class="btn btn-primary btn-sm">Añadir Imágenes</button>
                                                                        <div id="additionalImagesPreviewContainer" class="row mb-2" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                            <!-- Imágenes adicionales se mostrarán aquí -->
                                                                        </div>
                                                                        <input type="file" accept="image/*" id="additionalImagesInput" class="form-control mb-2" style="display: none;" multiple />
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
                                                <h2>Servicios incluidos</h2>
                                            </div>
                                            <div class="card-toolbar">
                                                <div class="card-toolbar">
                                                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                                        <button type="button" class="btn btn-primary btn-sm" onclick="$(`#contenedor_nuevo_item_incluido_o_no_incluido`).toggle(200)">
                                                            Añadir incluido
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body pt-0">

                                            <?php
                                            $info_items_inlcuidos = [];
                                            $sql_incluidos = mysql_query("SELECT * FROM tabla_incluidos WHERE tipo='complementos' ORDER BY nombre ASC");
                                            while ($fetch_ = mysql_fetch_assoc($sql_incluidos)) :
                                                $info_items_inlcuidos[] = $fetch_;
                                            endwhile;

                                            ?>
                                            <hr>
                                            <div class="row contenedor_nuevo_item_incluido_o_no_incluido" id="contenedor_nuevo_item_incluido_o_no_incluido" style="display:none;">
                                                <div class="col-xl-8 col-md-12 col-sm-12">
                                                    <div class="">
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
                                                                                    <option value="complementos" selected>Complementos</option>
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
                                                                        <button type="button" style="width:100%" class="btn btn-success btn-sm" onclick="guardar_nuevo_servicio_incluido_complemento()">Guardar</button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <hr style="margin-top: 10px;">

                                            </div>
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
                                                                        <th class="p-0 pb-3 w-50px text-end">Incluir</th>
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
                                                                            <td class="text-end">
                                                                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2">
                                                                                    <input type="checkbox" value="" id_incluido="<?= $item['id'] ?? '' ?>" class="form-check-input checkboxes-items-inlcuir" id="input_incluir_item_<?= $item['id'] ?? '' ?>" />
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

                                            <div class=" text-muted fs-7">Escoge los servicios incluidos y los no incluidos.
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
                                                        <input type="text" name="precio_complemento" id="precio_complemento" class="form-control mb-2" placeholder="Precio del complemento" value="" required onkeyup="calcular_cantidad_complemento_a_ingresar()">
                                                        <div class="text-muted fs-7">Establece el precio del complemento.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Porcentaje</label>
                                                        <select class="form-select mb-2" name="select_porcentaje_complemento" id="select_porcentaje_complemento" required onchange="calcular_cantidad_complemento_a_ingresar()">
                                                            <option value="0" selected="selected">Seleccionar</option>
                                                            <option value="5" data-select2-id="select2-data-135-ttuo">5%</option>
                                                            <option value="10" data-select2-id="select2-data-136-g08t">10%</option>
                                                            <option value="15" data-select2-id="select2-data-136-g08t">15%</option>
                                                            <option value="20" data-select2-id="select2-data-136-g08t">20%</option>
                                                        </select>
                                                        <div class="text-muted fs-7">Establece el porcentaje que se debe adelentar.</div>
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
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
                            <button type="button" id="btn_crear_nuevo_servicio_complemento" class="btn btn-primary btn-sm">
                                <span class="indicator-label">Guardar el complemento</span>
                                <span class="indicator-progress">Porfavor espere...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" id="modal_modificar_servicio_complemento">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content shadow-none">
            <div class="modal-header">
                <h2>Modificar complemento</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <div class="modal-body" style="padding: 15px !important;" id="body_modal_modificar_servicio_complemento">

            </div>
        </div>
    </div>
</div>