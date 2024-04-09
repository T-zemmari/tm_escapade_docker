<?php
include 'includes/header/header.php';
?>

<style>
   .custom-elemento-1 {
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #bb5b16;
      color: #e1e1e1;
      height: 300px;
      margin-top: 100px;
      margin-bottom: 100px;
   }

   .custom-elemento-2 {
      display: flex;
      justify-content: center;
      align-items: center;
      background-image: url('assets/images/custom_img/sah_2.png');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      color: #e1e1e1;
      height: 300px;
      margin-top: 100px;
      margin-bottom: 100px;
   }

   .h1-descubre-marrakesh {
      font-size: 40px !important;
   }

   .readmore_bt {
      width: 250px;
   }

   .readmore_bt a.button-custom-a {
      align-items: center;
      background-color: #FFFFFF;
      border: 1px solid rgba(0, 0, 0, 0.1);
      border-radius: .25rem;
      box-shadow: rgba(0, 0, 0, 0.02) 0 1px 3px 0;
      box-sizing: border-box;
      color: rgba(0, 0, 0, 0.85);
      cursor: pointer;
      display: inline-flex;
      font-family: system-ui, -apple-system, system-ui, "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-size: 16px;
      font-weight: 600;
      justify-content: center;
      line-height: 1.25;
      margin: 0;
      min-height: 3rem;
      padding: calc(.875rem - 1px) calc(1.5rem - 1px);
      position: relative;
      text-decoration: none;
      transition: all 250ms;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
      vertical-align: baseline;
      width: 100%;
   }

   .readmore_bt a.button-custom-a:hover,
   .readmore_bt a.button-custom-a:focus {
      border-color: rgba(0, 0, 0, 0.15);
      box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
      color: rgba(0, 0, 0, 0.65);
   }

   .readmore_bt a.button-custom-a:hover {
      transform: translateY(-1px);
   }

   .readmore_bt a.button-custom-a:active {
      background-color: #F0F0F1;
      border-color: rgba(0, 0, 0, 0.15);
      box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
      color: rgba(0, 0, 0, 0.65);
      transform: translateY(0);
   }

   .container_fluid_video {
      padding-right: 34px !important;
      width: 100vw;
   }

   .newsletter_box {
      width: 100%;
      border: 1px solid #c5c5c5;
      border-radius: 25px;
      padding: 20px 30px;
      display: flex;
      margin-top: 90px !important;
      float: left;
   }

   .getquote_bt a {
      width: 100%;
      float: left;
      font-size: 16px;
      color: #000000;
      background-color: #ededed;
      text-align: center;
      padding: 10px 0px;
      border-radius: 6px;
      font-weight: bold;
   }


   @media(max-width:768px) {

      .custom-elemento-1,
      .custom-elemento-2 {
         margin-top: 20px !important;
         margin-bottom: 0px !important;
      }

      .h1-descubre-marrakesh {
         font-size: 30px !important;
      }

      .experiencias_imagen {
         padding-right: 18px !important;
      }

      .container_fluid_video {
         padding-right: 15px !important;
      }

      .services_text {
         padding: 20px !important;
         font-size: 14px !important;
      }

      .services_taital {
         font-size: 35px;
      }

      .readmore_bt {
         width: 100%;
      }

      .getquote_bt a {
         width: 100%;
         float: left;
         font-size: 13px;
         color: #000000;
         background-color: #ededed;
         text-align: center;
         padding: 10px 0px;
         border-radius: 6px;
         font-weight: bold;
      }

      .let_text {
         font-size: 17px;
         text-align: center;
      }


   }
</style>
<!-- banner section start -->
<div class="banner_section layout_padding animate__animated animate__backInDown">
   <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner" style="background-color: #0000006b;padding:10px">
         <div class="carousel-item active">
            <div class="container">
               <h1 class="banner_taital" id="texto_banner_taital_1">
                  <?php if ($titulo_banner_1_escritorio_portada != '') : ?>
                     <?= $titulo_banner_1_escritorio_portada ?>
                  <?php else : ?>
                     Marrakech
                  <?php endif ?>
               </h1>
               <p class="banner_text" id="texto_banner_text_1">
                  <?php if ($desc_banner_1_escritorio_portada != '') : ?>
                     <?= $desc_banner_1_escritorio_portada ?>
                  <?php else : ?>
                     Descubre la Magia de Marrakech: Tu Puerta a Experiencias Únicas y Aventuras Inolvidables
                  <?php endif ?>
               </p>
               <!--<div class="read_bt"><a href="#">Más info...</a></div>-->
            </div>
         </div>
         <div class="carousel-item">
            <div class="container">
               <h1 class="banner_taital" id="texto_banner_taital_3">
                  <?php if ($titulo_banner_3_escritorio_portada != '') : ?>
                     <?= $titulo_banner_3_escritorio_portada ?>
                  <?php else : ?>
                     Sahara
                  <?php endif ?>
               </h1>
               </h1>
               <p class="banner_text" id="texto_banner_text_3">
                  <?php if ($desc_banner_3_escritorio_portada != '') : ?>
                     <?= $desc_banner_3_escritorio_portada ?>
                  <?php else : ?>
                     Vive la Magia del Desierto: Descubre la Aventura Inolvidable del Sahara
                  <?php endif ?>
               </p>
               <!--<div class="read_bt"><a href="#">Más info..</a></div>-->
            </div>
         </div>
         <div class="carousel-item">
            <div class="container">
               <h1 class="banner_taital" id="texto_banner_taital_2">
                  <?php if ($titulo_banner_2_escritorio_portada != '') : ?>
                     <?= $titulo_banner_2_escritorio_portada ?>
                  <?php else : ?>
                     Marruecos
                  <?php endif ?>
               </h1>
               <p class="banner_text" id="texto_banner_text_2">
                  <?php if ($desc_banner_2_escritorio_portada != '') : ?>
                     <?= $desc_banner_2_escritorio_portada ?>
                  <?php else : ?>
                     Explora Marruecos: Sumérgete en la Belleza, Cultura y Misterio de un Destino Excepcional
                  <?php endif ?>
               </p>
               <!--<div class="read_bt"><a href="#">Más info...</a></div>-->
            </div>
         </div>

      </div>
   </div>
</div>
<!-- banner section end -->
</div>
<!-- header section end -->
<!-- services section start -->


<div class="services_section layout_padding" style="border-bottom:1px solid #e1e1e1;">
   <div class="container">
      <h1 class="services_taital" id="titulo_servicios_portada">
         <?php if ($texto_banner_taital_1 != '') : ?>
            <?= $texto_banner_taital_1 ?>
         <?php else : ?>
            Servicios
         <?php endif ?>
      </h1>
      <p class="services_text services_text" id="descripcion_servicios_1_portada">
         <?php if ($texto_descripion_taital_1 != '') : ?>
            <?= $texto_descripion_taital_1 ?>
         <?php else : ?>
            Descubre una experiencia única con nuestros servicios de lujo en "EliteViajes". Desde paquetes exclusivos hasta destinos elegantes, te ofrecemos aventuras curadas, rutas premium y escapadas sofisticadas. Nuestros tours exclusivos y travesías especiales te llevan a destinos distinguidos, brindándote experiencias elevadas y personalizadas. Con "EliteViajes", cada viaje se convierte en una aventura atemporal, donde la distinción y la elegancia se fusionan para ofrecerte lo mejor en viajes de lujo. ¡Explora la diferencia con "EliteViajes" y descubre la excelencia en cada servicio!</p>
   <?php endif ?>


   <div class="services_section_2">

      <div class="row">
         <div class="col-md-4">
            <div style="border-radius: 10px;">
               <?php if ($img_servicio_1_portada != '') : ?>
                  <img id="img_portada_servicio_1" src="<?= $img_servicio_1_portada ?>" class="services_img" style="border-radius: 10px;">
               <?php else : ?>
                  <img id="img_portada_servicio_1" src="assets/images/custom_img/m_7.jpg" class="services_img" style="border-radius: 10px;">
               <?php endif ?>
            </div>
            <div class="btn_main">
               <!--<a href="#" class="titulo_primer_servicio_portada" id="titulo_primer_servicio_portada">
                  <?php if ($texto_titulo_servicio_1_portada != '') : ?>
                     <?= $texto_titulo_servicio_1_portada ?>
                  <?php else : ?>
                     Servicio 1
                  <?php endif ?>-->
               </a>
            </div>
         </div>
         <div class="col-md-4">
            <div style="border-radius: 10px;">
               <?php if ($img_servicio_2_portada != '') : ?>
                  <img id="img_portada_servicio_2" src="<?= $img_servicio_2_portada ?>" class="services_img" style="border-radius: 10px;">
               <?php else : ?>
                  <img id="img_portada_servicio_2" src="assets/images/custom_img/m_9.jpg" class="services_img" style="border-radius: 10px;">
               <?php endif ?>
            </div>
            <div class="btn_main active">
               <!--<a href="#" class="titulo_segundo_servicio_portada" id="titulo_segundo_servicio_portada">
                  <?php if ($texto_titulo_servicio_2_portada != '') : ?>
                     <?= $texto_titulo_servicio_2_portada ?>
                  <?php else : ?>
                     Servicio 2
                  <?php endif ?>-->
               </a>
            </div>
         </div>
         <div class="col-md-4">
            <div style="border-radius: 10px;">
               <?php if ($img_servicio_3_portada != '') : ?>
                  <img id="img_portada_servicio_3" src="<?= $img_servicio_3_portada ?>" class="services_img" style="border-radius: 10px;">
               <?php else : ?>
                  <img id="img_portada_servicio_3" src="assets/images/custom_img/m_10.jpg" class="services_img" style="border-radius: 10px;">
               <?php endif ?>
            </div>
            <div class="btn_main">
               <!--<a href="#" class="titulo_tercer_servicio_portada" id="titulo_tercer_servicio_portada">
                 <?php if ($texto_titulo_servicio_3_portada != '') : ?>
                     <?= $texto_titulo_servicio_3_portada ?>
                  <?php else : ?>
                     Servicio 3
                  <?php endif ?>-->
               </a>
            </div>
         </div>
      </div>
   </div>
   </div>
</div>
<!-- services section end -->
<!-- about section start -->
<div class="about_section layout_padding " style="border-bottom:1px solid #e1e1e1;">
   <div class="container-fluid">
      <div class="row">
         <div class="col-md-6">
            <div class="about_taital_main">
               <h1 class="services_taital" id="titulo_experiencias_1">

                  <?php if ($titulo_experiencias_1_portada != '') : ?>
                     <?= $titulo_experiencias_1_portada ?>
                  <?php else : ?>
                     Experiencias de Viaje Exclusivas
                  <?php endif ?>

               </h1>

               <p class="services_text" id="texto_experiencia_parrafo_1">
                  <?php if ($primer_parrafo_experiencias_1_portada != '') : ?>
                     <?= $primer_parrafo_experiencias_1_portada ?>
                  <?php else : ?>
                     Como un equipo apasionado especializado en la organización de experiencias de viaje y eventos exclusivos,
                     nos dedicamos incansablemente a superar sus expectativas mediante la introducción de ideas innovadoras y conceptos originales.
                  <?php endif ?>
               </p>


               <p class="services_text" id="texto_experiencia_parrafo_1" style="margin-top: 10px;">
                  <?php if ($segundo_parrafo_experiencias_1_portada != '') : ?>
                     <?= $segundo_parrafo_experiencias_1_portada ?>
                  <?php else : ?>
                     En nuestra visión, el logro supremo de nuestra misión radica en la combinación
                     perfecta entre <strong>satisfacción excepcional</strong> y <strong>asombro genuino</strong>. Abrazamos una filosofía basada en:
                  <?php endif ?>
               </p>


               <div class="readmore_bt">
                  <a href="/tours_y_circuitos" class="button-custom-a" role="button">Saber más</a>
               </div>
            </div>
         </div>
         <div class="col-md-6 padding_right_0 experiencias_imagen" style="padding-right:10px ;">
            <div>
               <?php if ($imagen_experiencias != '' && file_exists(str_replace('/admin', 'admin', $imagen_experiencias))) : ?>
                  <img id="img_experiencias_portada_1" src="<?= $imagen_experiencias ?>" class="about_img" style="max-height:700px;margin-right:5px !important">
               <?php else : ?>
                  <img id="img_experiencias_portada_1" src="assets/images/custom_img/m_14.jpg" class="about_img">
               <?php endif ?>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- about section end -->

<div class="container-fluid">
   <div class="row" style="padding: 2px;">
      <div class="col-xl-6 col-md-6 col-sm-12 custom-elemento-1">
         <h1 class="h1-descubre-marrakesh" style="color: #fff;">DESCUBRE MARRAKECH</h1>
      </div>
      <div class="col-xl-6 col-md-6 col-sm-12 custom-elemento-2"></div>
   </div>
</div>



<!-- blog section start -->
<div class="container-fluid container_fluid_video">
   <video src="assets/vids/mr_1.mp4" autoplay muted playsinline loop style="width: 100%;margin-top:50px"></video>
</div>
<!-- blog section end -->
<!-- blog section start -->
<div class="blog_section layout_padding container_fluid_video" style="margin-top: 100px;border-bottom:1px solid #e1e1e1">
   <div class="container">
      <h1 class="blog_taital">NUESTRA COLECCIÓN DE VIDEOS</h1>
      <p class="blog_text">Explora la Magia de Marrakech a Través de Nuestra Colección de Videos de Viaje</p>
      <div class="play_icon_main">
         <div class="play_icon"><a href="/videos">
               <img src="assets/images/play-icon.png">
            </a>
         </div>
      </div>
   </div>
</div>
<!-- blog section end -->
<!-- client section start -->
<?php if (isset($info_testimonios) && count($info_testimonios) > 0) : ?>
   <div class="client_section layout_padding" style="border-bottom:1px solid #e1e1e1;">
      <div class="container">
         <h1 class="client_taital">Testimonios</h1>
         <div class="client_section_2">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
               </ol>
               <div class="carousel-inner">
                  <?php foreach ($info_testimonios as $testimonio) : ?>
                     <div class="carousel-item <?= $testimonio['id'] == 1 ? 'active' : '' ?>" id="<?= $testimonio['id'] ?>">
                        <div class="client_main">
                           <div class="box_left">
                              <p class="lorem_text"><?= $testimonio['texto'] ?></p>
                           </div>
                           <div class="box_right">
                              <div class="client_taital_left">
                                 <div class="client_img"><img src=""></div>
                                 <div class="quick_icon"><img src="assets/images/quick-icon.png"></div>
                              </div>
                              <div class="client_taital_right">
                                 <h4 class="client_name"><?= $testimonio['nombre'] ?></h4>
                                 <p class="customer_text"><?= $testimonio['tipo'] ?></p>
                              </div>
                           </div>
                        </div>
                     </div>
                  <?php endforeach ?>
               </div>
            </div>
         </div>
      </div>
   </div>
<?php endif ?>
<!-- client section start -->
<!-- choose section start -->
<div class="choose_section layout_padding">
   <div class="container">
      <h1 class="choose_taital">¿Por Qué Elegirnos para tu Aventura en Marrakech?</h1>
      <!-- <p style="padding-top: 30;text-align:center">
         En un mundo lleno de opciones, nos enorgullece destacar por qué deberías elegirnos para ser tu guía en la maravillosa aventura de descubrir Marrakech. Aquí hay algunas razones que hacen que nuestra oferta sea única y memorable:
      </p> -->
      <div class="container mt-4">
         <div class="row">

            <!-- Tarjeta 1: Autenticidad Inigualable -->
            <div class="col-md-4 mb-4">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column" style="padding: 0.3rem !important;">
                     <h3 class="card-title text-danger mb-1" style="text-align: center;margin-top:10px">Autenticidad Inigualable</h3>
                     <p class="card-text flex-grow-1" style="margin-bottom:10px">Nos esforzamos por ofrecer experiencias auténticas y genuinas. Nuestros itinerarios están diseñados para sumergirte en la cultura, la historia y la autenticidad de Marrakech de una manera única.</p>
                  </div>
               </div>
            </div>

            <!-- Tarjeta 2: Equipo Local Expert -->
            <div class="col-md-4 mb-4">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column" style="padding: 0.3rem !important;">
                     <h3 class="card-title text-danger mb-1" style="text-align: center;margin-top:10px">Equipo Local Expert</h3>
                     <p class="card-text flex-grow-1" style="margin-bottom:10px">Contamos con un equipo de expertos locales apasionados por Marrakech. Desde guías turísticos hasta planificadores de itinerarios, todos compartimos un amor profundo por esta ciudad y estamos comprometidos a compartir su riqueza cultural contigo.</p>
                  </div>
               </div>
            </div>

            <!-- Tarjeta 3: Flexibilidad y Personalización -->
            <div class="col-md-4 mb-4">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column" style="padding: 0.3rem !important;">
                     <h3 class="card-title text-danger mb-1" style="text-align: center;margin-top:10px">Flexibilidad y Personalización</h3>
                     <p class="card-text flex-grow-1" style="margin-bottom:10px">Entendemos que cada viajero es único. Ofrecemos opciones flexibles y la posibilidad de personalizar tu experiencia para que se adapte a tus intereses y preferencias. Tu viaje es tuyo, y queremos que sea perfecto para ti.</p>
                  </div>
               </div>
            </div>

         </div>

         <div class="row">

            <!-- Tarjeta 4: Compromiso con la Sostenibilidad -->
            <div class="col-md-6 mb-4">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column" style="padding: 0.3rem !important;">
                     <h3 class="card-title text-danger mb-1" style="text-align: center;margin-top:10px">Compromiso con la Sostenibilidad</h3>
                     <p class="card-text flex-grow-1" style="margin-bottom:10px">Nos preocupamos por Marrakech y su entorno. Nos esforzamos por ser responsables y sostenibles en todas nuestras operaciones, contribuyendo al bienestar de la comunidad local y la preservación del patrimonio cultural y natural.</p>
                  </div>
               </div>
            </div>

            <!-- Tarjeta 5: Servicio Excepcional al Cliente -->
            <div class="col-md-6 mb-4">
               <div class="card h-100">
                  <div class="card-body d-flex flex-column" style="padding: 0.3rem !important;">
                     <h3 class="card-title text-danger mb-1" style="text-align: center;margin-top:10px">Servicio Excepcional al Cliente</h3>
                     <p class="card-text flex-grow-1" style="margin-bottom:10px">La satisfacción del cliente es nuestra prioridad. Desde la planificación hasta la conclusión de tu viaje, nuestro equipo está comprometido a brindarte un servicio excepcional. Estamos aquí para hacer que tu experiencia en Marrakech sea inolvidable.</p>
                  </div>
               </div>
            </div>

         </div>
      </div>


      <!-- <p style="padding-top: 30;text-align:center">
         Al elegirnos, no solo eliges un viaje; eliges una experiencia enriquecedora, una inmersión cultural y recuerdos que perdurarán toda la vida. Ven con nosotros y descubre Marrakech de una manera que solo nosotros podemos ofrecer.
      </p> -->
      <!--<div class="read_bt_1"><a href="#">Más info</a></div>-->
      <div class="newsletter_box">
         <h1 class="let_text">Hablemos de su próximo viaje</h1>
         <div class="getquote_bt"><a href="/contacto">Empezar</a></div>
      </div>
   </div>
</div>
<!-- choose section end -->
<?php include 'includes/footer/footer.php' ?>