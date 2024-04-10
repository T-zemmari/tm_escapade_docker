<?php
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 'portada';
$paginas_validas = [
    'portada',
    'admin_banners',
    'admin_home',
    'admin_login',
    'admin_logout',
    'admin_modulos',
    'admin_perfil',
    'admin_registro',
    'administradores',
    'calendario',
    'datos_fiscales',
    'elementos_web',
    'lista_categorias',
    'lista_productos',
    'tours_y_circuitos',
    'nuevo_circuito',
    'nuevo_producto',
    'proveedores',
    'usuarios',
    'medias',
    'suscripciones',
    'complementos',
    'gestionar_servicios_incluidos',  
];

if (!in_array($pagina, $paginas_validas)) {
    echo '<script>window.location.href="/admin"</script>';
    exit();
}

?>
<!--begin::App-->
<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
    <!--begin::Page-->
    <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">
        <?php include 'layout/partials/_header.php' ?>
        <!--begin::Wrapper-->
        <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">
            <?php include 'layout/partials/_sidebar.php' ?>
            <!--begin::Main-->
            <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                <!--begin::Content wrapper-->
                <div class="d-flex flex-column flex-column-fluid">
                    <?php if ($pagina == 'portada') {
                        include __DIR__ . '../../pages/admin_home.php';
                    } else if ($pagina != 'portada') {
                        include __DIR__ . '../../pages/' . $pagina . '.php';
                    }
                    ?>
                </div>
                <!--end::Content wrapper-->
                <?php include 'layout/partials/_footer.php' ?>
            </div>
            <!--end:::Main-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::App-->
<?php include 'partials/_drawers.php' ?>