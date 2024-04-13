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
                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nuevo_producto">
                        Nuevo producto
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <?php
                $array_productos = bn_obtener_productos();

                if (isset($array_productos) && count($array_productos) > 0) : ?>


                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-250px sorting" style="width: 789.219px;">producto</th>
                                    <th class="sorting" style="width: 80px;">Activo</th>
                                    <th class="text-end min-w-70px sorting_disabled">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($array_productos as $producto) : ?>
                                    <tr class="odd" id="tr_producto_<?= $producto['id'] ?? '' ?>">
                                        <td>
                                            <div class="d-flex">
                                                <a class="symbol symbol-50px image-popup-link" href="<?= $producto['url_imagen_principal'] ?? '' ?>">
                                                    <span class="symbol-label" style="background-image:url(<?= $producto['url_imagen_principal'] ?? '' ?>);"></span>
                                                </a>
                                                <div class="ms-5">
                                                    <a class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name"><?= $producto['nombre'] ?? '' ?></a>
                                                    <div class="text-muted fs-7 fw-bold"><?= $producto['nombre'] ?? '' ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= isset($producto['activo']) && $producto['activo'] ? 'Si' : 'No' ?>
                                        </td>
                                        <td class="text-end">
                                            <a onclick="lista_informacion_producto_para_modificar('<?= $producto['id'] ?? '' ?>')">
                                                <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_producto('<?= $producto['id'] ?? '' ?>')">
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
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="alert alert-warning">Lista vacia</div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>

    <!--########################################################################################-->
    <!--############################ MODAL CREAR UN PRODUCTO ###################################-->
    <!--########################################################################################-->

    <div class="modal fade" tabindex="-1" id="modal_nuevo_producto">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h2>Formulario nuevo producto</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body" style="padding: 15px !important;">
                    <form id="form_nuevo_producto" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
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
                                            <input type="file" name="avatar" id="producto_imagen_principal" accept=".png, .jpg, .jpeg">
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
                            <div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Categoria</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_categoria" id="select_categoria" required>
                                        <option value="" selected="selected">Seleccionar</option>
                                        <?php
                                        $sql_categorias = mysql_query("SELECT * FROM categorias WHERE categoria_estado=1 ORDER BY nombre ASC");
                                        while ($fetch_cat = mysql_fetch_assoc($sql_categorias)) : ?>
                                            <option value="<?= $fetch_cat['id'] ?? '' ?>"><?= $fetch_cat['nombre'] ?? '' ?></option>
                                        <?php endwhile; ?>
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
                                    <select class="form-select mb-2" name="select_producto_estado" id="select_producto_estado" required>
                                        <option value="" selected="selected">Seleccionar</option>
                                        <option value="1">Activo</option>
                                        <option value="0" selected>No activo</option>
                                    </select>
                                    <div class="text-muted fs-7">Selecciona el estado del producto</div>
                                </div>
                            </div>
                            <!--<div class="card card-flush py-4">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>Descatalogada</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_producto_descatalogada" id="select_producto_descatalogada" required>
                                        <option value="" selected="selected">Seleccionar</option>
                                        <option value="1">Descatalogada</option>
                                        <option value="0">No Descatalogada</option>
                                    </select>
                                    <div class="text-muted fs-7">¿ La producto esta descatalogada ?</div>
                                </div>
                            </div>-->
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
                                                            <input type="text" name="producto_nombre" id="producto_nombre" class="form-control mb-2" placeholder="Nombre" value="" required>
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                        <div class="col-xl-8 col-md-8 col-sm-12">
                                                            <label class="required form-label">Descripcion corta</label>
                                                            <input type="text" name="descripcion_corta" id="descripcion_corta" class="form-control mb-2" placeholder="Descripción corta" value="" required>
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row" style="margin-top: 25px;min-height:300px">
                                                        <div class="col-xl-12 col-md-12 col-sm-12">
                                                            <label class="form-label">Descripcion principal del producto</label>
                                                            <textarea class="form-control" name="producto_descripcion" id="producto_descripcion" rows="8" placeholder="Escribe una breve descripción" required></textarea>
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
                                                                            <input type="text" name="precio_de_coste" id="precio_de_coste" class="form-control mb-2" placeholder="Coste" value="" required>
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Precio antes (PVR)</label>
                                                                            <input type="text" name="pvr" id="pvr" class="form-control mb-2" placeholder="PVR" value="" required>
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Precio de venta</label>
                                                                            <input type="text" name="precio_de_venta" id="precio_de_venta" class="form-control mb-2" placeholder="Precio de venta" value="" required>
                                                                            <div class="text-muted fs-7">Con iva</div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Mostrar en web</label>
                                                                            <select class="form-select mb-2" name="select_mostrar_en_web" id="select_mostrar_en_web" required>
                                                                                <option value="">Seleccionar</option>
                                                                                <option value="1">Mostrar</option>
                                                                                <option value="0" selected>No mostrar</option>
                                                                            </select>
                                                                            <div class="text-muted fs-7">Mostrar en la web</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Ean</label>
                                                                            <input type="numbre" name="ean_producto" id="ean_producto" class="form-control mb-2" placeholder="Ean" value="">
                                                                            <div class="text-muted fs-7">Ean del producto</div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Stock minimo</label>
                                                                            <input type="numbre" name="stock_minimo" id="stock_minimo" class="form-control mb-2" placeholder="Stock minimo" value="0" required>
                                                                            <div class="text-muted fs-7">No se vende si el stock < a la cantidad seleccionada</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                                            <label class="required form-label">Stock inicial</label>
                                                                            <input type="numbre" name="stock_inicial" id="stock_inicial" class="form-control mb-2" placeholder="Stock inicial" value="0" required>
                                                                            <div class="text-muted fs-7">Inicia el stock con una cantidad > 0</div>
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
                                                                                <button type="button" id="resto_imagenes_producto" class="btn btn-primary btn-sm">Añadir Imágenes</button>
                                                                                <div id="resto_imagenes_producto_preview" class="row mb-2 mt-5" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                                    <!-- Imágenes adicionales se mostrarán aquí -->
                                                                                </div>
                                                                                <input type="file" accept="image/*" nams="producto_resto_imagenes[]" id="resto_imagenes_producto_input" class="form-control mb-2" style="display: none;" multiple />
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
                                    <button type="button" id="btn_crear_nuevo_producto" class="btn btn-primary btn-sm" onclick="crear_nuevo_producto()">
                                        <span class="indicator-label">Guardar nuevo producto</span>
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

    <!--########################################################################################-->
    <!--########################### MODAL EDITAR UN PRODUCTO ###################################-->
    <!--########################################################################################-->

    <div class="modal fade" tabindex="-1" id="modal_modificar_producto">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h2>Formulario editar producto <span id="nombre_producto"><span></h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body" id="body_modal_contenedor_formulario_modificar" style="padding: 15px !important;">

                </div>
            </div>
        </div>
    </div>
</div>