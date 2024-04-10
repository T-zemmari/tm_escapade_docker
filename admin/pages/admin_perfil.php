<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
	<!--begin::Content container-->
	<div id="kt_app_content_container" class="app-container container-xxl">
		<!--begin::Navbar-->
		<div class="card mb-5 mb-xl-10">
			<div class="card-body pt-9 pb-0">
				<!--begin::Details-->
				<div class="d-flex flex-wrap flex-sm-nowrap">
					<!--begin: Pic-->
					<div class="me-7 mb-4">
						<div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
							<img src="assets/media/custom_img/mr_1.jpg" alt="image" />
							<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
						</div>
					</div>
					<!--end::Pic-->
					<!--begin::Info-->
					<div class="flex-grow-1">
						<!--begin::Title-->
						<div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
							<!--begin::User-->
							<div class="d-flex flex-column">
								<!--begin::Name-->
								<div class="d-flex align-items-center mb-2">
									<a class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?= $admin_name ?? '' ?></a>
									<a>
										<i class="ki-duotone ki-verify fs-1 text-primary">
											<span class="path1"></span>
											<span class="path2"></span>
										</i>
									</a>
								</div>
								<!--end::Name-->
								<!--begin::Info-->
								<div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
									<a class="d-flex align-items-center text-gray-500 text-hover-primary me-5 mb-2">
										<i class="ki-duotone ki-profile-circle fs-4 me-1">
											<span class="path1"></span>
											<span class="path2"></span>
											<span class="path3"></span>
										</i>Admin</a>
									<a class="d-flex align-items-center text-gray-500 text-hover-primary mb-2">
										<i class="ki-duotone ki-sms fs-4">
											<span class="path1"></span>
											<span class="path2"></span>
										</i><?= $admin_email ?></a>
								</div>
								<!--end::Info-->
							</div>
							<!--end::User-->

						</div>
						<!--end::Title-->
						<!--begin::Stats-->
						<div class="d-flex flex-wrap flex-stack">
							<!--begin::Wrapper-->
							<div class="d-flex flex-column flex-grow-1 pe-8">
								<!--begin::Stats-->
								<div class="d-flex flex-wrap">

								</div>
								<!--end::Stats-->
							</div>
							<!--end::Wrapper-->
							<!--begin::Progress-->
							<div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
								<div class="d-flex justify-content-between w-100 mt-auto mb-2">
									<span class="fw-semibold fs-6 text-gray-500">Perfil completo</span>
									<span class="fw-bold fs-6">50%</span>
								</div>
								<div class="h-5px mx-3 w-100 bg-light mb-3">
									<div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
							</div>
							<!--end::Progress-->
						</div>
						<!--end::Stats-->
					</div>
					<!--end::Info-->
				</div>
				<!--end::Details-->
				<!--begin::Navs-->

				<!--begin::Navs-->
			</div>
		</div>
		<!--end::Navbar-->
		<!--begin::details View-->
		<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
			<!--begin::Card header-->
			<div class="card-header cursor-pointer">
				<!--begin::Card title-->
				<div class="card-title m-0">
					<h3 class="fw-bold m-0">Detalles del perfil</h3>
				</div>
				<!--end::Card title-->
				<!--begin::Action-->
				<!--<a href="account/settings.html" class="btn btn-sm btn-primary align-self-center" >Editar mi perfil</a>-->
				<!--end::Action-->
			</div>
			<!--begin::Card header-->
			<!--begin::Card body-->
			<div class="card-body p-9">
				<!--begin::Row-->
				<div class="row mb-7">
					<!--begin::Label-->
					<label class="col-lg-4 fw-semibold text-muted">Nombre completo</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<span class="fw-bold fs-6 text-gray-800"><?= $_SESSION['info_admin']['data_user']['name'] ?? '' ?><?= $_SESSION['info_admin']['data_user']['lastname'] ?? '' ?></span>
					</div>
					<!--end::Col-->
				</div>
				<!--end::Row-->
				<!--begin::Input group-->

				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-7">
					<!--begin::Label-->
					<label class="col-lg-4 fw-semibold text-muted">Telefono
						<span class="ms-1" data-bs-toggle="tooltip">
							<i class="ki-duotone ki-information fs-7">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span></label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 d-flex align-items-center">
						<span class="fw-bold fs-6 text-gray-800 me-2"><?= $admin_tel_principal ?? '' ?></span>
					</div>
					<!--end::Col-->
				</div>

				<div class="row mb-7">
					<!--begin::Label-->
					<label class="col-lg-4 fw-semibold text-muted">Dirección
						<span class="ms-1" data-bs-toggle="tooltip">
							<i class="ki-duotone ki-information fs-7">
								<span class="path1"></span>
								<span class="path2"></span>
								<span class="path3"></span>
							</i>
						</span></label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8 d-flex align-items-center">
						<span class="fw-bold fs-6 text-gray-800 me-2"><?= $admin_direccion ?? '' ?></span>
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->


				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-7">
					<!--begin::Label-->
					<label class="col-lg-4 fw-semibold text-muted">Comunicación</label>
					<!--end::Label-->
					<!--begin::Col-->
					<div class="col-lg-8">
						<span class="fw-bold fs-6 text-gray-800">Email, Teléfono</span>
					</div>
					<!--end::Col-->
				</div>
				<!--end::Input group-->
				<!--begin::Input group-->
				<div class="row mb-10">
					<!--begin::Label-->
					<label class="col-lg-4 fw-semibold text-muted">Permiso modificaciones</label>
					<!--begin::Label-->
					<!--begin::Label-->
					<div class="col-lg-8">
						<span class="fw-semibold fs-6 text-gray-800">Si</span>
					</div>
					<!--begin::Label-->
				</div>
				<!--end::Input group-->
				<!--begin::Notice-->
				<div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
					<!--begin::Icon-->
					<i class="ki-duotone ki-information fs-2tx text-warning me-4">
						<span class="path1"></span>
						<span class="path2"></span>
						<span class="path3"></span>
					</i>
					<!--end::Icon-->
					<!--begin::Wrapper-->
					<div class="d-flex flex-stack flex-grow-1">
						<!--begin::Content-->
						<div class="fw-semibold">
							<h4 class="text-gray-900 fw-bold">El usuario no es superadmin</h4>

						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Notice-->
			</div>
			<!--end::Card body-->
		</div>
		<!--end::details View-->
	</div>
	<!--end::Content container-->
</div>
<!--end::Content-->