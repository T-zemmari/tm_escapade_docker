<?php include 'includes/header/header_2.php' ?>


<style>
   .btn_main_container {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
   }

   .type--A {
      --line_color: #555555;
      --back_color: #FFECF6;
   }

   .type--B {
      --line_color: #1b1919;
      --back_color: #E9ECFF
   }

   .type--C {
      --line_color: #00135C;
      --back_color: #DEFFFA
   }

   .button {
      margin-top: 30px;
      position: relative;
      z-index: 0;
      width: 100%;
      height: 56px;
      text-decoration: none;
      font-size: 14px;
      font-weight: bold;
      color: var(--line_color);
      letter-spacing: 2px;
      transition: all .3s ease;
   }

   .button__text {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
   }

   .button::before,
   .button::after,
   .button__text::before,
   .button__text::after {
      content: '';
      position: absolute;
      height: 3px;
      border-radius: 2px;
      background: var(--line_color);
      transition: all .5s ease;
   }

   .button::before {
      top: 0;
      left: 54px;
      width: calc(100% - 56px * 2 - 16px);
   }

   .button::after {
      top: 0;
      right: 54px;
      width: 8px;
   }

   .button__text::before {
      bottom: 0;
      right: 54px;
      width: calc(100% - 56px * 2 - 16px);
   }

   .button__text::after {
      bottom: 0;
      left: 54px;
      width: 8px;
   }

   .button__line {
      position: absolute;
      top: 0;
      width: 56px;
      height: 100%;
      overflow: hidden;
   }

   .button__line::before {
      content: '';
      position: absolute;
      top: 0;
      width: 150%;
      height: 100%;
      box-sizing: border-box;
      border-radius: 300px;
      border: solid 3px var(--line_color);
   }

   .button__line:nth-child(1),
   .button__line:nth-child(1)::before {
      left: 0;
   }

   .button__line:nth-child(2),
   .button__line:nth-child(2)::before {
      right: 0;
   }

   .button:hover {
      letter-spacing: 1px;
   }

   .button:hover::before,
   .button:hover .button__text::before {
      width: 8px;
   }

   .button:hover::after,
   .button:hover .button__text::after {
      width: calc(100% - 56px * 2 - 16px);
   }

   .button__drow1,
   .button__drow2 {
      position: absolute;
      z-index: -1;
      border-radius: 16px;
      transform-origin: 16px 16px;
   }

   .button__drow1 {
      top: -16px;
      left: 40px;
      width: 32px;
      height: 0;
      transform: rotate(30deg);
   }

   .button__drow2 {
      top: 44px;
      left: 77px;
      width: 32px;
      height: 0;
      transform: rotate(-127deg);
   }

   .button__drow1::before,
   .button__drow1::after,
   .button__drow2::before,
   .button__drow2::after {
      content: '';
      position: absolute;
   }

   .button__drow1::before {
      bottom: 0;
      left: 0;
      width: 0;
      height: 32px;
      border-radius: 16px;
      transform-origin: 16px 16px;
      transform: rotate(-60deg);
   }

   .button__drow1::after {
      top: -10px;
      left: 45px;
      width: 0;
      height: 32px;
      border-radius: 16px;
      transform-origin: 16px 16px;
      transform: rotate(69deg);
   }

   .button__drow2::before {
      bottom: 0;
      left: 0;
      width: 0;
      height: 32px;
      border-radius: 16px;
      transform-origin: 16px 16px;
      transform: rotate(-146deg);
   }

   .button__drow2::after {
      bottom: 26px;
      left: -40px;
      width: 0;
      height: 32px;
      border-radius: 16px;
      transform-origin: 16px 16px;
      transform: rotate(-262deg);
   }

   .button__drow1,
   .button__drow1::before,
   .button__drow1::after,
   .button__drow2,
   .button__drow2::before,
   .button__drow2::after {
      background: var(--back_color);
   }

   .button:hover .button__drow1 {
      animation: drow1 ease-in .06s;
      animation-fill-mode: forwards;
   }

   .button:hover .button__drow1::before {
      animation: drow2 linear .08s .06s;
      animation-fill-mode: forwards;
   }

   .button:hover .button__drow1::after {
      animation: drow3 linear .03s .14s;
      animation-fill-mode: forwards;
   }

   .button:hover .button__drow2 {
      animation: drow4 linear .06s .2s;
      animation-fill-mode: forwards;
   }

   .button:hover .button__drow2::before {
      animation: drow3 linear .03s .26s;
      animation-fill-mode: forwards;
   }

   .button:hover .button__drow2::after {
      animation: drow5 linear .06s .32s;
      animation-fill-mode: forwards;
   }

   @keyframes drow1 {
      0% {
         height: 0;
      }

      100% {
         height: 100px;
      }
   }

   @keyframes drow2 {
      0% {
         width: 0;
         opacity: 0;
      }

      10% {
         opacity: 0;
      }

      11% {
         opacity: 1;
      }

      100% {
         width: 120px;
      }
   }

   @keyframes drow3 {
      0% {
         width: 0;
      }

      100% {
         width: 80px;
      }
   }

   @keyframes drow4 {
      0% {
         height: 0;
      }

      100% {
         height: 120px;
      }
   }

   @keyframes drow5 {
      0% {
         width: 0;
      }

      100% {
         width: 124px;
      }
   }


   .button:not(:last-child) {
      margin-bottom: 64px;
   }

   @media(max-width:768px) {
      .services_text {
         padding: 20px !important;
      }
   }
</style>

<div class="services_section layout_padding" style="padding-bottom:100px">
   <div class="container">
      <h1 class="services_taital">Tours y circuitos</h1>
      <p class="services_text mt-5">
         Descubre una experiencia única con nuestros servicios de lujo en <strong>TM-ESCAPADE</strong>.
         Desde paquetes exclusivos hasta destinos elegantes,
         te ofrecemos aventuras curadas, rutas premium y escapadas sofisticadas.
         Nuestros tours exclusivos y travesías especiales te llevan a destinos distinguidos,
         brindándote experiencias elevadas y personalizadas. Con <strong>TM-ESCAPADE</strong>,
         cada viaje se convierte en una aventura atemporal, donde la distinción
         y la elegancia se fusionan para ofrecerte lo mejor en viajes de lujo.
         ¡Explora la diferencia con <strong>TM-ESCAPADE</strong> y descubre la excelencia en cada servicio!</p>
      </p>
      <?php if (isset($obtener_servicios) && count($obtener_servicios) > 0) : ?>
         <div class="services_section_2">
            <div class="row" style="display: flex;flex-direction:row;flex-wrap:wrap">
               <?php foreach ($obtener_servicios as $servicio) :
                  if ($servicio['mostrar_en_web'] == 0) continue;
               ?>
                  <div class="col-md-4 col-xl-4 col-sm-12" id="info_servicio_ref_<?= $servicio['ref_servicio_id'] ?>" style="height:580px;">
                     <div style="border-radius: 10px;">
                        <img id="img_portada_servicio_<?= $servicio['ref_servicio_id'] ?>" src="<?= $servicio['imagen_principal'] ?>" class="services_img" style="border-radius: 10px;height:450px;object-fit:cover">
                     </div>
                     <div class="btn_main_container" style="width:100%">
                        <a href="/info_serv?referencia=<?= $servicio['ref_servicio_id'] ?>"  class="button type--B" id="a_ver_servicio_<?= $servicio['ref_servicio_id'] ?>">
                           <div class="button__line"></div>
                           <div class="button__line"></div>
                           <span class="button__text"><?= $servicio['servicio_titulo'] ?>"</span>
                           <!--<div class="button__drow1"></div>
                           <div class="button__drow2"></div>-->
                        </a>
                     </div>
                  </div>
               <?php endforeach ?>
            </div>
         </div>
      <?php endif ?>
   </div>
</div>




<?php if (isset($info_testimonios) && count($info_testimonios) > 0) : ?>
   <div class="client_section layout_padding" style="border-bottom:1px solid #e1e1e1">
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


<?php include 'includes/footer/footer.php' ?>