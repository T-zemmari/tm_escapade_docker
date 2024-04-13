<style>
	.td-contenedor-imagen-escritorio .imagen-escritorio-custom-style {
		width: 250px;
	}

	.td-contenedor-imagen-movil {
		position: relative;
	}

	.td-contenedor-imagen-escritorio {
		position: relative;
	}

	.td-contenedor-imagen-movil .imagen-movil-custom-style {
		width: 180px;

	}
</style>

<div id="kt_app_content_container" class="app-container">
	<!--begin::Card-->
	<div class="card">
		<!--begin::Card header-->
		<div class="card-header border-0 pt-6">
			<!--begin::Card title-->
			<div class="card-title">
				<!--begin::Search-->
				<div class="d-flex align-items-center position-relative my-1">
					<i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
						<span class="path1"></span>
						<span class="path2"></span>
					</i>
					<input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar">
				</div>
				<!--end::Search-->
			</div>
			<!--begin::Card title-->
			<!--begin::Card toolbar-->
			<div class="card-toolbar">
				<!--begin::Toolbar-->
				<div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
					<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_2">
						Añadir un banner
					</button>
				</div>
				<!--end::Toolbar-->

			</div>
			<!--end::Card toolbar-->
		</div>
		<!--end::Card header-->
		<!--begin::Card body-->
		<div class="card-body pt-0">
			<!--begin::Table-->
			<div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
				<div class="table-responsive">
					<table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer" id="kt_customers_table">
						<thead>
							<tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
								<th class="sorting" style="width: 200px">Banner escritorio</th>
								<th class="sorting" style="width: 150px">Banner movil</th>
								<th class="sorting" style="text-align: center;">Mas detalles</th>
								<th class="sorting" style="width: 80px;">Orden</th>
								<th class="sorting" style="width: 80px;">Estado</th>
								<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Acciones" style="width: 100px;text-align:center">Acciones</th>
							</tr>
						</thead>
						<tbody class="fw-semibold text-gray-600">
							<?php if (count($info_banners) > 0) :
								$contador = 1;
								foreach ($info_banners as $banner) :
							?>
									<tr class="odd" id="tr_banner_<?= $banner['id'] ?>">

										<td class="td-contenedor-imagen-escritorio" style="text-align:start;vertical-align:top">
											<a style="width:100%" class="image-popup-link" href="<?= $banner['url_escritorio'] ?>"><img style="width:100%" class="imagen-escritorio-custom-style" src="<?= $banner['url_escritorio'] ?>" alt="img_e<?= $contador++ ?>"></a>
										</td>

										<td class="td-contenedor-imagen-movil" style="text-align:start;vertical-align:top">
											<a style="width:100%" class="image-popup-link" href="<?= $banner['url_movil'] ?>"><img class="imagen-movil-custom-style" style="width:100%" src="<?= $banner['url_movil'] ?>" alt="img_m<?= $contador++ ?>"></a>
										</td>

										<td style="text-align:start;vertical-align:top">
											<div class="row">
												<!-- Fecha de inicio -->
												<div class="col-xl-6 col-md-12 col-sm-12 mb-7">
													<label class="required fs-6 fw-semibold mb-2">Fecha de inicio</label>
													<input type="date" value="<?= explode(' ', $banner['fecha_ini'])[0] ?? '' ?>" class="form-control form-control-solid" placeholder="" name="fecha_inicio" id="fecha_inicio_<?= $banner['id'] ?? '' ?>">
													<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
												</div>
												<!-- Fecha fin -->
												<div class="col-xl-6 col-md-12 col-sm-12 mb-7">
													<label class="required fs-6 fw-semibold mb-2">Fecha fin</label>
													<input type="date" value="<?= explode(' ', $banner['fecha_fin'])[0] ?? '' ?>" class="form-control form-control-solid" placeholder="" name="fecha_fin" id="fecha_fin_<?= $banner['id'] ?? '' ?>">
													<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
												</div>
											</div>

											<div class="row">

												<!-- Texto -->
												<div class="col-md-6 col-sm-12 mb-7">
													<label class="fs-6 fw-semibold mb-2">Texto</label>
													<input type="text" value="<?= $banner['texto'] ?? '' ?>" class="form-control form-control-solid" placeholder="Escribe el texto (opcional)" name="texto" id="texto">
													<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
												</div>
												<!-- Elementos Web -->
												<div class="col-md-6 col-sm-12 mb-7">
													<label class="fs-6 fw-semibold mb-2">Elementos Web</label>
													<select class="form-select form-select-solid" name="elementos_web" id="elementos_web">
														<option value="">Seleccionar elemento</option>
														<?php if (isset($info_elementos) && is_array($info_elementos) && count($info_elementos)) : ?>
															<?php foreach ($info_elementos as $elemento) :
																if ($elemento['es_banner'] == 0) continue; ?>
																<option value="<?= $elemento['id'] ?>" <?= $banner['ref_elemento_id'] == $elemento['id'] ? 'selected' : '' ?>><?= $elemento['titulo_elemento'] ?></option>
															<?php endforeach ?>
														<?php endif ?>
													</select>
													<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
												</div>
											</div>

										</td>

										<td style="text-align:start;vertical-align:top">
											<select class="form-select form-select-solid" name="select_orden" id="select_orden_<?= $banner['id'] ?>">
												<option value="">Seleccionar</option>
												<?php for ($i = 1; $i <= 3; $i++) : ?>
													<option value="<?= $i ?>" <?= $i == $banner['orden'] ? 'selected' : '' ?>><?= $i ?></option>
												<?php endfor ?>
											</select>
										</td>

										<td style="text-align:start;vertical-align:top">
											<div class="form-check form-switch form-check-custom form-check-success form-check-solid">
												<input class="form-check-input" onchange="modificar_estado_banner('<?= $banner['id'] ?? '' ?>','<?= $banner['ref_elemento_id'] ?? '' ?>')" id="check_activo_banner_<?php echo $banner['id'] ?? '' ?>" type="checkbox" value="" <?= isset($banner['activo']) && $banner['activo']  ? 'checked' : '' ?> />
											</div>
										</td>

										<td style="text-align:end;vertical-align:top;">
											<i class="ki-duotone ki-message-edit text-success fs-3x" style="cursor: pointer;" onclick="modificar_banner('<?= $banner['id'] ?>')">
												<span class="path1"></span>
												<span class="path2"></span>
											</i>
											<i class="ki-duotone ki-tablet-delete text-danger fs-3x" style="cursor: pointer;" onclick="fn_eliminar_banner('<?= $banner['id'] ?>')">
												<span class="path1"></span>
												<span class="path2"></span>
												<span class="path3"></span>
											</i>
										</td>
									</tr>
							<?php
								endforeach;
							endif ?>

						</tbody>
					</table>
				</div>

			</div>
			<!--end::Table-->
		</div>
		<!--end::Card body-->
	</div>
	<!--end::Card-->

	<div class="modal bg-body fade" tabindex="-1" id="kt_modal_2" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content shadow-none">
				<div class="modal-header">
					<h5 class="modal-title">Crear nuevo banner</h5>
					<div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
						<i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
					</div>
				</div>
				<div class="modal-body">
					<div class="container">
						<div class="row">
							<!-- Fecha de inicio -->
							<div class="col-md-3 mb-7">
								<label class="required fs-6 fw-semibold mb-2">Fecha de inicio</label>
								<input type="date" class="form-control form-control-solid" placeholder="" name="fecha_inicio" id="fecha_inicio">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
							<!-- Fecha fin -->
							<div class="col-md-3 mb-7">
								<label class="required fs-6 fw-semibold mb-2">Fecha fin</label>
								<input type="date" class="form-control form-control-solid" placeholder="" name="fecha_fin" id="fecha_fin">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
							<!-- Texto -->
							<div class="col-md-3 mb-7">
								<label class="fs-6 fw-semibold mb-2">Texto</label>
								<input type="text" class="form-control form-control-solid" placeholder="Escribe el texto (opcional)" name="texto" id="texto">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
							<!-- Elementos Web -->
							<div class="col-md-3 mb-7">
								<label class="fs-6 fw-semibold mb-2">Elementos Web</label>
								<select class="form-select form-select-solid" name="elementos_web" id="elementos_web">
									<option value="">Seleccionar elemento</option>
									<?php if (isset($info_elementos) && is_array($info_elementos) && count($info_elementos)) : ?>
										<?php foreach ($info_elementos as $elemento) :
											if ($elemento['es_banner'] == 0) continue; ?>
											<option value="<?= $elemento['id'] ?>"><?= $elemento['titulo_elemento'] ?></option>
										<?php endforeach ?>
									<?php endif ?>
								</select>
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>

						</div>

						<!-- División para subir banner de escritorio y movil-->
						<div class="row mb-7">
							<div class="col-md-6">
								<label class="required fs-6 fw-semibold mb-2">Banner para Escritorio</label>
								<input type="file" class="form-control form-control-solid" name="banner_escritorio" id="banner_escritorio">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
							<div class="col-md-6">
								<label class="fs-6 fw-semibold mb-2">Banner para Móvil</label>
								<input type="file" class="form-control form-control-solid" name="banner_movil" id="banner_movil">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
						</div>

						<div class="row mb-7">
							<div class="col-md-3 mb-7">
								<label class="required fs-6 fw-semibold mb-2">Orden</label>
								<select class="form-select form-select-solid" name="select_orden" id="select_orden">
									<!-- Opciones del select -->
									<option value="0">Seleccionar orden</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<!-- Puedes agregar más opciones según sea necesario -->
								</select>
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
							<div class="col-md-6 mb-7">
								<label class="fs-6 fw-semibold mb-2">Link</label>
								<input type="text" class="form-control form-control-solid" placeholder="Link del banner (opcional)" name="link" id="link">
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>

							<div class="col-md-3 mb-7">
								<label class="fs-6 fw-semibold mb-2">Mostrar Temporizador</label>
								<div class="form-check form-switch">
									<input class="form-check-input" type="checkbox" id="mostrar_temporizador" name="mostrar_temporizador">
									<label class="form-check-label" for="mostrar_temporizador">Activar Temporizador</label>
								</div>
								<div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Cerrar</button>
					<button type="button" class="btn btn-success btn-sm" onclick="guardar_banner()">Guardar banner</button>
				</div>
			</div>
		</div>
	</div>


</div>