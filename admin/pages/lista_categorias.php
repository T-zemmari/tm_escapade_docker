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
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nueva_categoria">
                        Nueva categoria
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <?php
                $array_categorias = bn_obtener_categorias();

                if (isset($array_categorias) && count($array_categorias) > 0) : ?>

                    <?php foreach ($array_categorias as $categoria) : ?>
                        <div class="modal fade" tabindex="-1" id="modal_modificar_categoria_<?= $categoria['id'] ?? '' ?>">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content shadow-none">
                                    <div class="modal-header">
                                        <h2>Formulario editar categoria <?= $categoria['nombre'] ?? '' ?></h2>
                                        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                        </div>
                                    </div>
                                    <div class="modal-body" style="padding: 15px !important;">
                                        <form id="form_nueva_categoria" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-350px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
                                                <div class="card card-flush py-4">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h2>Imagen principal</h2>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-center pt-0">
                                                        <div class="image-input-wrapper w-150px h-150px" style="width: 100% !important;">
                                                            <img id="imagen_principal_actual_<?= $categoria['id'] ?? '' ?>" style="height:100%;objet-fit:cover;" src="<?= $categoria['url_imagen_principal'] ?? '' ?>" alt="">
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-sm mt-1 mb-1" style="width: 100%;" onclick="modificar_imagen_principal_categoria('<?= $categoria['id'] ?? '' ?>')">Cambiar</button>
                                                        <div class="text-muted fs-7">Sube una imagen principal. Solo se aceptan *.png, *.jpg and *.jpeg</div>
                                                        <input type="file" style="width: 0px;height:0px" id="modificar_imagen_principal_categoria_<?= $categoria['id'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <div class="card card-flush py-4">
                                                    <div class="card-header">
                                                        <div class="card-title">
                                                            <h2>Activa</h2>
                                                        </div>
                                                        <div class="card-toolbar">
                                                            <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                                        </div>
                                                    </div>
                                                    <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                                        <select class="form-select mb-2" name="select_categoria_estado" id="select_categoria_estado_<?= $categoria['id'] ?? '' ?>">
                                                            <option value="">Seleccionar</option>
                                                            <option value="1" <?= isset($categoria['categoria_estado']) && $categoria['categoria_estado'] == 1 ? 'selected' : '' ?>>Activa</option>
                                                            <option value="0" <?= isset($categoria['categoria_estado']) && $categoria['categoria_estado'] == 0 ? 'selected' : '' ?>>No activa</option>
                                                        </select>
                                                        <div class="text-muted fs-7">Selecciona el estado de la categoria</div>
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
                                                        <select class="form-select mb-2" name="select_categoria_descatalogada" id="select_categoria_descatalogada_<?= $categoria['id'] ?? '' ?>" required>
                                                            <option value="">Seleccionar</option>
                                                            <option value="1" <?= isset($categoria['categoria_descatalogada']) && $categoria['categoria_descatalogada'] == 1 ? 'selected' : '' ?>>Descatalogada</option>
                                                            <option value="0" <?= isset($categoria['categoria_descatalogada']) && $categoria['categoria_descatalogada'] == 0 ? 'selected' : '' ?>>No Descatalogada</option>
                                                        </select>
                                                        <div class="text-muted fs-7">¿ La categoria esta descatalogada ?</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <div class="tab-content">
                                                    <div class="tab-pane fade active show" id="kt_ecommerce_nuevo_categoria" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <div class="card card-flush py-4">
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Información de la categoria </h2>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-0">
                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="required form-label">Nombre de la categoria</label>
                                                                                <input type="text" name="categoria_nombre" id="categoria_nombre_<?= $categoria['id'] ?? '' ?>" class="form-control mb-2" placeholder="Nombre" value="<?= $categoria['nombre'] ?? '' ?>">
                                                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-md-12 col-sm-12">
                                                                                <label class="form-label">Description de la categoria</label>
                                                                                <textarea class="form-control" name="categoria_descripcion" id="categoria_descripcion_<?= $categoria['id'] ?? '' ?>" rows="20" placeholder="Escribe una breve descripción"><?= $categoria['descripcion'] ?? '' ?></textarea>
                                                                                <div class="text-muted fs-7">Establezca una descripción para la categoria para una mejor visibilidad.</div>
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
                                                                                                <button type="button" id="resto_imagenes_categoria_<?= $categoria['id'] ?? '' ?>" class="btn btn-primary btn-sm" onclick="anyadir_mas_imagenes_a_la_categoria('<?= $categoria['id'] ?? '' ?>')">Añadir Imágenes</button>
                                                                                                <div id="resto_imagenes_categoria_preview_<?= $categoria['id'] ?? '' ?>" class="row mb-2 mt-3" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                                                    <?php if (count($categoria['resto_imagenes_categoria']) > 0) : ?>
                                                                                                        <?php foreach ($categoria['resto_imagenes_categoria'] as $imagen) : ?>
                                                                                                            <div class="col-md-3 col-sm-3" id="contenedor_categoria_media_<?= $imagen['id'] ?? '' ?>">
                                                                                                                <img class="col-md-3 col-sm-3" style="width: 100px;height:100px" src="<?= $imagen['url_media'] ?? '' ?>" />
                                                                                                                <button type="button" class="btn btn-danger btn-sm mt-1" style="width:94px" onclick="eliminar_imagen_secundaria_categoria('<?= $imagen['id'] ?? '' ?>')">Eliminar</button>
                                                                                                            </div>
                                                                                                        <?php endforeach ?>
                                                                                                    <?php endif ?>
                                                                                                </div>
                                                                                                <input type="file" accept="image/*" nams="categoria_resto_imagenes[]" id="resto_imagenes_categoria_input_<?= $categoria['id'] ?? '' ?>" class="form-control mb-2" style="display: none;" multiple />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-muted fs-7">Establece la galería multimedia de la categoria.</div>
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
                                                    <button type="button" id="btn_editar_categoria_<?= $categoria['id'] ?? '' ?>" class="btn btn-primary btn-sm" onclick="modificar_categoria('<?= $categoria['id'] ?? '' ?>')">
                                                        <span class="indicator-label">Guardar la nueva categoria</span>
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

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-250px sorting" style="width: 789.219px;">Categoria</th>
                                    <th class="sorting" style="width: 80px;">Activa</th>
                                    <th class="text-end min-w-70px sorting_disabled">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($array_categorias as $categoria) : ?>
                                    <tr class="odd" id="tr_categoria_<?= $categoria['id'] ?? '' ?>">
                                        <td>
                                            <div class="d-flex">
                                                <a class="symbol symbol-50px image-popup-link" href="<?= $categoria['url_imagen_principal'] ?? '' ?>">
                                                    <span class="symbol-label" style="background-image:url(<?= $categoria['url_imagen_principal'] ?? '' ?>);"></span>
                                                </a>
                                                <div class="ms-5">
                                                    <a class="text-gray-800 text-hover-primary fs-5 fw-bold mb-1" data-kt-ecommerce-category-filter="category_name"><?= $categoria['nombre'] ?? '' ?></a>
                                                    <div class="text-muted fs-7 fw-bold"><?= $categoria['nombre'] ?? '' ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?= $categoria['categoria_estado'] ? 'Si' : 'No' ?>
                                        </td>
                                        <td class="text-end">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_modificar_categoria_<?= $categoria['id'] ?? '' ?>">
                                                <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_categoria('<?= $categoria['id'] ?? '' ?>')">
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

    <div class="modal fade" tabindex="-1" id="modal_nueva_categoria">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h2>Formulario nueva categoria</h2>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                </div>
                <div class="modal-body" style="padding: 15px !important;">
                    <form id="form_nueva_categoria" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
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
                                            <input type="file" name="avatar" id="categoria_imagen_principal" accept=".png, .jpg, .jpeg">
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
                                        <h2>Activa</h2>
                                    </div>
                                    <div class="card-toolbar">
                                        <div class="rounded-circle bg-success w-15px h-15px" id=""></div>
                                    </div>
                                </div>
                                <div class="card-body pt-0" data-select2-id="select2-data-130-xcbg">
                                    <select class="form-select mb-2" name="select_categoria_estado" id="select_categoria_estado" required>
                                        <option value="0" selected="selected">Seleccionar</option>
                                        <option value="1">Activo</option>
                                        <option value="0">No activo</option>
                                    </select>
                                    <div class="text-muted fs-7">Selecciona el estado de la categoria</div>
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
                                    <select class="form-select mb-2" name="select_categoria_descatalogada" id="select_categoria_descatalogada" required>
                                        <option value="" selected="selected">Seleccionar</option>
                                        <option value="1">Descatalogada</option>
                                        <option value="0">No Descatalogada</option>
                                    </select>
                                    <div class="text-muted fs-7">¿ La categoria esta descatalogada ?</div>
                                </div>
                            </div>-->
                        </div>
                        <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="kt_ecommerce_nuevo_categoria" role="tab-panel">
                                    <div class="d-flex flex-column gap-7 gap-lg-10">
                                        <div class="card card-flush py-4">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h2>Información de la categoria </h2>
                                                </div>
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="mb-10 fv-row fv-plugins-icon-container">
                                                    <div class="row">
                                                        <div class="col-xl-4 col-md-4 col-sm-12">
                                                            <label class="required form-label">Nombre de la categoria</label>
                                                            <input type="text" name="categoria_nombre" id="categoria_nombre" class="form-control mb-2" placeholder="Nombre" value="" required>
                                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-md-12 col-sm-12">
                                                            <label class="form-label">Description de la categoria</label>
                                                            <textarea class="form-control" name="categoria_descripcion" id="categoria_descripcion" rows="8" placeholder="Escribe una breve descripción" required></textarea>
                                                            <div class="text-muted fs-7">Establezca una descripción para la categoria para una mejor visibilidad.</div>
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
                                                                            <button type="button" id="resto_imagenes_categoria" class="btn btn-primary btn-sm">Añadir Imágenes</button>
                                                                            <div id="resto_imagenes_categoria_preview" class="row mb-2" style="display: flex;justify-content:flex-start;flex-wrap:wrap;gap:10px">
                                                                                <!-- Imágenes adicionales se mostrarán aquí -->
                                                                            </div>
                                                                            <input type="file" accept="image/*" nams="categoria_resto_imagenes[]" id="resto_imagenes_categoria_input" class="form-control mb-2" style="display: none;" multiple />
                                                                        </div>
                                                                    </div>
                                                                    <div class="text-muted fs-7">Establece la galería multimedia de la categoria.</div>
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
                                <button type="button" id="btn_crear_nueva_categoria" class="btn btn-primary btn-sm" onclick="crear_nueva_categoria()">
                                    <span class="indicator-label">Guardar la nueva categoria</span>
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
</div>