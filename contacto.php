<style>
   .custom_text_font_size {
      font-size: 13px !important;
   }

   #name::placeholder {
      font-size: 12px;
   }

   #email::placeholder {
      font-size: 12px;
   }

   #phone::placeholder {
      font-size: 12px;
   }

   #subject::placeholder {
      font-size: 12px;
   }

   #message::placeholder {
      font-size: 12px;
   }

   #fecha_ini::placeholder {
      font-size: 12px;
   }

   #fecha_fin::placeholder {
      font-size: 12px;
   }

   #asunto::placeholder {
      font-size: 12px;
   }

   #total_ninyos_menores_de_12::placeholder {
      font-size: 12px;
   }

   #total_viajeros::placeholder {
      font-size: 12px;
   }

   input[type="date"] {
      font-size: 12px;
   }

   .custom-class-p {
      margin: 0px !important;
   }

   .contendor-info-contact {
      /* border-right: 1px solid #dee2e6;
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6; */
      padding: 30px;

   }

   .contenedor_formulario_contacto {
      background-image: url('assets/images/custom_img/bk_ground_10.jpg');
   }


   @media(max-width:748px) {
      .contenedor_formulario_contacto {
         min-height: 220vh;
      }

      .custom-style-button-contacto-enviar {
         width: 100% !important;
      }
   }
</style>
<?php include 'includes/header/header_2.php' ?>
<!-- contact section start -->
<div class="contact_section">
   <?php if ($mensaje_enviar_email != '') : ?>
      <div class="container mt-5">
         <div class="row">
            <div class="col-12">
               <div class="alert <?= $email_error ? 'alert-danger' : 'alert-success' ?>"><?= $mensaje_enviar_email ?? '' ?></div>
            </div>
         </div>
      </div>
   <?php endif ?>
   <section class="py-3 py-md-4 py-xl-6">
      <div class="container">
         <div class="row gy-4 gy-md-5 gy-lg-0 align-items-md-center">
            <div class="col-12 col-lg-6">
               <div class="border overflow-hidden">

                  <form method="post" id="formulario_presupuesto">
                     <div class="row gy-3 gy-xl-5 p-4 p-xl-4">
                        <div class="col-12">
                           <label for="name" class="form-label custom_todo_blanco">Nombre completo | razon social <span class="text-danger">*</span></label>
                           <input type="text" class="form-control custom_text_font_size" id="name" placeholder="Nombre" name="name" required value="<?= $_POST['name'] ?? '' ?>">
                        </div>
                        <div class="col-12 col-md-6 ">
                           <label for="email" class="form-label mt-2 custom_todo_blanco">Email <span class="text-danger">*</span></label>
                           <div class="input-group">
                              <span class="input-group-text">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                                 </svg>
                              </span>
                              <input type="email" class="form-control custom_text_font_size" id="email" placeholder="Correo Electrónico" name="email" required value="<?= $_POST['email'] ?? '' ?>">
                           </div>
                        </div>
                        <div class="col-12 col-md-6">
                           <label for="phone" class="form-label mt-2 custom_todo_blanco">Teléfono</label>
                           <div class="input-group">
                              <span class="input-group-text">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                                 </svg>
                              </span>
                              <input type="tel" class="form-control custom_text_font_size" id="phone" placeholder="Número de Teléfono" name="phone" required value="<?= $_POST['phone'] ?? '' ?>">
                           </div>
                        </div>
                        <div class="col-12">
                           <label for="asunto" class="form-label mt-2 custom_todo_blanco">Asunto <span class="text-danger">*</span></label>
                           <input type="text" class="form-control custom_text_font_size" id="asunto" name="asunto" placeholder="Asunto" required value="<?= $_GET['referencia'] ?? '' ?>">
                        </div>
                        <div class="col-12">
                           <label for="message" class="form-label mt-2 custom_todo_blanco">Mensaje <span class="text-danger">*</span></label>
                           <textarea class="form-control custom_text_font_size" id="message" rows="3" id="comment" name="message" placeholder="Mensaje" required><?= $_POST['message'] ?? '' ?></textarea>
                        </div>

                        <div class="col-12">
                           <label for="" class="form-label mt-2 custom_todo_blanco">Fecha prevista para el viaje<span class="text-danger">:</span></label>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                           <label for="fecha_desde" class="form-label mt-2 custom_todo_blanco">Desde<span class="text-danger"></span></label>
                           <input type="date" class="form-control custom_text_font_size" placeholder="" id="fecha_desde" name="fecha_desde" value="<?= $_POST['fecha_desde'] ?? '' ?>">
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                           <label for="fecha_hasta" class="form-label mt-2 custom_todo_blanco">Hasta<span class="text-danger"></span></label>
                           <input type="date" class="form-control custom_text_font_size" placeholder="" id="fecha_hasta" name="fecha_hasta" value="<?= $_POST['fecha_hasta'] ?? '' ?>">
                        </div>
                        <div class="col-12">
                           <label for="" class="form-label mt-2 custom_todo_blanco">Viajeros<span class="text-danger">:</span></label>

                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-12">
                           <label for="total_viajeros" class="form-label mt-2 custom_todo_blanco">Total viajeros<span class="text-danger"></span></label>
                           <input type="number" class="form-control custom_text_font_size" id="total_viajeros" placeholder="Total viajeros" name="total_viajeros" value="<?= $_POST['total_viajeros'] ?? '' ?>">
                        </div>
                        <div class="col-xl-6 col-md-12 col-sm-12">
                           <label for="total_ninyos_menores_de_12" class="form-label mt-2 custom_todo_blanco">Total menores de 12 años<span class="text-danger"></span></label>
                           <input type="number" class="form-control custom_text_font_size" id="total_ninyos_menores_de_12" placeholder="Menores de 12 años" name="total_ninyos_menores_de_12" value="<?= $_POST['total_niños_menores_de_12'] ?? '' ?>">
                        </div>

                        <div class="col-12 mt-3">
                           <div class="d-grid">
                              <button type="button" class="btn btn-success btn-sm custom-style-button-contacto-enviar" style="width:100%;margin-top:10px;border:black 1px solid ;border-radius:unset !important" name="enviar_email" onclick="enviar_datos_presupuesto()">Enviar</button>
                           </div>
                        </div>
                     </div>
                  </form>

               </div>
            </div>
            <div class="col-12 col-lg-6 contendor-info-contact">
               <div class="row justify-content-xl-center">
                  <div class="col-12 col-xl-11">
                     <div class="row mb-sm-4 mb-md-5 ">
                        <div class="col-12 col-sm-6">
                           <div class="mb-4 mb-sm-0">
                              <div class="mb-3 text-primary">
                                 <div style="width:50px;height:50px;background-image: url('./assets/images/iconos/icono_reloj_1.png');background-position:center;background-size:cover"></div>
                              </div>
                              <div>
                                 <h4 class="mb-2 custom_todo_blanco">Teléfono</h4>
                                 <p class="mb-2 custom-class-p custom_todo_blanco">Puede llamarnos directamente.</p>
                                 <hr class="w-75 mb-3 border-dark-subtle">
                                 <p class="mb-0 custom-class-p">
                                    <a class="link-secondary text-decoration-none custom_todo_blanco" href="tel:+34670645462">(+34) 600000000</a>
                                 </p>
                              </div>
                           </div>
                        </div>
                        <div class="col-12 col-sm-6">
                           <div class="mb-4 mb-sm-0">
                              <div class="mb-3 text-primary">
                                 <div style="width:50px;height:50px;background-image: url('./assets/images/iconos/icono_email_1.png');background-position:center;background-size:cover"></div>
                              </div>
                              <div>
                                 <h4 class="mb-2 custom_todo_blanco">Email</h4>
                                 <p class="mb-2 custom-class-p custom_todo_blanco">O si prefiere puede escribirnos..</p>
                                 <hr class="w-75 mb-3 border-dark-subtle">
                                 <p class="mb-0 custom-class-p">
                                    <a class="link-secondary text-decoration-none custom_todo_blanco" href="mailto:info@escapade.com">info@escapade.com</a>
                                 </p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div class="mb-3 text-primary">
                           <div style="width:50px;height:50px;background-image: url('./assets/images/iconos/icono_phone_1.png');background-position:center;background-size:cover"></div>
                        </div>
                        <div>
                           <h4 class="mb-2 custom_todo_blanco">Nuestro horario</h4>
                           <p class="mb-2 custom_todo_blanco">Explore nuestras horas de atención comercial.</p>
                           <hr class="w-50 mb-3 border-dark-subtle">
                           <div class="d-flex mb-1">
                              <p class="text-secondary fw-bold mb-0 me-5 custom_todo_blanco">Lun - Vie</p>
                              <p class="text-secondary mb-0 custom_todo_blanco">&nbsp &nbsp  9:00h - 17:00h</p>
                           </div>
                           <div class="d-flex">
                              <p class="text-secondary fw-bold mb-0 me-5 custom_todo_blanco">Sab - Dom</p>
                              <p class="text-secondary mb-0 custom_todo_blanco">9:00h - 14:00h</p>
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

<!-- about section end -->
<?php include 'includes/footer/footer.php' ?>