<?php
include '../config/config.php';
include '../includes/funciones/funciones_varias.php';

error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();

// Inicializa la variable de sesión info_admin si no está definida
$_SESSION['info_admin'] = $_SESSION['info_admin'] ?? array();


$admin_id = $_SESSION['info_admin']['admin_id'] ?? '';
$admin_email = $_SESSION['info_admin']['admin_email'] ?? '';
$admin_name = $_SESSION['info_admin']['admin_nombre'] ?? '';
$admin_direccion = $_SESSION['info_admin']['data_profile']['direccion'] ?? '';
$admin_tel_principal = $_SESSION['info_admin']['data_profile']['tel_principal'] ?? '';

// Verifica si los datos de sesión son válidos
if (!is_numeric($admin_id) || $admin_email == '' || $admin_name == '') {
    header('Location: /admin_login');
    exit(); // Asegúrate de salir después de una redirección
}

$info_banners = bn_obtener_banners();
$info_elementos = bn_obtener_elementos();
$info_servicios_circuitos = bn_obtener_servicios_circuitos();
$datos_fiscales = bn_obtener_datos_fiscales();
$administradores = bn_obtener_administradores();
$array_proveedores = bn_obtener_proveedores();

?>

<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic
Product Version: 8.2.2
Purchase: ''
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
<!--begin::Head-->

<head>
    <base href="" />
    <title>TM-ESCAPADE-ADMIN</title>
    <meta charset="utf-8" />
    <meta name="description" content="
            The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo,
            Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions.
            Grab your copy now and get life-time updates for free.
        " />
    <meta name="keywords" content="
            metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js,
            Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates,
            free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button,
            bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon
        " />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Metronic - The World's #1 Selling Bootstrap Admin Template by KeenThemes" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_app_body" data-kt-app-page-loading-enabled="true" data-kt-app-page-loading="on" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-toolbar-fixed="true" data-kt-app-toolbar-fixed-mobile="true" data-kt-app-footer-fixed="true" data-kt-app-footer-fixed-mobile="true" class="app-default">
    <?php include 'partials/theme-mode/_init.php' ?>
    <?php include 'layout/partials/_page-loader.php' ?>
    <?php include 'layout/_default.php' ?>
    <?php include 'partials/_scrolltop.php' ?>
    <!--begin::Modals-->
    <?php include 'partials/modals/_upgrade-plan.php' ?>
    <?php include 'partials/modals/_view-users.php' ?>
    <?php include 'partials/modals/users-search/_main.php' ?>
    <?php include 'partials/modals/_invite-friends.php' ?>
    <!--end::Modals-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/js/my_scripts/jquery.magnific-popup.min.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/new-target.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
    <script src="assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    <script src="assets/js/my_scripts/validar_dni_cif_nie.js"></script>
    <script src="assets/js/my_scripts/funciones_datos_fiscales.js"></script>
    <script src="assets/js/my_scripts/funciones_usuarios.js"></script>
    <script src="assets/js/my_scripts/funciones_elementos_web.js"></script>
    <script src="assets/js/my_scripts/funciones_servicios_1.js"></script>
    <script src="assets/js/my_scripts/gestionar_inlcuidos_no_incluidos.js"></script>
    <script src="assets/js/my_scripts/funciones_complementos.js"></script>
    <script src="assets/js/my_scripts/funciones_admin.js"></script>
    <script src="assets/js/my_scripts/funciones_calendario.js"></script>
    <script src="assets/js/my_scripts/funciones_banner.js"></script>
    <script src="assets/js/my_scripts/funciones_proveedor.js"></script>




    <!--end::Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>