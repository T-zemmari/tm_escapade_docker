  <style>
      .scroll-to-top {
          position: fixed;
          bottom: 28px;
          right: 116px;
          background-color: #007bff;
          color: #fff;
          border: none;
          border-radius: 50%;
          width: 50px;
          height: 50px;
          text-align: center;
          line-height: 50px;
          cursor: pointer;
          z-index: 9999;
          display: none;
          font-size: 25px;
      }

      @media(max-width:768px) {
          .mail_text {
              font-size: 14px;
          }

          .subscribe_bt a {
              font-size: 14px;
          }

          .scroll-to-top {
              bottom: 28px !important;
              right: 85px !important;
          }
      }
  </style>

  <!-- footer section start -->
  <div class="footer_section layout_padding" id="footer">
      <div class="container">
          <div class="input_btn_main">
              <input type="text" class="mail_text" placeholder="Escribe tu correo electrónico" name="email" id="susc_email_id">
              <div class="subscribe_bt"><a onclick="suscribirse()" style="cursor:pointer">Suscribete</a></div>
          </div>
          <div class="location_main">
              <div class="call_text"><img src="assets/images/call-icon.png"></div>
              <div class="call_text"><a>+34 669217903</a></div>
              <div class="call_text"><img src="assets/images/mail-icon.png"></div>
              <div class="call_text"><a href="mailto:info@tmescapade.com">info@tmescapade.com</a></div>
          </div>
          <div class="social_icon">
              <ul>
                  <li><a href="#"><img src="assets/images/fb-icon.png"></a></li>
                  <li><a href="#"><img src="assets/images/instagram-icon.png"></a></li>
              </ul>
          </div>
          <style>
              audio {
                  display: none;
              }

              .play-button-container {
                  position: fixed;
                  bottom: 20px;
                  right: 70px;
                  z-index: 9999;
              }

              .contenedor_botones_musica {
                  display: flex;
                  justify-content: space-evenly !important;
                  align-items: center;
                  gap: 10px !important;
                  width: 100%;
              }

            
          </style>

          <!-- Botón de reproducir/pausar -->
          <div class="play-button-container">
              <div class="row" style="display: flex;justify-content:center;align-items:center;margin-bottom:20px">
                  <div class="col-4" style="text-align: center;">
                      <?php
                        $url_background_icono_musica = 'url(assets/images/iconos/icono_play_1.png)';
                        $backround_size_music = 'background-size:cover';
                        $backround_position_music = 'background-position:center';
                        $backround_repeate_music = 'no-repeate';
                        ?>
                      <div class="contenedor_botones_musica">
                          <button class="btn btn-dark btn-sm" id="playPauseButton" style="width:30px;height:30px;border: none !important;padding:15px;background-image:<?= $url_background_icono_musica ?>;<?= $backround_size_music . ';' . $backround_position_music . ';' . $backround_repeate_music ?>"></button>
                          <button class="btn btn-dark btn-sm" id="stopButton" style="width:30px;height:30px;border: none !important;padding:15px;background-image:url(assets/images/iconos/icono_stop_2.png);<?= $backround_size_music . ';' . $backround_position_music . ';' . $backround_repeate_music ?>"></button>
                      </div>
                  </div>
              </div>
          </div>



          <!-- Elemento de audio -->
          <audio id="audioPlayer" controls loop>
              <source src="relax.mp3" type="audio/mp3">
          </audio>



      </div>

  </div>
  <!-- footer section end -->
  <!-- copyright section start -->
  <!--<div class="copyright_section">
       <div class="container">
           <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html
                   Templates</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
       </div>
   </div>-->
  <!-- copyright section end -->
  <!-- Javascript files-->

  <button class="scroll-to-top" onclick="scrollToTop()">↑</button>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.0.0.min.js"></script>
  <script src="assets/js/plugin.js"></script>
  <!-- sidebar -->
  <script src="assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="assets/js/custom.js"></script>
  <!-- javascript -->
  <script src="assets/owlcarousel/owl.carousel.min.js"></script>
  <!--<script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>-->
  <script src="assets/js/swal.js"></script>
  <script src="assets/js/control_audio.js"></script>
  <script src="assets/js/jquery.magnific-popup.js"></script>
  <script src="assets/js/my_scripts/script_enviar_email_presupuesto.js"></script>
  <script src="assets/js/my_scripts/mi_script_.js"></script>

  <script>
      function scrollToTop() {
          window.scrollTo({
              top: 0,
              behavior: 'smooth'
          });
      }

      window.addEventListener('scroll', function() {
          let button = document.querySelector('.scroll-to-top');
          if (window.scrollY > 200) {
              button.style.display = 'block';
          } else {
              button.style.display = 'none';
          }
      });
  </script>

  </body>

  </html>