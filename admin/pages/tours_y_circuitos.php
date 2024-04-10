<style>
    .custom-space-between {
        width: 100%;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
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
                    <input type="text" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar servicios" id="input_text_buscar_servicios_tours" onkeyup="filtrar_servicios_por_titulo()">
                </div>
            </div>
            <div class="card-toolbar">

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                        <a href="/admin/?pagina=nuevo_circuito" class="btn btn-primary btn-sm">Nuevo circuito</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>

        <div class="card-body pt-0">
            <div class="container">
                <?php if (isset($info_servicios_circuitos) && count($info_servicios_circuitos) > 0) : ?>
                    <div class="container-fluid">
                        <div class="row row-cols-1 row-cols-md-3 g-4 mt-3">
                            <?php foreach ($info_servicios_circuitos as $servicio) :

                            ?>
                                <div class="modal bg-body fade" tabindex="-1" id="modal_modificar_ver_complementos_<?= $servicio['servicio_id'] ?? '' ?>">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content shadow-none">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Complementos servicio :( <?= $servicio['servicio_titulo'] ?? '' ?> )</h5>
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                            </div>

                                            <div class="modal-body">
                                                <div class="contenedor_complementos_del_servicio">
                                                    <div class="container">
                                                        <?php
                                                        $array_servicios_complementos = [];
                                                        $sql_ser_com = "SELECT * FROM servicio_complemento WHERE servicio_id='" . mysql_esc($servicio['servicio_id']) . "' AND estado=1";
                                                        $result_1 = mysql_query($sql_ser_com);
                                                        while ($fetch = mysql_fetch_assoc($result_1)) :
                                                            $temp = bt_obtener_complemento_by_id($fetch['complemento_id']);
                                                            $temp['id_complemento_servicio'] = $fetch['id'];
                                                            $temp['mostrar_en_web'] = $fetch['mostrar_en_web'];
                                                            $array_servicios_complementos[] = $temp;
                                                        endwhile;

                                                        ?>
                                                        <?php if (isset($array_servicios_complementos) && count($array_servicios_complementos) > 0) : ?>
                                                            <div class="row">
                                                                <?php foreach ($array_servicios_complementos as $complemento) : ?>
                                                                    <div class="col-md-3 col-sm-12" id="card_ser_complemento_<?= $complemento['id_complemento_servicio'] ?? '' ?>" style="margin-top:15px;">
                                                                        <div class="card shadow-sm">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><?= $complemento['complemento_titulo'] ?? '' ?></h3>
                                                                                <div class="card-toolbar custom-space-between">
                                                                                    <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                                                                        <input class="form-check-input" onchange="mostrar_complemento_en_web('<?= $complemento['id_complemento_servicio'] ?? '' ?>')" id="check_ver_en_web_complemento_servicio_<?= $complemento['id_complemento_servicio'] ?? '' ?>" type="checkbox" value="" <?= isset($complemento['mostrar_en_web']) && $complemento['mostrar_en_web']  ? 'checked' : '' ?> />
                                                                                    </div>
                                                                                    <a type="button" class="btn btn-danger btn-sm" data-kt-customer-table-filter="delete_row" onclick="fn_eliminar_complemento_del_servicio('<?= $complemento['id'] ?? '' ?>','<?= $servicio['servicio_id'] ?? '' ?>')">Eliminar</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body p-0">
                                                                                <div class="card-p mb-10">
                                                                                    <div class="text-center px-4">
                                                                                        <img class="mw-100 mh-300px card-rounded-bottom" alt="img_principal" src="<?= $complemento['imagen_principal'] ?? '' ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <a class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger" onclick="$(`#info_descripcion_servicio_complemento_<?= $complemento['id_complemento_servicio'] ?? '' ?>`).toggle(200);">
                                                                                            Ver descripcón
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" id="info_descripcion_servicio_complemento_<?= $complemento['id_complemento_servicio'] ?? '' ?>" style="display: none;">
                                                                                    <br>
                                                                                    <div class="col-md-12" style="padding:10px">
                                                                                        <?= $complemento['complemento_descripcion'] ?? '' ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>
                                                        <?php else : ?>
                                                            <div class="alert alert-warning"><span style="color:blue">No hay complementos para este servicio</span></div>
                                                        <?php endif ?>

                                                    </div>
                                                </div>

                                                <div class="contenedor_complementos_disponibles">
                                                    <div class="container">
                                                        <hr>
                                                        <h4>Complementos disponibles :</h4>
                                                        <hr>
                                                        <?php
                                                        $array_complementos_disponibles = [];
                                                        $sql_com = "SELECT c.* FROM complementos c WHERE c.active=1 AND c.id NOT IN(SELECT complemento_id FROM servicio_complemento WHERE servicio_id='" . mysql_esc($servicio['servicio_id']) . "') ";
                                                        $respuesta = mysql_query($sql_com);
                                                        while ($fetch = mysql_fetch_assoc($respuesta)) :
                                                            $temp = [];
                                                            $fetch['imagen_principal'] = '';
                                                            $fetch['resto_imagenes_info_completa'] = [];
                                                            $imagenes = bn_obtener_imagenes_complemento($fetch['id']);
                                                            if (count($imagenes) > 0) {
                                                                foreach ($imagenes as $imagen) {
                                                                    if ($imagen['es_principal']) {
                                                                        $fetch['imagen_principal'] = $imagen['url_archivo'];
                                                                    } else {
                                                                        $fetch['resto_imagenes'][] = $imagen['url_archivo'];
                                                                        $fetch['resto_imagenes_info_completa'][] = $imagen;
                                                                    }
                                                                }
                                                            }
                                                            $temp = $fetch;

                                                            $array_complementos_disponibles[] = $temp;
                                                        endwhile;
                                                        ?>

                                                        <?php if (count($array_complementos_disponibles) == 0) : ?>
                                                            <div class="alert alert-danger">No hay complementos activos en estos momentos</div>
                                                        <?php else : ?>
                                                            <div class="row">
                                                                <?php foreach ($array_complementos_disponibles as $complemento) : ?>
                                                                    <div class="col-md-3 col-sm-12" id="card_complemento_<?= $complemento['complemento_id'] ?? '' ?>" style="margin-top:15px;">
                                                                        <div class="card shadow-sm" style="height:450px">
                                                                            <div class="card-header">
                                                                                <h3 class="card-title"><?= $complemento['complemento_titulo'] ?? '' ?></h3>
                                                                                <div class="card-toolbar">
                                                                                    <a type="button" class="btn btn-success btn-sm" data-kt-customer-table-filter="delete_row" onclick="fn_anyadir_complemento_al_servicio('<?= $complemento['id'] ?? '' ?>','<?= $servicio['servicio_id'] ?? '' ?>')">Añadir</a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-body p-0">
                                                                                <div class="card-p mb-10">
                                                                                    <div class="text-center px-4">
                                                                                        <img class="mw-100 mh-300px card-rounded-bottom" alt="img_principal" src="<?= $complemento['imagen_principal'] ?? '' ?>" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <a class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger" onclick="$(`#info_descripcion_complemento_<?= $complemento['id'] ?? '' ?>`).toggle(200);">
                                                                                            Ver descripcón
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row" id="info_descripcion_complemento_<?= $complemento['id'] ?? '' ?>" style="display: none;">
                                                                                    <br>
                                                                                    <div class="col-md-12" style="padding:10px">
                                                                                        <?= $complemento['complemento_descripcion'] ?? '' ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach ?>
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 filtrar-servicios" id="card_servicio_circ_<?= $servicio['servicio_id'] ?? '' ?>" style="margin-top:15px" titulo='<?= $servicio['servicio_titulo'] ?? '' ?>'>
                                    <div class="card shadow-sm h-100">
                                        <div class="card-header" style="display:flex;justify-content:center;align-items:center">
                                            <?php if (isset($servicio['mostrar_en_web']) && $servicio['mostrar_en_web'] == 1) : ?>
                                                <h3><strong style="color:green">PUBLICADO</strong></h3>
                                            <?php else : ?>
                                                <h3><strong style="color:red">NO PUBLICADO</strong></h3>
                                            <?php endif ?>
                                        </div>
                                        <div class="card-header">
                                            <div class="row">
                                                <h4 class="card-title" style="padding: 5px;">
                                                    <?php
                                                    $titulo_servicio = $servicio['servicio_titulo'] ?? '';
                                                    $servicio_id = $servicio['servicio_id'] ?? '';
                                                    if (strlen($titulo_servicio) > 50) {
                                                        echo '<span id="span_titulo_servicio_completo_' . $servicio_id . '">' . substr($titulo_servicio, 0, 50) . '</span>...&nbsp <small style="color:red;cursor:pointer" id="ver_mas_btn_' . $servicio_id . '"  onclick="toggle_titulo_servicio(\'' . $servicio_id . '\', \'' . htmlentities($titulo_servicio) . '\')"> más</small>';
                                                    } else {
                                                        echo '<span id="span_titulo_servicio_completo_' . $servicio_id . '">' . htmlentities($titulo_servicio) . '</span>';
                                                    }
                                                    ?>
                                                </h4>
                                            </div>
                                        </div>
                                        <div class="card-body p-0" style="display:flex;justify-content: center;align-items:center">
                                            <div class="card-p mb-10 ">
                                                <div class="text-center px-4">
                                                    <img class="mw-100 mh-300px card-rounded-bottom" alt="img_principal" src="<?= $servicio['imagen_principal'] ?? '' ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6 col-sm-6">
                                                    <a class="btn btn-outline btn-outline-dashed btn-outline-danger btn-active-light-danger" onclick="$(`#info_descripcion_<?= $servicio['servicio_id'] ?? '' ?>`).toggle(200);">
                                                        Ver descripción
                                                    </a>
                                                </div>
                                                <div class="col-xl-6 col-md-6 col-sm-6" style="text-align: end;margin-top:5px">
                                                    <div class="card-toolbar">
                                                        <a href="#" class="btn btn-sm btn-light image.png btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                            Acciones
                                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                        </a>
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                                            <div class="menu-item px-3">
                                                                <a href="?pagina=modificar_circuito.php" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#modal_modificar_servicio_circuito_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                    Modificar
                                                                </a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a type="button" class="menu-link px-3" data-kt-customer-table-filter="delete_row" onclick="fn_eliminar_servicio('<?= $servicio['servicio_id'] ?? '' ?>')">Eliminar</a>
                                                            </div>
                                                            <div class="menu-item px-3">
                                                                <a type="button" class="menu-link px-3" data-kt-customer-table-filter="delete_row" data-bs-toggle="modal" data-bs-target="#modal_modificar_ver_complementos_<?= $servicio['servicio_id'] ?? '' ?>">Complementos</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" id="info_descripcion_<?= $servicio['servicio_id'] ?? '' ?>" style="display: none;">
                                                <br>
                                                <div class="col-md-12" style="padding:10px">
                                                    <?= $servicio['servicio_descripcion'] ?? '' ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal bg-body fade" tabindex="-1" id="modal_modificar_servicio_circuito_<?= $servicio['servicio_id'] ?? '' ?>">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content shadow-none">
                                            <div class="modal-header">

                                                <h5 class="modal-title">Modificar el servicio ( <?= $servicio['servicio_titulo'] ?? '' ?> )</h5>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <form id="form_modificar_circuito_<?= $servicio['servicio_id'] ?? '' ?>" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" data-kt-redirect="apps/ecommerce/catalog/products.html">
                                                    <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-450px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
                                                        <div class="card card-flush">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>Landing</h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body text-center pt-0">
                                                                <div class="image-input-wrapper w-150px h-150px" style="width: 100% !important;">
                                                                    <img id="imagen_landing_actual_<?= $servicio['servicio_id'] ?? '' ?>" style="width: 100%;height:100%;objet-fit:cover;" src="<?= $servicio['url_img_landing'] ?? '' ?>" alt="">
                                                                </div>
                                                                <button type="button" class="btn btn-success btn-sm mt-1 mb-1" style="width: 100%;" onclick="modificar_servicio_landing_img('<?= $servicio['servicio_id'] ?? '' ?>')">Cambiar</button>
                                                                <div class="text-muted fs-7">Sube una imagen principal. Solo se aceptan *.png, *.jpg and *.jpeg</div>
                                                                <input type="file" style="width: 0px;height:0px" id="modificar_servicio_landing_image_input_<?= $servicio['servicio_id'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                        <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>Estado</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    <div class="rounded-circle bg-<?= isset($servicio['estado']) && $servicio['estado'] == 1 ? 'success' : 'danger' ?> w-15px h-15px" id=""></div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                                                <select class="form-select mb-2" name="select_estado_circuito" id="select_estado_circuito_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="activo" data-select2-id="select2-data-135-ttuo" <?= isset($servicio['estado']) && $servicio['estado'] == 1 ? "selected" : "" ?>>Activo</option>
                                                                    <option value="no_activo" data-select2-id="select2-data-136-g08t" <?= isset($servicio['estado']) && $servicio['estado'] == 0 ? "selected" : "" ?>>No activo</option>
                                                                </select>
                                                                <div class="text-muted fs-7">Selecciona el estado del circuito</div>
                                                            </div>
                                                        </div>
                                                        <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>Mostrar en la web</h2>
                                                                </div>
                                                                <div class="card-toolbar">
                                                                    <div class="rounded-circle bg-<?= isset($servicio['mostrar_en_web']) && $servicio['mostrar_en_web'] == 1 ? 'success' : 'danger' ?> w-15px h-15px" id=""></div>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                                                <select class="form-select mb-2" name="select_mostrar_en_la_web" id="select_mostrar_en_la_web_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="si" data-select2-id="select2-data-135-ttuo" <?= isset($servicio['mostrar_en_web']) && $servicio['mostrar_en_web'] == 1 ? "selected" : "" ?>>Si</option>
                                                                    <option value="no" data-select2-id="select2-data-136-g08t" <?= isset($servicio['mostrar_en_web']) && $servicio['mostrar_en_web'] == 0 ? "selected" : "" ?>>No</option>
                                                                </select>
                                                                <div class="text-muted fs-7">Mostrar en la web</div>
                                                            </div>
                                                        </div>
                                                        <div class="card card-flush py-4" data-select2-id="select2-data-131-ex24">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    <h2>Circuito | Oferta</h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                                                <select class="form-select mb-2" name="select_tipo_servicio" id="select_tipo_servicio_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="Tour" data-select2-id="select2-data-135-ttuo" <?= isset($servicio['servicio_tipo']) && $servicio['servicio_tipo'] == 'tour' ? "selected" : "" ?>>Tour</option>
                                                                    <option value="oferta" data-select2-id="select2-data-136-g08t" <?= isset($servicio['servicio_tipo']) && $servicio['servicio_tipo'] == 'oferta' ? "selected" : "" ?>>Oferta</option>
                                                                    <option value="circuito_oferta" data-select2-id="select2-data-136-g08t" <?= isset($servicio['servicio_tipo']) && $servicio['servicio_tipo'] == 'circuito_oferta' ? "selected" : "" ?>>Circuito-oferta</option>
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
                                                                <select class="form-select mb-2" name="select_particular_o_empresa_servicio" id="select_particular_o_empresa_servicio_<?= $servicio['servicio_id'] ?? '' ?>" required>
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="Empresa" data-select2-id="select2-data-135-ttuo" <?= isset($servicio['particular_o_empresa']) && $servicio['particular_o_empresa'] === 'Empresa' ? 'selected' : '' ?>>Empresa</option>
                                                                    <option value="Particular" data-select2-id="select2-data-136-g08t" <?= isset($servicio['particular_o_empresa']) && $servicio['particular_o_empresa'] === 'Particular' ? 'selected' : '' ?>>Particular</option>
                                                                    <option value="Ambos" data-select2-id="select2-data-136-g08t" <?= isset($servicio['particular_o_empresa']) && $servicio['particular_o_empresa'] === 'Ambos' ? 'selected' : '' ?>>Ambos</option>
                                                                </select>
                                                                <div class="text-muted fs-7">Seleccionar particular | empresa | ambos</div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                        <div class="tab-content">
                                                            <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general_<?= $servicio['servicio_id'] ?? '' ?>" role="tab-panel">
                                                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                                                    <div class="card card-flush py-4">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                <h2>Edita los datos del servicio</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body pt-0">
                                                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Titlulo del servicio</label>
                                                                                <input type="text" name="titulo_circuito" id="titulo_circuito_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" placeholder="titulo corto" value="<?= $servicio['servicio_titulo'] ?? '' ?>">
                                                                                <div class="text-muted fs-7">El titulo corto en el nombre del servicio (máx 100 caracteres)</div>
                                                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                                            </div>
                                                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Titlulo largo</label>
                                                                                <input type="text" name="titulo_circuito_largo" id="titulo_circuito_largo_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" placeholder="titulo largo" value="<?= $servicio['servicio_titulo_largo'] ?? '' ?>">
                                                                                <div class="text-muted fs-7">El titulo largo servira como mini descripción (máx 255 caracteres)</div>
                                                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                                            </div>
                                                                            <div>
                                                                                <label class="form-label">Descripción del servicio</label>
                                                                                <textarea class="form-control" name="descripcion_circuito_oferta" id="descripcion_circuito_oferta_<?= $servicio['servicio_id'] ?? '' ?>" rows="10" placeholder="Escribe una breve descripción"><?= $servicio['servicio_descripcion'] ?? '' ?></textarea>
                                                                                <div class="text-muted fs-7">Establezca una descripción para el servicio para una mejor visibilidad.</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body pt-0">
                                                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Descripción secundaria 1 (OPCIONAL)</label>
                                                                                <textarea class="form-control" name="descripcion_secundaria_uno" id="descripcion_secundaria_uno_<?= $servicio['servicio_id'] ?? '' ?>" rows="8" placeholder="Escribe una breve descripción (opcional)"><?= $servicio['descripcion_dos'] ?? '' ?></textarea>
                                                                            </div>
                                                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                <label class="form-label">Descripción secundaria 2 (OPCIONAL)</label>
                                                                                <textarea class="form-control" name="descripcion_secundaria_dos" id="descripcion_secundaria_dos_<?= $servicio['servicio_id'] ?? '' ?>" rows="8" placeholder="Escribe una breve descripción (opcional)"><?= $servicio['descripcion_tres'] ?? '' ?></textarea>
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
                                                                                    <div id="mainImagePreview_<?= $servicio['servicio_id'] ?? '' ?>" class="mb-2">
                                                                                        <div class="mb-2">
                                                                                            <img class="img-thumbnail" style="width: 100px;height:100px" src="<?= $servicio['imagen_principal'] ?? '' ?>" id="imagen_principal_<?= $servicio['servicio_id'] ?? '' ?>" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <button type="button" id="selectMainImageBtn_<?= $servicio['servicio_id'] ?? '' ?>" class="btn btn-success btn-sm" onclick="escoger_otra_imagen_principal(<?= $servicio['servicio_id'] ?? '' ?>)">Escoger otra Imagen Principal</button>
                                                                                    <input type="file" accept="image/*" id="mainImageInput_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" style="display: none;" />
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h3>Imágenes Adicionales</h3>

                                                                                    <div id="additionalImagesPreviewContainer_<?= $servicio['servicio_id'] ?? '' ?>" class="row mb-2 contenedor_media_<?= $servicio['servicio_id'] ?? '' ?>" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                                        <?php if (count($servicio['resto_imagenes']) > 0) : ?>
                                                                                            <?php foreach ($servicio['resto_imagenes_info_completa'] as $imagen) : ?>
                                                                                                <div class="col-md-3 col-sm-3" id="contenedor_media_<?= $imagen['id'] ?? '' ?>">
                                                                                                    <img class="col-md-3 col-sm-3" style="width: 100px;height:100px" src="<?= $imagen['url'] ?>" />
                                                                                                    <button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px" onclick="eliminar_imagen('<?= $imagen['id'] ?>')">Eliminar</button>
                                                                                                </div>
                                                                                            <?php endforeach ?>
                                                                                        <?php endif ?>
                                                                                    </div>
                                                                                    <?php if (count($servicio['resto_imagenes']) == 0) : ?>
                                                                                        <button type="button" id="addImageBtn_<?= $servicio['servicio_id'] ?? '' ?>" class="btn btn-primary btn-sm" onclick="anyadir_mas_imagenes_al_servicio(<?= $servicio['servicio_id'] ?? '' ?>)">Añadir mas imágenes</button>
                                                                                    <?php endif ?>
                                                                                    <input type="file" accept="image/*" id="additionalImagesInput_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" style="display: none;" multiple />
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-muted fs-7">Establece la galería multimedia del circuito Imagen principal + (máximo 5 imágenes).</div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="card card-flush py-4">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                <h2>Info incluidos y no incluidos</h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-body pt-0">

                                                                            <?php
                                                                            $array_incluidos_y_no_incluidos_del_servicio = $servicio['array_incluidos_y_no_incluidos'];
                                                                            $items_por_incluido_id = $servicio['items_por_incluido_id'];


                                                                            ?>
                                                                            <hr>
                                                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_incluidos_y_no_incluidos_del_servicio_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                <div class="mb-5">
                                                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_incluidos_y_no_incluidos_del_servicio_item_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                        <span class="accordion-icon">
                                                                                            <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i>
                                                                                        </span>
                                                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Listado : (<span style="color:red" id="cantidad_items_servicios_incluir"><?= count($array_incluidos_y_no_incluidos_del_servicio) ?></span>)</h3>
                                                                                    </div>

                                                                                    <div id="kt_accordion_incluidos_y_no_incluidos_del_servicio_item_<?= $servicio['servicio_id'] ?? '' ?>" class="collapse fs-6 ps-10 mt-2 show" data-bs-parent="#kt_accordion_incluidos_y_no_incluidos_del_servicio_<?= $servicio['servicio_id'] ?? '' ?>">
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
                                                                                                <tbody id="tbody_incluidos_y_no_inlcuidos_del_servicio_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                                    <?php foreach ($array_incluidos_y_no_incluidos_del_servicio as $item) :
                                                                                                        // echo '<pre>';
                                                                                                        // print_r($item);
                                                                                                        // echo '</pre>';
                                                                                                    ?>

                                                                                                        <tr id="tr_incluidos_y_no_inlcuidos_del_servicio_<?= $item['id'] ?>">
                                                                                                            <td>
                                                                                                                <div class="d-flex align-items-center">
                                                                                                                    <div class="symbol symbol-50px me-3">
                                                                                                                        <img src="<?= $item['mas_info']['url_icono'] ?? '' ?>" class="" alt="">
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td class="text-start pe-13">
                                                                                                                <span class="text-gray-600 fw-bold fs-6"><?= $item['mas_info']['nombre'] ?? '' ?></span>
                                                                                                            </td>
                                                                                                            <td class="text-start pe-13">
                                                                                                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid mt-2" style="text-align: end;">
                                                                                                                    <input class="form-check-input" onchange="modificar_estado_es_incluido('<?= $item['id'] ?? '' ?>')" id="check_es_incluido_<?= $item['id'] ?? '' ?>" type="checkbox" value="" <?= isset($item['es_incluido']) && $item['es_incluido'] == 1 ? 'checked' : '' ?> />
                                                                                                                </div>
                                                                                                            </td>
                                                                                                            <td class="text-end">
                                                                                                                <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_desvincular_item_incluido_o_no_incluido_del_servicio('<?= $item['mas_info']['id'] ?>','<?= $servicio['servicio_id'] ?>')">
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
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card card-flush py-4">
                                                                        <div class="card-header">
                                                                            <div class="card-title">
                                                                                <h2>Añadir mas inlcuidos y no inlcuidos</h2>
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

                                                                            <?php
                                                                            $array_incluidos_y_no_incluidos_del_servicio = $servicio['array_incluidos_y_no_incluidos'];
                                                                            $items_por_incluido_id = $servicio['items_por_incluido_id'];
                                                                            $items_a_mostrar = [];

                                                                            $array_items_incl_no_inc_a_mostrar = [];
                                                                            $sql_incluidos = mysql_query("SELECT * FROM tabla_incluidos WHERE mostrar_para_seleccionar=1 ORDER BY nombre ASC");
                                                                            while ($fetch = mysql_fetch_assoc($sql_incluidos)) :
                                                                                if (!isset($items_por_incluido_id[$fetch['id']])) {
                                                                                    $items_a_mostrar[] = $fetch;
                                                                                }
                                                                            endwhile;

                                                                            ?>
                                                                            <hr>
                                                                            <div class="accordion accordion-icon-collapse" id="kt_accordion_servicios_incluidos_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                <div class="mb-5">
                                                                                    <div class="accordion-header py-3 d-flex" data-bs-toggle="collapse" data-bs-target="#kt_accordion_servicios_incluidos_item_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                        <span class="accordion-icon">
                                                                                            <i class="ki-duotone ki-plus-square fs-3 accordion-icon-off"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                                                            <i class="ki-duotone ki-minus-square fs-3 accordion-icon-on"><span class="path1"></span><span class="path2"></span></i>
                                                                                        </span>
                                                                                        <h3 class="fs-4 fw-semibold mb-0 ms-4">Listado : (<span style="color:red" id="cantidad_items_servicios_incluir"><?= count($items_a_mostrar) ?></span>)</h3>
                                                                                    </div>

                                                                                    <div id="kt_accordion_servicios_incluidos_item_<?= $servicio['servicio_id'] ?? '' ?>" class="collapse fs-6 ps-10 mt-2 show" data-bs-parent="#kt_accordion_servicios_incluidos_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                                                                                                <thead>
                                                                                                    <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                                                                        <th class="p-0 pb-3 min-w-100px text-start">Icono</th>
                                                                                                        <th class="p-0 pb-3 min-w-100px text-start pe-13">Servicio</th>
                                                                                                        <th class="p-0 pb-3 w-50px text-end">Incluir</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody id="tbody_nuevos_incluidos_<?= $servicio['servicio_id'] ?? '' ?>">
                                                                                                    <?php foreach ($items_a_mostrar as $item) : ?>
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

                                                                                                                <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;" onclick="fn_incluir_nuevo_item_al_servicio('<?= $item['id'] ?>','<?= $servicio['servicio_id'] ?>')">
                                                                                                                    <span class="path1"></span>
                                                                                                                    <span class="path2"></span>
                                                                                                                </i>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    <?php endforeach ?>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class=" text-muted fs-7">
                                                                                Escoge los servicios incluidos y los no incluidos.
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
                                                                                        <input type="text" name="precio_circuito_oferta" id="precio_circuito_oferta_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" placeholder="Precio del circuito" value="<?= $servicio['precio_servicio'] ?? '' ?>" required onkeyup="calcular_cantidad_a_ingresar(<?= $servicio['servicio_id'] ?? '' ?>)">
                                                                                        <div class="text-muted fs-7">Establece el precio del producto.</div>
                                                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-12">
                                                                                        <label class="required form-label">Porcentaje</label>
                                                                                        <select class="form-select mb-2" name="select_porcentaje_circuito_oferta" id="select_porcentaje_circuito_oferta_<?= $servicio['servicio_id'] ?? '' ?>" onchange="calcular_cantidad_a_ingresar(<?= $servicio['servicio_id'] ?? '' ?>)">
                                                                                            <option value="0" <?= isset($servicio['porcentaje']) && $servicio['porcentaje'] == 0 ? 'selected' : '' ?>>Seleccionar</option>
                                                                                            <option value="5" data-select2-id="select2-data-135-ttuo" <?= isset($servicio['porcentaje']) && $servicio['porcentaje'] == 5 ? 'selected' : '' ?>>5%</option>
                                                                                            <option value="10" data-select2-id="select2-data-136-g08t" <?= isset($servicio['porcentaje']) && $servicio['porcentaje'] == 10 ? 'selected' : '' ?>>10%</option>
                                                                                            <option value="15" data-select2-id="select2-data-136-g08t" <?= isset($servicio['porcentaje']) && $servicio['porcentaje'] == 15 ? 'selected' : '' ?>>15%</option>
                                                                                            <option value="20" data-select2-id="select2-data-136-g08t" <?= isset($servicio['porcentaje']) && $servicio['porcentaje'] == 20 ? 'selected' : '' ?>>20%</option>
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
                                                                                        <input type="number" readonly name="cantidad_a_ingresar" id="cantidad_a_ingresar_<?= $servicio['servicio_id'] ?? '' ?>" class="form-control mb-2" placeholder="Cantidad que se debe de adelantar" value="<?= $servicio['precio_a_adelantar'] ?? '' ?>">
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
                                                            <a class="btn btn-light me-5" data-bs-dismiss="modal">Cancel</a>
                                                            <button type="button" id="btn_modificar_servicio_circuito_oferta_<?= $servicio['servicio_id'] ?? '' ?>" class="btn btn-primary btn-sm" onclick="modificar_servicio_circuito(<?= $servicio['servicio_id'] ?? '' ?>)">
                                                                <span class="indicator-label">Guardar el circuito</span>
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
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="alert alert-warning">No hay servicios</div>
                <?php endif ?>
            </div>
        </div>

    </div>


</div>