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

<div id="kt_app_content_container" class="app-container">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar por nombre" id="buscar_items_incluido_no_incluido_por_nombre" onkeyup="filtrar_tabla_inlcuido_no_incluido_por_nombre()">
                </div>
            </div>
            <div class="card-toolbar">

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nuevo_servicio_inlcuido">
                            Crear nuevo item (SERVICIO)
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="card-body pt-0">
            <?php
            $info_items_inlcuidos = [];
            $sql_incluidos = mysql_query("SELECT * FROM tabla_incluidos ORDER BY nombre ASC");
            while ($fetch_ = mysql_fetch_assoc($sql_incluidos)) :
                $info_items_inlcuidos[] = $fetch_;
            endwhile;

            ?>

            <div class="table-responsive mt-5">
                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="p-0 pb-3 min-w-100px text-start">Icono</th>
                            <th class="p-0 pb-3 min-w-100px text-start pe-13">Servicio</th>
                            <th class="p-0 pb-3 min-w-100px text-start pe-13">Tipo</th>
                            <th class="p-0 pb-3 min-w-100px text-start pe-13">Mostrar para seleccionar</th>
                            <th class="p-0 pb-3 w-50px text-end">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_nuevos_incluidos">
                        <?php foreach ($info_items_inlcuidos as $item) : ?>
                            <tr class="buscar-item-por-nombre" nombre="<?= $item['nombre'] ?>" id="tr_fila_servicios_incluidos_o_no_incluidos_<?= $item['id'] ?>">
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
                                <td class="text-start pe-13">
                                    <span class="text-gray-600 fw-bold fs-6"><?= $item['tipo'] ?? '' ?></span>
                                </td>
                                <td class="text-end">
                                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                                        <input class="form-check-input" onchange="modificar_estado_mostrar_para_seleccionar('<?= $item['id'] ?? '' ?>')" id="check_mostrar_para_seleccionar_<?= $item['id'] ?? '' ?>" type="checkbox" value="" <?= isset($item['mostrar_para_seleccionar']) && $item['mostrar_para_seleccionar'] == 1 ? 'checked' : '' ?> />
                                    </div>
                                </td>
                                <td class="text-end">
                                    <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_item_incluido_o_no_incluido('<?= $item['id'] ?>')">
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
                                                <option value="complementos">Complementos</option>
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
                                    <button type="button" style="width:100%" class="btn btn-success btn-sm" onclick="fn_guardar_nuevo_servicio_incluido_1()">Guardar</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>