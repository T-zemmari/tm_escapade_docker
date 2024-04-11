<style>
   .container_fluid_video {
      padding-right: 34px !important;
      width: 100vw !important;
   }

   @media(max-width:768px) {
      .experiencias_imagen {
         padding-right: 18px !important;
      }

      .container_fluid_video {
         padding-right: 15px !important;
      }
   }
</style>

<?php include 'includes/header/header_2.php' ?>

<div class="container-fluid container_fluid_video">
   <video src="assets/vids/mr_3.mp4" autoplay muted playsinline loop style="width: 100%;margin-top:12px"></video>
   <video src="assets/vids/mr_2.mp4" autoplay muted playsinline loop style="width: 100%;margin-top:12px"></video>
   <video src="assets/vids/mr_4.mp4" autoplay muted playsinline loop style="width: 100%;margin-top:12px"></video>
   <video src="assets/vids/mr_1.mp4" autoplay muted playsinline loop style="width: 100%;margin-top:12px;margin-bottom:12px"></video>
</div>
<?php include 'includes/footer/footer.php' ?>