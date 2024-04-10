<!--begin::User account menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <div class="menu-content d-flex align-items-center px-3">
            <!--begin::Avatar-->
            <div class="symbol symbol-50px me-5">
                <img alt="Logo" src="assets/media/custom_img/avt_1.jpg" />
            </div>
            <!--end::Avatar-->
            <!--begin::Username-->
            <div class="d-flex flex-column">
                <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">ADMIN</span>
                <?php if (isset($_SESSION['info_admin']) && $_SESSION['info_admin']['admin_email'] != '' && $_SESSION['info_admin']['admin_nombre'] != '') : ?>
                    <div class="fw-bold d-flex align-items-center fs-5">
                        <?php echo $_SESSION['info_admin']['admin_nombre'] ?>
                    </div>
                    <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                        <?php echo $_SESSION['info_admin']['admin_email'] ?>
                    </a>
                <?php endif ?>
            </div>
            <!--end::Username-->
        </div>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="/admin?pagina=admin_perfil" class="menu-link px-5">
            Mi perfil
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu separator-->
    <div class="separator my-2"></div>
    <!--end::Menu separator-->


    <!--begin::Menu item-->
    <div class="menu-item px-5 my-1">
        <a href="/admin" class="menu-link px-5">
            Portada
        </a>
    </div>
    <!--end::Menu item-->
    <!--begin::Menu item-->
    <div class="menu-item px-5">
        <a href="?pagina=admin_logout" class="menu-link px-5">
            Salir
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::User account menu-->