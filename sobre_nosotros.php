<?php include 'includes/header/header_2.php' ?>

<style>
   /* Estilo para los cards */
   .card {
      margin-bottom: 20px;
      border: none;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
   }

   .card:hover {
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
   }

   /* Estilo para el enlace "Read More" */
   .readmore_bt a {
      color: #fff;
      background-color: #007bff;
      padding: 10px 20px;
      text-decoration: none;
      display: inline-block;
      margin-top: 20px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
   }

   .readmore_bt a:hover {
      background-color: #0056b3;
   }

   @media(max-width:768px) {
      .custom-sobre-nosotros {
         margin-top: 40px;
      }

   }
</style>
<!-- about section start -->
<!-- about section start -->
<div class="about_section layout_padding" style="padding-top: 150px;">
   <div class="container-fluid">
      <section class="py-3 py-md-5">
         <div class="container">
         
            <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center" style="margin-top: 80px;">
               <div class="col-12 col-lg-6 col-xl-5">
                  <img class="img-fluid rounded" loading="lazy" src="assets/images/custom_img/about_3.png" alt="About 1">
               </div>
               <div class="col-12 col-lg-6 col-xl-7">
                  <div class="row justify-content-xl-center">
                     <div class="col-12 col-xl-11">

                        <div class="row gy-4 gy-md-0 gx-xxl-5X custom-sobre-nosotros">
                           <div class="col-12 col-md-6 custom-sobre-nosotros">
                              <div class="d-flex">
                                 <div class="me-4 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                       <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                    </svg>
                                 </div>
                                 <div>
                                    <h2 class="h4 mb-3 ml-2"> Nuestra Pasión</h2>
                                    <p class="text-secondary mb-0">
                                       En el centro de nuestra filosofía late la pasión por Marruecos, compartiendo su riqueza cultural y belleza con viajeros de todo el mundo. Superamos expectativas con experiencias auténticas y personalizadas.
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6 custom-sobre-nosotros">
                              <div class="d-flex">
                                 <div class="me-4 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                       <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                    </svg>
                                 </div>
                                 <div>
                                    <h2 class="h4 mb-3 ml-2">Viajes a Tu Medida</h2>
                                    <p class="text-secondary mb-0">
                                       Entendemos que cada viajero es único. Ofrecemos soluciones personalizadas adaptadas a tus intereses, presupuesto y preferencias, haciendo realidad tus sueños de viaje.
                                    </p>
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6 mt-4 custom-sobre-nosotros" style="margin-top: 50px;">
                              <div class="d-flex">
                                 <div class="me-4 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                       <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                    </svg>
                                 </div>
                                 <div>
                                    <h2 class="h4 mb-3 ml-2">Compromiso Sostenible</h2>
                                    <p class="text-secondary mb-0">
                                       TM-Escapade no solo ofrece experiencias excepcionales, sino que también se preocupa por preservar y contribuir al bienestar de las comunidades locales y al entorno natural mediante prácticas sostenibles
                                 </div>
                              </div>
                           </div>
                           <div class="col-12 col-md-6 mt-4 custom-sobre-nosotros">
                              <div class="d-flex">
                                 <div class="me-4 text-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                                       <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                    </svg>
                                 </div>
                                 <div>
                                    <h2 class="h4 mb-3 ml-2">Únete Ahora</h2>
                                    <p class="text-secondary mb-0">
                                       Descubre la magia de Marruecos con TM-Escapade. Tu viaje se convierte en una historia inolvidable. Únete a nosotros y haz realidad tus sueños. </p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>
<!-- about section end -->



<?php if (isset($mostrar_carousel_vista_servicios_1) && $mostrar_carousel_vista_servicios_1 == true) : ?>
   <?php include 'assets/carousels/carousel_3/carousel_3.php' ?>
<?php endif ?>


<div class="container" style="margin-top: 50px;margin-bottom:50px">
   <div class="row">
      <div class="col-md-12">
         <div class="newsletter_box" style="border: 1px solid #dfd3d3;">
            <h1 class="let_text">Hablemos de su próximo viaje</h1>
            <div class="getquote_bt"><a href="/contacto">Empezar</a></div>
         </div>
      </div>
   </div>
</div>


<!-- about section end -->
<?php include 'includes/footer/footer.php' ?>