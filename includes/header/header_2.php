<?php
include 'config/config.php';
include 'includes/funciones/funciones_varias.php';
//session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$user_info = $_SESSION['info_user'] ?? [];
//echo '<pre>'; print_r($user_info); echo '</pre>';exit();

$email_error = false;
$mensaje_enviar_email = '';

if (isset($_POST['enviar_email'])) {
    if (ES_DEBUG == 1) {
        $email_error = true;
        $mensaje_enviar_email = 'No se puede enviar el email desde local';
    } else {
        // Validar que los campos obligatorios estén completos
        $name = $_POST["name"] ?? '';
        $phone = $_POST["phone"] ?? '';
        $email = $_POST["email"] ?? '';
        $message = $_POST["message"] ?? '';
        $asunto = $_POST["asunto"] ?? '';
        $fecha_desde = $_POST["fecha_desde"] ?? '';
        $fecha_hasta = $_POST["fecha_hasta"] ?? '';

        if ($fecha_desde != '') $fecha_desde = $fecha_desde . ' 00:00:00';
        if ($fecha_hasta != '') $fecha_hasta = $fecha_hasta . ' 23:59:59';

        $HTML = '';

        if (empty($name) || empty($phone) || empty($email) || empty($message) || empty($asunto)) {
            $mensaje_enviar_email = "¡Por favor completa todos los campos!";
            $email_error = true;
        } else {
            $HTML = <<<EOD
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de llamada</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Solicitud de llamada</h2>
        <p><strong>Nombre:</strong> $name</p>
        <p><strong>Teléfono:</strong> $phone</p>
        <p><strong>Correo electrónico:</strong> $email</p>
        <p><strong>Mensaje:</strong><br> $message</p>
        <p><strong>Fechas:</strong><br>Desde: $fecha_desde<br>Hasta: $fecha_hasta</p>
    </div>
</body>
</html>
EOD;

            // Configuración para el correo
            $to = "info@escapade.com";
            $subject = $asunto;

            // Configuración de PHPMailer
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = 'secret';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Destinatarios y contenido del correo
            $mail->setFrom($email);
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->isHTML(true);
            $mail->Body = $HTML;

            try {
                // Envío del correo
                $mail->send();
                $mensaje_enviar_email = "¡Correo enviado con éxito!";
                $email_error = false;
            } catch (Exception $e) {
                $mensaje_enviar_email = "Error al enviar el correo. Por favor, inténtalo nuevamente. Detalles: {$mail->ErrorInfo}";
                $email_error = true;
            }
        }
    }
}




?>


<!DOCTYPE html>
<html lang="es">

<head>
    <!-- basic -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>TM-ESCAPADE</title>
    <meta name="description" content="Descubre una experiencia única con nuestros servicios de lujo en TM-ESCAPADAS. Desde paquetes exclusivos hasta destinos elegantes, te ofrecemos aventuras curadas, rutas premium y escapadas sofisticadas.">
    <!-- Keywords (if applicable) -->
    <meta name="keywords" content="viajes de lujo, TM-ESCAPADAS, paquetes exclusivos, destinos elegantes, aventuras curadas, rutas premium, escapadas sofisticadas,viajes marrakech,marrakech,marruecos,viajes africa">
    <!-- Author -->
    <meta name="author" content="TM-ESCAPADAS">
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="../../assets/images/custom_img/m_1.jpg" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="assets/css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
    <!-- owl stylesheets -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/tm_escapade.css">
</head>

<body>
    <!-- header section start -->
    <div class="header_section" id="header_section_escritorio" style="background-image: <?= isset($header_background) && $header_background != '' && file_exists($header_background) ? 'url(' . $header_background . ')' : 'url(../../assets/images/custom_img/m_5.jpg)' ?>;">
        <div class="header_main">
            <div class="mobile_menu">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="logo_mobile">
                        <a href="/">
                            <!--<img src="../../assets/images/logo.png" class="img_logo_portada" id="img_logo_movil_portada">-->
                            <h1 style="color: #fff;" class="h1_logo_portada" id="h1_logo_movil_portada">TM-ESCAPADE</h1>
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="/">Portada</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/sobre_nosotros">Sobre nosotros</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/tours_y_circuitos">Tours y circuitos </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/para_empresas">Para empresas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="/tienda">Tienda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="/contacto">Contacta-nos</a>
                            </li>
                            <li>
                                <?php if (!isset($_SESSION['info_user']) || empty($_SESSION['info_user'])) : ?>
                                    <div class="contenedor_img_avatar">
                                        <a href="/login"></a>
                                    </div>
                                <?php endif ?>
                            </li>
                            <li>
                                <?php if (!isset($_SESSION['info_user']) || empty($_SESSION['info_user'])) : ?>
                                    <div class="contenedor_img_avatar">
                                        <a href="/login"></a>
                                    </div>
                                <?php endif ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="container-fluid">
                <div class="logo">
                    <a href="/">
                        <!--<img src="../../assets/images/logo.png" class="img_logo_portada" id="img_logo_escritorio_portada">-->
                        <h1 style="color: #fff;" class="h1_logo_portada" id="h1_logo_escritorio_portada">TM-ESCAPADE</h1>
                    </a>
                </div>
                <div class="menu_main">
                    <ul>
                        <li class="active"><a href="/">Portada</a></li>
                        <li><a href="/sobre_nosotros">Sobre nosotros</a></li>
                        <li><a href="/tours_y_circuitos">Tours y circuitos</a></li>
                        <li><a href="/para_empresas">Para empresas</a></li>
                        <li><a href="/tienda">Tienda</a></li>
                        <li><a href="/contacto">Contacta-nos</a></li>
                        <li>
                            <?php if (isset($user_info['email']) && $user_info['email'] != '') : ?>
                                <div class="contenedor_img_carrito" onclick="ir_a_login()"></div>
                            <?php endif ?>
                        </li>
                        <li>
                            <?php
                            if (!isset($user_info['email']) || $user_info['email'] == '') :  ?>
                                <div class="contenedor_img_avatar" onclick="ir_a_login()"></div>
                            <?php else : ?>
                                <div class="contenedor_img_avatar" onclick="mostrar_menu()">
                                    <div class="contenedor_menu_avatar" id="contenedor_menu_avatar">
                                        <div class="row" style="padding: 15px">
                                            <div class="col-2">
                                                <div class="contenedor_img_avatar"></div>
                                            </div>
                                            <div class="col-10" style="text-align: start;margin-top:-5px">
                                                <span style="color: #837f7f;font-size:14px"><b><?= $user_info['email'] ?? '' ?></b></span>
                                            </div>
                                        </div>
                                        <div class="divider_horizontal"></div>
                                        <!-- Menú -->
                                        <ul class="menu_user_avatar">
                                            <li class="menu_li_custom"><a class="custom_menu_avatar_a" href="/mi_perfil">Mi perfil</a></li>
                                            <li class="menu_li_custom"><a class="custom_menu_avatar_a" href="/mis_favoritos">Mis favoritos</a></li>
                                            <li class="menu_li_custom"><a class="custom_menu_avatar_a" href="/logout">Salir</a></li>
                                        </ul>
                                    </div>
                                </div>
                            <?php endif ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- header section end -->