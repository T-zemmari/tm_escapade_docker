<div id="kt_app_content_container" class="app-container container-xxl">
    <?php if (isset($datos_fiscales) && !empty($datos_fiscales) && isset($datos_fiscales['razon_social']) &&  $datos_fiscales['razon_social'] != '') :

    ?>
        <div class="d-flex flex-column flex-xl-row">
            <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body pt-15">
                        <div class="d-flex flex-center flex-column mb-5">
                            <div class="symbol symbol-100px symbol-circle mb-7">
                                <img src="<?= $datos_fiscales['url_logo'] ?? '' ?>" alt="logo">
                            </div>
                            <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                <?= $datos_fiscales['razon_social'] ?? '' ?>
                            </a>
                            <div class="fs-5 fw-semibold text-muted mb-6">
                                TM-ESCAPADE
                            </div>
                        </div>
                        <div class="d-flex flex-stack fs-4 py-3">
                            <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_nuevos_datos_fiscales_details" role="button" aria-expanded="false" aria-controls="kt_nuevos_datos_fiscales_details">
                                Detalles
                                <span class="ms-2 rotate-180">
                                    <i class="ki-duotone ki-down fs-3"></i>
                                </span>
                            </div>

                            <span data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-original-title="Edit customer details" data-kt-initialized="1">
                                <a  class="btn btn-sm btn-light-primary" datos_fiscales_id="<?= $datos_fiscales['id'] ?? '' ?>" data-bs-toggle="modal" data-bs-target="#modal_datos_fiscales_<?= $datos_fiscales['id'] ?? '' ?>">
                                    Editar
                                </a>
                            </span>
                        </div>
                        <div class="separator separator-dashed my-3"></div>

                        <div id="kt_nuevos_datos_fiscales_details" class="collapse show">
                            <div class="py-5 fs-6">
                                <div class="badge badge-light-info d-inline">Admin</div>
                                <div class="fw-bold mt-5">Email</div>
                                <div class="text-gray-600"><span><?= $datos_fiscales['email'] ?? '' ?></span></div>
                                <div class="fw-bold mt-5">Dirección</div>
                                <div class="text-gray-600"><?= $datos_fiscales['direccion_principal']['tipo_via'] ?? '' ?>
                                    <?= $datos_fiscales['direccion_principal']['direccion'] ?? '' ?>
                                    <?= $datos_fiscales['direccion_principal']['numero'] ?? '' ?>
                                    ,
                                    <?= $datos_fiscales['direccion_principal']['piso'] ?? '' ?>
                                    <?= $datos_fiscales['direccion_principal']['puerta'] ?? '' ?>,
                                    <?= $datos_fiscales['direccion_principal']['cp'] ?? '' ?>
                                    <br><?= $datos_fiscales['direccion_principal']['ciudad'] ?? '' ?><br><?= $datos_fiscales['direccion_principal']['pais'] ?? '' ?>
                                </div>
                                <div class="fw-bold mt-5">Idioma</div>
                                <div class="text-gray-600">Español</div>
                                <div class="fw-bold mt-5">Teléfonos</div>
                                <div class="text-gray-600"><?= $datos_fiscales['fix_phone'] ?? '' ?> <?= $datos_fiscales['movil_phone'] ?? '' ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-lg-row-fluid ms-lg-15">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="kt_customer_view_overview_tab" role="tabpanel">
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Direcciones</h2>
                                </div>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-flex btn-light-primary" data-bs-toggle="modal" data-bs-target="#modal_nueva_direccion_fiscal_<?= $datos_fiscales['id'] ?? '' ?>">
                                        <i class="ki-duotone ki-plus-square fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                        Añadir nueva dirección
                                    </button>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <?php $array_direcciones = bn_obtener_direcciones(); ?>
                                <?php if (count($array_direcciones) == 0) : ?>
                                    <div class="alert alert-warning">No hay direcciones</div>
                                <?php else : ?>
                                    <?php foreach ($array_direcciones as $direccion) : ?>
                                        <div class="modal modal-lg fade" tabindex="-1" id="modal_editar_direccion_fiscal_<?= $direccion['id'] ?? '' ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content shadow-none">

                                                    <div class="modal-body" style="padding: 15px !important;">
                                                        <form id="form_editar_direccion_<?= $direccion['id'] ?? '' ?>" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                                <div class="tab-content">
                                                                    <div class="tab-pane fade active show" id="kt_admin_editar_direccion_<?= $direccion['id'] ?? '' ?>" role="tab-panel">
                                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                                            <div class="card card-flush py-4">
                                                                                <div class="modal-header">
                                                                                    <h3 class="modal-title">Editar dirección</h3>
                                                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card-body pt-5">
                                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">

                                                                                        <div class="row">
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <input type="hidden" id="input_hidden_id_datos_fiscales_<?= $direccion['id'] ?? '' ?>" value="<?= $datos_fiscales['id'] ?? '' ?>">
                                                                                                <label class="form-label">Dirección principal</label>
                                                                                                <select class="form-select mb-2" name="select_es_principal" id="select_es_principal_modificar_<?= $direccion['id'] ?? '' ?>">
                                                                                                    <option value="">Seleccionar</option>
                                                                                                    <option value="0" <?= isset($direccion['es_principal']) && $direccion['es_principal'] == '0' ? 'selected' : '' ?>>No</option>
                                                                                                    <option value="1" <?= isset($direccion['es_principal']) && $direccion['es_principal'] == '1' ? 'selected' : '' ?>>Si</option>
                                                                                                </select>
                                                                                            </div>

                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Tipo de via</label>
                                                                                                <select class="form-select mb-2" name="select_tipo_de_via" id="select_tipo_de_via_modificar_<?= $direccion['id'] ?? '' ?>">
                                                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                                                    <option value="calle" data-select2-id="select2-data-135-ttuo" <?= isset($direccion['tipo_via']) && $direccion['tipo_via'] == 'calle' ? 'selected' : '' ?>>Calle</option>
                                                                                                    <option value="via" data-select2-id="select2-data-136-g08t" <?= isset($direccion['tipo_via']) && $direccion['tipo_via'] == 'via' ? 'selected' : '' ?>>Via</option>
                                                                                                    <option value="avenida" data-select2-id="select2-data-136-g08t" <?= isset($direccion['tipo_via']) && $direccion['tipo_via'] == 'avenida' ? 'selected' : '' ?>>Avenida</option>
                                                                                                    <option value="plaza" data-select2-id="select2-data-136-g08t" <?= isset($direccion['tipo_via']) && $direccion['tipo_via'] == 'plaza' ? 'selected' : '' ?>>Plaza</option>
                                                                                                    <option value="camino" data-select2-id="select2-data-136-g08t" <?= isset($direccion['tipo_via']) && $direccion['tipo_via'] == 'camino' ? 'selected' : '' ?>>Camino</option>
                                                                                                </select>
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Dirección</label>
                                                                                                <input type="text" name="direccion" id="direccion_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Dirección" value="<?= $direccion['direccion'] ?? '' ?>">
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Número</label>
                                                                                                <input type="text" name="numero" id="numero_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Número" value="<?= $direccion['numero'] ?? '' ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                        <div class="row">
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Piso</label>
                                                                                                <input type="text" name="piso" id="piso_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Piso" value="<?= $direccion['piso'] ?? '' ?>">
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Puerta</label>
                                                                                                <input type="text" name="puerta" id="puerta_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Puerta" value="<?= $direccion['puerta'] ?? '' ?>">
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Código postal</label>
                                                                                                <input type="text" name="codigo_postal" id="codigo_postal_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Código postal" value="<?= $direccion['cp'] ?? '' ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                                        <div class="row">
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Municipio</label>
                                                                                                <input type="text" name="municipio" id="municipio_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Municipio" value="<?= $direccion['municipio'] ?? '' ?>">
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">Ciudad</label>
                                                                                                <input type="text" name="ciudad" id="ciudad_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="Ciudad" value="<?= $direccion['ciudad'] ?? '' ?>">
                                                                                            </div>
                                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                                <label class="form-label">País</label>
                                                                                                <input type="text" name="pais" id="pais_modificar_<?= $direccion['id'] ?? '' ?>" class="form-control mb-2" placeholder="País" value="<?= $direccion['pais'] ?? '' ?>">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" id="btn_editar_direccion_fiscal_<?= $direccion['id'] ?? '' ?>" class="btn btn-primary btn-sm" address_id="<?= $direccion['id'] ?? '' ?>" onclick="modificar_direccion_empresa('<?= $direccion['id'] ?? '' ?>')">
                                                                        <span class="indicator-label">Editar</span>
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

                                    <div id="kt_table_direcciones" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="table-responsive">
                                            <table class="table align-middle table-row-dashed gy-5 dataTable no-footer" id="kt_table_direcciones_empresa">
                                                <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                    <tr class="text-start text-muted text-uppercase gs-0">
                                                        <th class="min-w-100px sorting">Tipo de via</th>
                                                        <th class="sorting">Dirección</th>
                                                        <th class="min-w-100px sorting" style="text-align:center">Es principal</th>
                                                        <th class="text-end min-w-100px pe-4 sorting_disabled" style="text-align:end">Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="fs-6 fw-semibold text-gray-600">
                                                    <?php foreach ($array_direcciones as $direccion) : ?>
                                                        <tr class="tr_direccion_<?= $direccion['id'] ?>" id="tr_direccion_<?= $direccion['id'] ?>">
                                                            <td>
                                                                <?= ucfirst($direccion['tipo_via']) ?? '' ?>
                                                            </td>
                                                            <td>
                                                                <?= ucfirst($direccion['direccion']) ?? '' ?>
                                                                <?= $direccion['numero'] ?? '' ?>
                                                                <?= $direccion['piso'] ?? '' ?>
                                                                <?= $direccion['puerta'] ?? '' ?>
                                                                <?= $direccion['cp'] ?? '' ?>
                                                                <?= $direccion['ciudad'] ?? '' ?>
                                                                <?= $direccion['pais'] ?? '' ?>
                                                            </td>
                                                            <td style="text-align:center">
                                                                <span><?= isset($direccion['es_principal']) && $direccion['es_principal'] == 1 ? 'Si' : 'No' ?></span>
                                                            </td>
                                                            <td style="text-align:end">
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_direccion_fiscal_<?= $direccion['id'] ?? '' ?>">
                                                                    <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </a>
                                                                <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="eliminar_direccion_empresa('<?= $direccion['id'] ?>')">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                </i>
                                                            </td>
                                                        </tr>

                                                    <?php endforeach ?>

                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--########################################################################-->
        <!--############## INICIO MODAL NUEVOS DATOS FISCALES ######################-->

        <div class="modal bg-body fade" tabindex="-1" id="modal_datos_fiscales_<?= $datos_fiscales['id'] ?? '' ?>">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content shadow-none">

                    <div class="modal-body" style="padding: 5px !important;">
                        <form id="form_datos_fiscales_modificar" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
                            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
                                <div class="card card-flush py-4">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Logo de la empresa</h2>
                                        </div>
                                    </div>

                                    <div class="card-body text-center pt-0">
                                        <style>
                                            .image-input-placeholder {
                                                background-image: url('<?= $datos_fiscales['url_logo'] ?? '' ?>');
                                            }

                                            [data-bs-theme="dark"] .image-input-placeholder {
                                                background-image: url('<?= $datos_fiscales['url_logo'] ?? '' ?>');
                                            }
                                        </style>
                                        <div class="image-input image-input-empty image-input-outline image-input-placeholder mb-3" data-kt-image-input="true">
                                            <div class="image-input-wrapper w-150px h-150px"></div>
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                                <i class="ki-duotone ki-pencil fs-7">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
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

                            </div>
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="kt_ecommerce_add_product_general_<?= $datos_fiscales['id'] ?? '' ?>" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>RAZÓN SOCIAL | TIPO DE DOCUMENTO | DOCUMENTO</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Razón social</label>
                                                                <input type="text" name="razon_social" id="razon_social_modificar" class="form-control mb-2" placeholder="Razón social" value="<?= $datos_fiscales['razon_social'] ?? '' ?>">
                                                                <input type="hidden" value="<?= $datos_fiscales['direccion_principal']['id'] ?? '' ?>" id="input_hidden_adress_id">
                                                                <input type="hidden" value="<?= $datos_fiscales['id'] ?? '' ?>" id="input_hidden_datos_fiscales_id">
                                                                <input type="hidden" value="<?= $datos_fiscales['url_logo'] ?? '' ?>" id="input_hidden_logo_anterior">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class=" form-label">Tipo del documento</label>
                                                                <select class="form-select mb-2" name="select_tipo_de_documento" id="select_tipo_de_documento_<?= $datos_fiscales['id'] ?? '' ?>" onchange="validar_documento('<?= $datos_fiscales['id'] ?? '' ?>')">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="cif" data-select2-id="select2-data-135-ttuo" <?= isset($datos_fiscales['document_type']) && $datos_fiscales['document_type'] == 'cif' ? 'selected' : '' ?>>CIF</option>
                                                                    <option value="dni" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['document_type']) && $datos_fiscales['document_type'] == 'dni' ? 'selected' : '' ?>>DNI</option>
                                                                    <option value="nie" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['document_type']) && $datos_fiscales['document_type'] == 'nie' ? 'selected' : '' ?>>NIE</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Nº Documento</label>
                                                                <input type="text" name="documento_id" id="documento_id_<?= $datos_fiscales['id'] ?? '' ?>" class="form-control mb-2" placeholder="Documento" onkeyup="validar_documento('<?= $datos_fiscales['id'] ?? '' ?>')" value="<?= $datos_fiscales['document_id'] ?? '' ?>">
                                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card card-flush py-4">
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h4>Mas datos</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body pt-0">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" name="email" id="email_modificar" class="form-control mb-2" placeholder="Correo electónico" value="<?= $datos_fiscales['email'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Teléfono fijo</label>
                                                                <input type="text" name="telefono_fijo" id="telefono_fijo_modificar" class="form-control mb-2" placeholder="Teléfono fijo" value="<?= $datos_fiscales['fix_phone'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Teléfono movil</label>
                                                                <input type="text" name="telefono_movil" id="telefono_movil_modificar" class="form-control mb-2" placeholder="Teléfono movil" value="<?= $datos_fiscales['movil_phone'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Tipo de via</label>
                                                                <select class="form-select mb-2" name="select_tipo_de_via" id="select_tipo_de_via_modificar">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="calle" data-select2-id="select2-data-135-ttuo" <?= isset($datos_fiscales['direccion_principal']['tipo_via']) && $datos_fiscales['direccion_principal']['tipo_via'] == 'calle' ? 'selected' : '' ?>>Calle</option>
                                                                    <option value="via" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['direccion_principal']['tipo_via']) && $datos_fiscales['direccion_principal']['tipo_via'] == 'via' ? 'selected' : '' ?>>Via</option>
                                                                    <option value="avenida" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['direccion_principal']['tipo_via']) && $datos_fiscales['direccion_principal']['tipo_via'] == 'avenida' ? 'selected' : '' ?>>Avenida</option>
                                                                    <option value="plaza" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['direccion_principal']['tipo_via']) && $datos_fiscales['direccion_principal']['tipo_via'] == 'plaza' ? 'selected' : '' ?>>Plaza</option>
                                                                    <option value="camino" data-select2-id="select2-data-136-g08t" <?= isset($datos_fiscales['direccion_principal']['tipo_via']) && $datos_fiscales['direccion_principal']['tipo_via'] == 'camino' ? 'selected' : '' ?>>Camino</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Dirección</label>
                                                                <input type="text" name="direccion" id="direccion_modificar" class="form-control mb-2" placeholder="Dirección" value="<?= $datos_fiscales['direccion_principal']['direccion'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Número</label>
                                                                <input type="text" name="numero" id="numero_modificar" class="form-control mb-2" placeholder="Número" value="<?= $datos_fiscales['direccion_principal']['numero'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Piso</label>
                                                                <input type="text" name="piso" id="piso_modificar" class="form-control mb-2" placeholder="Piso" value="<?= $datos_fiscales['direccion_principal']['piso'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Puerta</label>
                                                                <input type="text" name="puerta" id="puerta_modificar" class="form-control mb-2" placeholder="Puerta" value="<?= $datos_fiscales['direccion_principal']['puerta'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Código postal</label>
                                                                <input type="text" name="codigo_postal" id="codigo_postal_modificar" class="form-control mb-2" placeholder="Código postal" value="<?= $datos_fiscales['direccion_principal']['cp'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Municipio</label>
                                                                <input type="text" name="municipio" id="municipio_modificar" class="form-control mb-2" placeholder="Municipio" value="<?= $datos_fiscales['direccion_principal']['municipio'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Ciudad</label>
                                                                <input type="text" name="ciudad" id="ciudad_modificar" class="form-control mb-2" placeholder="Ciudad" value="<?= $datos_fiscales['direccion_principal']['ciudad'] ?? '' ?>">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">País</label>
                                                                <input type="text" name="pais" id="pais_modificar" class="form-control mb-2" placeholder="País" value="<?= $datos_fiscales['direccion_principal']['pais'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <a href="?pagina=datos_fiscales" class="btn btn-danger me-5" id="btn_cancelar_datos_fiscales_">Cancelar</a>
                                    <button type="button" id="btn_modificar_datos_fiscales" datos_fiscales_id="<?= $datos_fiscales['id'] ?? '' ?>" class="btn btn-primary btn-sm">
                                        <span class="indicator-label">Guardar datos</span>
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
        <!--################ FIN MODAL NUEVOS DATOS FISCALES ########################-->
        <!--#########################################################################-->

        <!--#########################################################################-->
        <!--############## INICIO MODAL NUEVA DIRECCION FISCAL ######################-->

        <div class="modal modal-lg fade" tabindex="-1" id="modal_nueva_direccion_fiscal_<?= $datos_fiscales['id'] ?? '' ?>">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content shadow-none">

                    <div class="modal-body pt-5">
                        <form id="form_datos_nueva_direccion" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="kt__nueva_direccionl_<?= $datos_fiscales['id'] ?? '' ?>" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <div class="card card-flush py-4">
                                                <div class="modal-header">
                                                    <h3 class="modal-title">Crear nueva dirección</h3>
                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                    </div>
                                                </div>
                                                <div class="card-body ">
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Tipo de via</label>
                                                                <select class="form-select mb-2" name="select_tipo_de_via" id="select_tipo_de_via_nueva_direccion">
                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                    <option value="calle" data-select2-id="select2-data-135-ttuo">Calle</option>
                                                                    <option value="via" data-select2-id="select2-data-136-g08t">Via</option>
                                                                    <option value="avenida" data-select2-id="select2-data-136-g08t">Avenida</option>
                                                                    <option value="plaza" data-select2-id="select2-data-136-g08t">Plaza</option>
                                                                    <option value="camino" data-select2-id="select2-data-136-g08t">Camino</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Dirección</label>
                                                                <input type="text" name="direccion" id="direccion_nueva_direccion" class="form-control mb-2" placeholder="Dirección">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Número</label>
                                                                <input type="text" name="numero" id="numero_nueva_direccion" class="form-control mb-2" placeholder="Número">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Piso</label>
                                                                <input type="text" name="piso" id="piso_nueva_direccion" class="form-control mb-2" placeholder="Piso">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Puerta</label>
                                                                <input type="text" name="puerta" id="puerta_nueva_direccion" class="form-control mb-2" placeholder="Puerta">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Código postal</label>
                                                                <input type="text" name="codigo_postal" id="codigo_postal_nueva_direccion" class="form-control mb-2" placeholder="Código postal">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                        <div class="row">
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Municipio</label>
                                                                <input type="text" name="municipio" id="municipio_nueva_direccion" class="form-control mb-2" placeholder="Municipio">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">Ciudad</label>
                                                                <input type="text" name="ciudad" id="ciudad_nueva_direccion" class="form-control mb-2" placeholder="Ciudad">
                                                            </div>
                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                <label class="form-label">País</label>
                                                                <input type="text" name="pais" id="pais_nueva_direccion" class="form-control mb-2" placeholder="País">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="button" id="btn_guardar_nueva_direccion_fiscal" class="btn btn-success btn-sm" datos_fiscales_id="<?= $datos_fiscales['id'] ?? '' ?>">
                                        <span class="indicator-label">Guardar datos</span>
                                        <span class="indicator-progress">Porfavor espere...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--############### FIN MODAL NUEVA DIRECCION FISCAL ########################-->
        <!--#########################################################################-->

    <?php else : ?>
        <form id="form_datos_fiscales" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">
            <div class="d-flex flex-column gap-7 gap-lg-10 w-100 w-lg-300px mb-7 me-lg-10" data-select2-id="select2-data-132-q7ev">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Logo de la empresa</h2>
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
                                <input type="file" name="avatar" accept=".png, .jpg, .jpeg">
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
                                        <h2>Nuevos datos fiscales</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0">
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Razón social</label>
                                                <input type="text" name="razon_social" id="razon_social" class="form-control mb-2" placeholder="Razón social" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Tipo del documento</label>
                                                <select class="form-select mb-2" name="select_tipo_de_documento" id="select_tipo_de_documento" required onchange="validar_documento()">
                                                    <option value="" selected="selected">Seleccionar</option>
                                                    <option value="cif" data-select2-id="select2-data-135-ttuo">CIF</option>
                                                    <option value="dni" data-select2-id="select2-data-136-g08t">DNI</option>
                                                    <option value="nie" data-select2-id="select2-data-136-g08t">NIE</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Nº Documento</label>
                                                <input type="text" name="documento_id" id="documento_id" class="form-control mb-2" placeholder="Documento" required onkeyup="validar_documento()">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                        </div>
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
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Email</label>
                                                <input type="email" name="email" id="email" class="form-control mb-2" placeholder="Correo electónico" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Teléfono fijo</label>
                                                <input type="text" name="telefono_fijo" id="telefono_fijo" class="form-control mb-2" placeholder="Teléfono fijo" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Teléfono movil</label>
                                                <input type="text" name="telefono_movil" id="telefono_movil" class="form-control mb-2" placeholder="Teléfono movil" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Tipo de via</label>
                                                <select class="form-select mb-2" name="select_tipo_de_via" id="select_tipo_de_via" required>
                                                    <option value="" selected="selected">Seleccionar</option>
                                                    <option value="calle" data-select2-id="select2-data-135-ttuo">Calle</option>
                                                    <option value="via" data-select2-id="select2-data-136-g08t">Via</option>
                                                    <option value="avenida" data-select2-id="select2-data-136-g08t">Avenida</option>
                                                    <option value="plaza" data-select2-id="select2-data-136-g08t">Plaza</option>
                                                    <option value="camino" data-select2-id="select2-data-136-g08t">Camino</option>
                                                </select>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Dirección</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control mb-2" placeholder="Dirección" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Número</label>
                                                <input type="text" name="numero" id="numero" class="form-control mb-2" placeholder="Número" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Piso</label>
                                                <input type="text" name="piso" id="piso" class="form-control mb-2" placeholder="Piso" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Puerta</label>
                                                <input type="text" name="puerta" id="puerta" class="form-control mb-2" placeholder="Puerta" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Código postal</label>
                                                <input type="text" name="codigo_postal" id="codigo_postal" class="form-control mb-2" placeholder="Código postal" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                        <div class="row">
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Municipio</label>
                                                <input type="text" name="municipio" id="municipio" class="form-control mb-2" placeholder="Municipio" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">Ciudad</label>
                                                <input type="text" name="ciudad" id="ciudad" class="form-control mb-2" placeholder="Ciudad" required>
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                <label class="required form-label">País</label>
                                                <input type="text" name="pais" id="pais" class="form-control mb-2" placeholder="País" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <a href="?pagina=datos_fiscales" class="btn btn-danger me-5" id="btn_cancelar_datos_fiscales">Cancelar</a>
                    <button type="button" id="btn_crear_datos_fiscales" class="btn btn-primary btn-sm">
                        <span class="indicator-label">Guardar datos</span>
                        <span class="indicator-progress">Porfavor espere...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
        </form>
</div>



<?php endif ?>