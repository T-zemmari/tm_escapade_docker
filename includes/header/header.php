<?php

include 'config/config.php';
include 'includes/funciones/funciones_varias.php';
session_start();

// $info_elementos=bn_obtener_elementos();
// echo '<pre>'; print_r($info_elementos); echo '</pre>';
// exit();

$host_name = $_SERVER['SERVER_NAME'] ?? '';

$user_info = $_SESSION['info_user'] ?? [];

$info_elementos_vista = info_elementos_vista();
$info_testimonios = info_testimonios();


/*###########################################################*/
/*##################### LOGO PAGINA #########################*/
/*###########################################################*/


$texto_logo_escritorio_portada = '';
$info_logo_escritorio_portada = $info_elementos_vista['h1_logo_escritorio_portada'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_logo_escritorio_portada != '') {
   if ($info_logo_escritorio_portada['activo'] == true && $info_logo_escritorio_portada['contenido'] != '') {
      $texto_logo_escritorio_portada = $info_logo_escritorio_portada['contenido'];
   }
}

$texto_logo_movil_portada = '';
$info_logo_movil_portada = $info_elementos_vista['h1_logo_escritorio_portada'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_logo_movil_portada != '') {
   if ($info_logo_movil_portada['activo'] == true && $info_logo_movil_portada['contenido'] != '') {
      $texto_logo_movil_portada = $info_logo_movil_portada['contenido'];
   }
}

/*###########################################################*/
/*################# CAROUSEL PORTADA ########################*/
/*###########################################################*/

$titulo_banner_1_escritorio_portada = '';
$info_titulo_banner_1_escritorio_portada = $info_elementos_vista['texto_banner_taital_1'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_titulo_banner_1_escritorio_portada != '') {
   if ($info_titulo_banner_1_escritorio_portada['activo'] == true && $info_titulo_banner_1_escritorio_portada['contenido'] != '') {
      $titulo_banner_1_escritorio_portada = $info_titulo_banner_1_escritorio_portada['contenido'];
   }
}

$titulo_banner_2_escritorio_portada = '';
$info_titulo_banner_2_escritorio_portada = $info_elementos_vista['texto_banner_taital_2'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_titulo_banner_2_escritorio_portada != '') {
   if ($info_titulo_banner_2_escritorio_portada['activo'] == true && $info_titulo_banner_2_escritorio_portada['contenido'] != '') {
      $titulo_banner_2_escritorio_portada = $info_titulo_banner_2_escritorio_portada['contenido'];
   }
}

$titulo_banner_3_escritorio_portada = '';
$info_titulo_banner_3_escritorio_portada = $info_elementos_vista['texto_banner_taital_3'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_titulo_banner_3_escritorio_portada != '') {
   if ($info_titulo_banner_3_escritorio_portada['activo'] == true && $info_titulo_banner_3_escritorio_portada['contenido'] != '') {
      $titulo_banner_3_escritorio_portada = $info_titulo_banner_3_escritorio_portada['contenido'];
   }
}


$desc_banner_1_escritorio_portada = '';
$info_banner_1_escritorio_portada = $info_elementos_vista['texto_banner_text_1'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_banner_1_escritorio_portada != '') {
   if ($info_banner_1_escritorio_portada['activo'] == true && $info_banner_1_escritorio_portada['contenido'] != '') {
      $desc_banner_1_escritorio_portada = $info_banner_1_escritorio_portada['contenido'];
   }
}

$desc_banner_2_escritorio_portada = '';
$info_banner_2_escritorio_portada = $info_elementos_vista['texto_banner_text_2'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_banner_2_escritorio_portada != '') {
   if ($info_banner_2_escritorio_portada['activo'] == true && $info_banner_2_escritorio_portada['contenido'] != '') {
      $desc_banner_2_escritorio_portada = $info_banner_2_escritorio_portada['contenido'];
   }
}
$desc_banner_3_escritorio_portada = '';
$info_banner_3_escritorio_portada = $info_elementos_vista['texto_banner_text_3'] ?? '';
// echo print_r($info_logo_escritorio_portada);exit();
if ($info_banner_3_escritorio_portada != '') {
   if ($info_banner_3_escritorio_portada['activo'] == true && $info_banner_3_escritorio_portada['contenido'] != '') {
      $desc_banner_3_escritorio_portada = $info_banner_3_escritorio_portada['contenido'];
   }
}



$texto_banner_taital_1 = '';
$info_texto_banner_taital_1 = $info_elementos_vista['titulo_servicios_portada'] ?? '';
if ($info_texto_banner_taital_1 != '') {
   if ($info_texto_banner_taital_1['activo'] == true && $info_texto_banner_taital_1['contenido'] != '') {
      $texto_banner_taital_1 = $info_texto_banner_taital_1['contenido'];
   }
}

$texto_descripion_taital_1 = '';
$info_descripcion_taital_1 = $info_elementos_vista['descripcion_servicios_1_portada'] ?? '';
if ($info_descripcion_taital_1 != '') {
   if ($info_descripcion_taital_1['activo'] == true && $info_descripcion_taital_1['contenido'] != '') {
      $texto_descripion_taital_1 = $info_descripcion_taital_1['contenido'];
   }
}


/*###########################################################*/
/*##################### SERVICIOS ###########################*/
/*###########################################################*/

$texto_titulo_servicio_1_portada = '';
$info_titulo_servicio_1_portada = $info_elementos_vista['titulo_primer_servicio_portada'] ?? '';
if ($info_titulo_servicio_1_portada != '') {
   if ($info_titulo_servicio_1_portada['activo'] == true && $info_titulo_servicio_1_portada['contenido'] != '') {
      $texto_titulo_servicio_1_portada = $info_titulo_servicio_1_portada['contenido'];
   }
}

$img_servicio_1_portada = '';
$info_img_servicio_1_portada = $info_elementos_vista['img_portada_servicio_1'] ?? '';
if ($info_img_servicio_1_portada != '') {
   if ($info_img_servicio_1_portada['activo'] == true && $info_img_servicio_1_portada['contenido'] != '') {
      $img_servicio_1_portada = $info_img_servicio_1_portada['contenido'];
   }
}

$texto_titulo_servicio_2_portada = '';
$info_titulo_servicio_2_portada = $info_elementos_vista['titulo_segundo_servicio_portada'] ?? '';
if ($info_titulo_servicio_2_portada != '') {
   if ($info_titulo_servicio_2_portada['activo'] == true && $info_titulo_servicio_2_portada['contenido'] != '') {
      $texto_titulo_servicio_2_portada = $info_titulo_servicio_2_portada['contenido'];
   }
}

$img_servicio_2_portada = '';
$info_img_servicio_2_portada = $info_elementos_vista['img_portada_servicio_2'] ?? '';
if ($info_img_servicio_2_portada != '') {
   if ($info_img_servicio_2_portada['activo'] == true && $info_img_servicio_2_portada['contenido'] != '') {
      $img_servicio_2_portada = $info_img_servicio_2_portada['contenido'];
   }
}

$texto_titulo_servicio_3_portada = '';
$info_titulo_servicio_3_portada = $info_elementos_vista['titulo_tercer_servicio_portada'] ?? '';
if ($info_titulo_servicio_3_portada != '') {
   if ($info_titulo_servicio_3_portada['activo'] == true && $info_titulo_servicio_3_portada['contenido'] != '') {
      $texto_titulo_servicio_3_portada = $info_titulo_servicio_3_portada['contenido'];
   }
}

$img_servicio_3_portada = '';
$info_img_servicio_3_portada = $info_elementos_vista['img_portada_servicio_3'] ?? '';
if ($info_img_servicio_2_portada != '') {
   if ($info_img_servicio_3_portada['activo'] == true && $info_img_servicio_2_portada['contenido'] != '') {
      $img_servicio_3_portada = $info_img_servicio_3_portada['contenido'];
   }
}


/*###########################################################*/
/*##################### SECCION INFO ########################*/
/*###########################################################*/

$titulo_experiencias_1_portada = '';
$info_titulo_experiencias_1_portada = $info_elementos_vista['titulo_experiencias_1'] ?? '';
if ($info_titulo_experiencias_1_portada != '') {
   if ($info_titulo_experiencias_1_portada['activo'] == true && $info_titulo_experiencias_1_portada['contenido'] != '') {
      $titulo_experiencias_1_portada = $info_titulo_experiencias_1_portada['contenido'];
   }
}

$primer_parrafo_experiencias_1_portada = '';
$info_primer_parrafo_experiencias_1_portada = $info_elementos_vista['texto_experiencia_parrafo_1'] ?? '';
if ($info_primer_parrafo_experiencias_1_portada != '') {
   if ($info_primer_parrafo_experiencias_1_portada['activo'] == true && $info_primer_parrafo_experiencias_1_portada['contenido'] != '') {
      $primer_parrafo_experiencias_1_portada = $info_primer_parrafo_experiencias_1_portada['contenido'];
   }
}
$segundo_parrafo_experiencias_1_portada = '';
$info_segundo_parrafo_experiencias_1_portada = $info_elementos_vista['texto_experiencia_parrafo_2'] ?? '';
if ($info_segundo_parrafo_experiencias_1_portada != '') {
   if ($info_segundo_parrafo_experiencias_1_portada['activo'] == true && $info_segundo_parrafo_experiencias_1_portada['contenido'] != '') {
      $segundo_parrafo_experiencias_1_portada = $info_segundo_parrafo_experiencias_1_portada['contenido'];
   }
}
$tercer_parrafo_experiencias_1_portada = '';
$info_tercer_parrafo_experiencias_1_portada = $info_elementos_vista['texto_lista_experiencias_portada'] ?? '';
if ($info_tercer_parrafo_experiencias_1_portada != '') {
   if ($info_tercer_parrafo_experiencias_1_portada['activo'] == true && $info_tercer_parrafo_experiencias_1_portada['contenido'] != '') {
      $tercer_parrafo_experiencias_1_portada = $info_tercer_parrafo_experiencias_1_portada['contenido'];
   }
}

$imagen_experiencias = '';
$info_imagen_experiencias = $info_elementos_vista['img_experiencias_portada_1'] ?? '';
if ($info_imagen_experiencias != '') {
   if ($info_imagen_experiencias['activo'] == true && $info_imagen_experiencias['contenido'] != '') {
      $imagen_experiencias = $info_imagen_experiencias['contenido'];
   }
}

$header_background = '';
$info_header_background = $info_elementos_vista['header_section_escritorio'] ?? '';
if ($info_header_background != '') {
   if ($info_header_background['activo'] == true && $info_header_background['contenido'] != '') {
      $header_background = str_replace('/admin', 'admin', $info_header_background['contenido']);
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
   <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
   <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">
   <!--<link rel="stylesheet" href="assets/css/owl.theme.default.min.css">-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   <link rel="stylesheet" href="assets/css/magnific_pop_up.css">
   <link rel="stylesheet" href="assets/css/animate.min.css">
   <link rel="stylesheet" href="assets/css/tm_escapade.css">
</head>

<body>
   <!-- header section start -->
   <div class="header_section" id="header_section_escritorio" style="background-image: <?= isset($header_background) && $header_background != '' && file_exists($header_background) ? 'url(' . $header_background . ')' : 'url(../../assets/images/custom_img/m_5.jpg)' ?>;">
      <div class="header_main">
         <div class="mobile_menu">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
               <div class="logo_mobile" id="div_portada_logo_movil">
                  <a href="/" style="font-size: 20px;color:#fff">
                     <!--<img src="../../assets/images/logo.png" class="img_logo_portada" id="img_logo_movil_portada">-->
                     <?php if ($texto_logo_movil_portada != '') : ?>
                        <?= $texto_logo_movil_portada ?>
                     <?php else : ?>
                        TM-ESCAPADE
                     <?php endif ?>
                     </h1>
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
                        <a class="nav-link" href="/tours_y_circuitos">Tours y circuitos</a>
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
                  </ul>
               </div>
            </nav>
         </div>
         <div class="container-fluid">
            <div class="logo" id="div_portada_logo_escritorio">
               <a href="/">
                  <!--<img src="../../assets/images/logo.png" class="img_logo_portada" id="img_logo_escritorio_portada">-->
                  <h1 style="color: #fff;" class="h1_logo_portada" id="h1_logo_escritorio_portada">
                     <?php if ($texto_logo_escritorio_portada != '') : ?>
                        <?= $texto_logo_escritorio_portada ?>
                     <?php else : ?>
                        TM-ESCAPADE
                     <?php endif ?>
                  </h1>
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
                        <div class="contenedor_img_carrito">
                        </div>
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