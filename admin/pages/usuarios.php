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
				<?php if (isset($array_usuarios) && count($array_usuarios) > 0) : ?>

					<div class="table-responsive">
						<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
							<thead>
								<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
									<th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.8906px;">
										<div class="form-check form-check-sm form-check-custom form-check-solid me-3">
											<input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1">
										</div>
									</th>
									<th class="min-w-125px sorting">Nombre completo</th>
									<th class="min-w-125px sorting">Email</th>
									<th class="min-w-125px sorting">Role</th>
									<th class="sorting">Dirección</th>
									<th class="sorting">Teléfono</th>
									<th class="sorting" style="width: 120px;">Creado</th>
									<th class="sorting" style="width: 80px;">Activo</th>
									<th class="text-end min-w-70px sorting_disabled">Acciones</th>
								</tr>
							</thead>
							<tbody class="fw-semibold text-gray-600">
								<?php foreach ($array_usuarios as $usuario) : ?>

									<tr class="odd">
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="text-end"></td>
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