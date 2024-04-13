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
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_nuevo_proveedor">
                            Crear nuevo proveedor
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_customers_table_wrapper_proveedor" class="dataTables_wrapper dt-bootstrap4 no-footer">

                <?php if (isset($array_proveedores) && count($array_proveedores) > 0) : ?>

                    <?php foreach ($array_proveedores as $proveedor) : ?>

                        <div class="modal modal-lg fade" tabindex="-1" id="modal_editar_proveedor_<?= $proveedor['id'] ?? '' ?>">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content shadow-none">

                                    <div class="modal-body" style="padding: 15px !important;">
                                        <form id="form_editar_proveedor_<?= $proveedor['id'] ?? '' ?>" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <div class="tab-content">
                                                    <div class="tab-pane fade active show" id="kt_admin_editar_proveedor_<?= $proveedor['id'] ?? '' ?>" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <div class="card card-flush py-4">
                                                                <div class="modal-header">
                                                                    <h3 class="modal-title">Editar datos del proveedor</h3>
                                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body pt-5">
                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Razón social</label>
                                                                                <input type="text" value="<?= $proveedor['proveedor_nombre'] ?? '' ?>" name="razon_social" id="razon_social_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Razón social">
                                                                                <input type="hidden" proveedor_id="<?= $proveedor['id'] ?? '' ?>" id="input_hidden_proveedor_<?= $proveedor['id'] ?? '' ?>">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Tipo del documento</label>
                                                                                <select class="form-select mb-2" name="select_tipo_de_documento" id="select_tipo_de_documento_modificar_<?= $proveedor['id'] ?? '' ?>" onchange="validar_documento()">
                                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                                    <option value="cif" data-select2-id="select2-data-135-ttuo" <?= isset($proveedor['tipo_documento']) && $proveedor['tipo_documento'] == 'cif' ? 'selected' : '' ?>>CIF</option>
                                                                                    <option value="dni" data-select2-id="select2-data-136-g08t" <?= isset($proveedor['tipo_documento']) && $proveedor['tipo_documento'] == 'dni' ? 'selected' : '' ?>>DNI</option>
                                                                                    <option value="nie" data-select2-id="select2-data-136-g08t" <?= isset($proveedor['tipo_documento']) && $proveedor['tipo_documento'] == 'nie' ? 'selected' : '' ?>>NIE</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Nº Documento</label>
                                                                                <input type="text" value="<?= $proveedor['documento'] ?? '' ?>" name="documento_id" id="documento_id_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Documento" onkeyup="validar_documento()">
                                                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-6 col-md-6 col-sm-12">
                                                                                <label class="form-label">Correo electónico</label>
                                                                                <input type="email" value="<?= $proveedor['email'] ?? '' ?>" name="email" id="proveedor_email_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Email">
                                                                            </div>
                                                                            <div class="col-xl-6 col-md-6 col-sm-12">
                                                                                <label class="form-label">Teléfono</label>
                                                                                <input type="text" value="<?= $proveedor['telefono'] ?? '' ?>" name="telefono" id="proveedor_telefono_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Teléfono">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Tipo de via</label>
                                                                                <select class="form-select mb-2" name="select_tipo_de_via" id="select_tipo_de_via_modificar_<?= $proveedor['id'] ?? '' ?>">
                                                                                    <option value="" selected="selected">Seleccionar</option>
                                                                                    <option value="calle" <?= isset($proveedor['tipo_via']) && $proveedor['tipo_via'] == 'calle' ? 'selected' : '' ?>>Calle</option>
                                                                                    <option value="via" <?= isset($proveedor['tipo_via']) && $proveedor['tipo_via'] == 'via' ? 'selected' : '' ?>>Via</option>
                                                                                    <option value="avenida" <?= isset($proveedor['tipo_via']) && $proveedor['tipo_via'] == 'avenida' ? 'selected' : '' ?>>Avenida</option>
                                                                                    <option value="plaza" <?= isset($proveedor['tipo_via']) && $proveedor['tipo_via'] == 'plaza' ? 'selected' : '' ?>>Plaza</option>
                                                                                    <option value="camino" <?= isset($proveedor['tipo_via']) && $proveedor['tipo_via'] == 'camino' ? 'selected' : '' ?>>Camino</option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Dirección</label>
                                                                                <input type="text" value="<?= $proveedor['direccion'] ?? '' ?>" name="direccion" id="proveedor_direccion_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Dirección" value="<?= $proveedor['direccion'] ?? '' ?>">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Número</label>
                                                                                <input type="text" value="<?= $proveedor['numero'] ?? '' ?>" name="numero" id="proveedor_numero_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Número" value="<?= $proveedor['numero'] ?? '' ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Piso</label>
                                                                                <input type="text" value="<?= $proveedor['piso'] ?? '' ?>" name="piso" id="proveedor_piso_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Piso" value="<?= $proveedor['piso'] ?? '' ?>">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Puerta</label>
                                                                                <input type="text" value="<?= $proveedor['puerta'] ?? '' ?>" name="puerta" id="proveedor_puerta_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Puerta" value="<?= $proveedor['puerta'] ?? '' ?>">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Código postal</label>
                                                                                <input type="text" value="<?= $proveedor['cp'] ?? '' ?>" name="codigo_postal" id="proveedor_codigo_postal_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Código postal" value="<?= $proveedor['cp'] ?? '' ?>">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-10 fv-row fv-plugins-icon-container">
                                                                        <div class="row">
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Municipio</label>
                                                                                <input type="text" value="<?= $proveedor['municipio'] ?? '' ?>" name="municipio" id="proveedor_municipio_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Municipio">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">Ciudad</label>
                                                                                <input type="text" value="<?= $proveedor['ciudad'] ?? '' ?>" name="ciudad" id="proveedor_ciudad_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="Ciudad">
                                                                            </div>
                                                                            <div class="col-xl-4 col-md-4 col-sm-12">
                                                                                <label class="form-label">País</label>
                                                                                <input type="text" value="<?= $proveedor['pais'] ?? '' ?>" name="pais" id="proveedor_pais_modificar_<?= $proveedor['id'] ?? '' ?>" class="form-control mb-2" placeholder="País">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button type="button" id="btn_editar_proveedor_<?= $proveedor['id'] ?? '' ?>" class="btn btn-primary btn-sm" onclick="modificar_info_proveedor('<?= $proveedor['id'] ?? '' ?>')">
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

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_proveedor_tabla">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="sorting">Proveedor</th>
                                    <th class="sorting">Documento</th>
                                    <th class="sorting">Email</th>
                                    <th class="sorting">Teléfono</th>
                                    <th class="sorting">Activo</th>
                                    <th class="text-end min-w-70px sorting_disabled">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($array_proveedores as $proveedor) : ?>

                                    <tr class="odd" id="tr_proveedor_<?= $proveedor['id'] ?? '' ?>">
                                        <td><?= $proveedor['proveedor_nombre'] ?? '' ?></td>
                                        <td><?= $proveedor['documento'] ?? '' ?></td>
                                        <td><?= $proveedor['email'] ?? '' ?></td>
                                        <td><?= $proveedor['telefono'] ?? '' ?></td>
                                        <td><?= isset($proveedor['active']) && $proveedor['active'] ?  'Si' : 'No' ?></td>
                                        <td class="text-end">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_proveedor_<?= $proveedor['id'] ?? '' ?>">
                                                <i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </a>
                                            <i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="eliminar_proveedor('<?= $proveedor['id'] ?>')">
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
                            <div class="alert alert-warning">Lista de proveedores vacia</div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>


<div class="modal modal-lg fade" tabindex="-1" id="modal_nuevo_proveedor">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-none">

            <div class="modal-body" style="padding: 15px !important;">
                <form id="form_crear_proveedor" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="kt_admin_nuevo_proveedor" role="tab-panel">
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <div class="card card-flush py-4">
                                        <div class="modal-header">
                                            <h3 class="modal-title">Datos del nuevo proveedor</h3>
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                            </div>
                                        </div>
                                        <div class="card-body pt-5">

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

                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <label class="required form-label">Correo electónico</label>
                                                        <input type="email" name="email" id="proveedor_email" class="form-control mb-2" placeholder="Email" required>
                                                    </div>
                                                    <div class="col-xl-6 col-md-6 col-sm-12">
                                                        <label class="required form-label">Teléfono</label>
                                                        <input type="text" name="telefono" id="proveedor_telefono" class="form-control mb-2" placeholder="Teléfono" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Tipo de via</label>
                                                        <select class="form-select mb-2" name="select_tipo_de_via" id="proveedor_select_tipo_de_via" required>
                                                            <option value="" selected="selected">Seleccionar</option>
                                                            <option value="calle">Calle</option>
                                                            <option value="via">Via</option>
                                                            <option value="avenida">Avenida</option>
                                                            <option value="plaza">Plaza</option>
                                                            <option value="camino">Camino</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Dirección</label>
                                                        <input type="text" name="direccion" id="proveedor_direccion" class="form-control mb-2" placeholder="Dirección" required>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Número</label>
                                                        <input type="text" name="numero" id="proveedor_numero" class="form-control mb-2" placeholder="Número" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Piso</label>
                                                        <input type="text" name="piso" id="proveedor_piso" class="form-control mb-2" placeholder="Piso">
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="form-label">Puerta</label>
                                                        <input type="text" name="puerta" id="proveedor_puerta" class="form-control mb-2" placeholder="Puerta">
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Código postal</label>
                                                        <input type="text" name="codigo_postal" id="proveedor_codigo_postal" class="form-control mb-2" placeholder="Código postal" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-10 fv-row fv-plugins-icon-container">
                                                <div class="row">
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Municipio</label>
                                                        <input type="text" name="municipio" id="proveedor_municipio" class="form-control mb-2" placeholder="Municipio" required>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">Ciudad</label>
                                                        <input type="text" name="ciudad" id="proveedor_ciudad" class="form-control mb-2" placeholder="Ciudad" required>
                                                    </div>
                                                    <div class="col-xl-4 col-md-4 col-sm-12">
                                                        <label class="required form-label">País</label>
                                                        <input type="text" name="pais" id="proveedor_pais" class="form-control mb-2" placeholder="País" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" id="btn_crear_nuevo_proveedor" class="btn btn-primary btn-sm">
                                <span class="indicator-label">Guardar</span>
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