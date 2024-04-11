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
				<?php if (isset($administradores) && count($administradores) > 0) : ?>
					<?php foreach ($administradores as $admin) : ?>
						<div class="modal modal-lg fade" tabindex="-1" id="modal_editar_perfil_admin_<?= $admin['profile_data']['id'] ?? '' ?>">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content shadow-none">

									<div class="modal-body" style="padding: 15px !important;">
										<form id="form_editar_perfil_admin_<?= $admin['profile_data']['id'] ?? '' ?>" class="form d-flex flex-column flex-lg-row fv-plugins-bootstrap5 fv-plugins-framework" enctype="multipart/form-data">

											<div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

												<div class="tab-content">
													<div class="tab-pane fade active show" id="kt_editar_perfil_admin_<?= $admin['profile_data']['id'] ?? '' ?>" role="tab-panel">
														<div class="d-flex flex-column gap-7 gap-lg-10">
															<div class="card card-flush py-4">
																<div class="modal-header">
																	<h3 class="modal-title">Editar perfil admin</h3>
																	<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
																		<i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
																	</div>
																</div>
																<div class="card-body pt-5">
																	<div class="mb-10 fv-row fv-plugins-icon-container">

																		<div class="row">
																			<div class="col-xl-6 col-md-6 col-sm-12">
																				<label class="form-label">Dirección</label>
																				<input type="text" name="direccion" id="direccion_modificar_<?= $admin['profile_data']['id'] ?? '' ?>" class="form-control mb-2" placeholder="Dirección" value="<?= $admin['profile_data']['direccion'] ?? '' ?>">
																			</div>
																			<div class="col-xl-6 col-md-6 col-sm-12">
																				<label class="form-label">Teléfono</label>
																				<input type="text" name="telefono" id="tel_modificar_<?= $admin['profile_data']['id'] ?? '' ?>" class="form-control mb-2" placeholder="Teléfono" value="<?= $admin['profile_data']['tel_principal'] ?? '' ?>">
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

												</div>
												<div class="d-flex justify-content-end">
													<input type="hidden" value="<?= $admin['id'] ?? '' ?>" id="input_hidden_admin_id_<?= $admin['profile_data']['id'] ?? '' ?>">
													<button type="button" id="btn_editar_admin_perfil_<?= $admin['profile_data']['id'] ?? '' ?>" class="btn btn-primary btn-sm" admin_id="<?= $admin['id'] ?? '' ?>" onclick="modificar_perfil_admin('<?= $admin['profile_data']['id'] ?? '' ?>')">
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
								<?php foreach ($administradores as $admin) : ?>

									<tr class="odd" id="tr_admin_<?= $admin['id'] ?? '' ?>">
										<td>
											<div class="form-check form-check-sm form-check-custom form-check-solid">
												<input class="form-check-input" type="checkbox" value="1" id="checkbox_admin_<?= $admin['id'] ?? '' ?>">
											</div>
										</td>
										<td>
											<?= $admin['name'] ?? '' ?> <?= $admin['lastname'] ?? '' ?>
										</td>
										<td>
											<?= $admin['email'] ?? '' ?>
										</td>
										<td>
											<?= isset($admin['info_admin']['roles']) ? join(',', json_decode($admin['info_admin']['roles'])) : '' ?>
										</td>
										<td>
											<?= $admin['profile_data']['direccion'] ?? '' ?>
										</td>
										<td>
											<?= $admin['profile_data']['tel_principal'] ?? '' ?>
										</td>
										<td>
											<?= explode(' ', $admin['created_at'])[0] ?? '' ?>
										</td>
										<td>
											<?= isset($admin['active']) && $admin['active'] == 1 ? 'Si' : 'No' ?>
										</td>
										<td class="text-end">
											<a href="#" data-bs-toggle="modal" data-bs-target="#modal_editar_perfil_admin_<?= $admin['profile_data']['id'] ?? '' ?>">
												<i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;">
													<span class="path1"></span>
													<span class="path2"></span>
												</i>
											</a>
											<i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="eliminar_admin_empresa('<?= $admin['id'] ?>')">
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
</div>