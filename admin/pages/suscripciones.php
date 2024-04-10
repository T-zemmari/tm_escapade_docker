<div id="kt_app_content_container" class="app-container container-xxl">
    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar" id="input_filtrar_por_email" onkeyup="filtrar_suscripciones_por_email()">
                </div>
            </div>
            <div class="card-toolbar">

                <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                    <div class="fw-bold me-5">
                        <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                    </div>
                    <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
                </div>
            </div>
        </div>
        <div class="card-body pt-0">
            <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <?php
                $array_suscripciones = bt_obtener_info_suscripciones();
                ?>
                <?php if (isset($array_suscripciones) && count($array_suscripciones) > 0) : ?>

                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_suscriociones_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px sorting">Email</th>
                                    <th class="min-w-125px sorting">Suscrito desde</th>
                                    <th class="sorting_disabled" style="width: 100px;">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <?php foreach ($array_suscripciones as $info) : ?>

                                    <tr class="odd filtrar-por_email" email="<?= $info['email'] ?? '' ?>">
                                        <td><?= $info['email'] ?? '' ?></td>
                                        <td><?= explode(' ', $info['created_at'])[0] ?? '' ?></td>
                                        <td style="text-align: end;">
                                            <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                                <input class="form-check-input" onchange="desacticar_suscripcion_manualmente('<?= $info['id'] ?? '' ?>')" id="check_suscipcion_activa_<?= $info['id'] ?? '' ?>" type="checkbox" value="" <?= isset($info['activo']) && $info['activo'] == 1 ? 'checked' : '' ?>>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="row mt-5">
                        <div class="col-xl-12 col-md-12 col-sm-12">
                            <div class="alert alert-warning">Lista de usuario vacia</div>
                        </div>
                    </div>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>