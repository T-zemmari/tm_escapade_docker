<?php
if (!isset($banner_crousl_4_1) || $banner_crousl_4_1 == '') {
    $banner_crousl_4_1 = 'assets/images/custom_img/sah_2.png';
};
if (!isset($banner_crousl_4_2) || $banner_crousl_4_2 == '') {
    $banner_crousl_4_2 = 'assets/images/custom_img/sah_1.png';
};

?>

<style>
    .carousel_4_container {
        max-width: 100%;
        width: 100%;
        margin: 0 auto;
        height: 600px;
        display: flex;
        align-items: center;
        background-color: black;
    }

    #owl_carousel_4 .item {
        height: 530px;
        width: 100%;
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    #owl_carousel_4 .item .owl-text-overlay {
        position: absolute;
        text-align: center;
        max-width: 675px;
        padding: 50px 25px;
        width: 100%;
        top: 50%;
        transform: translateY(-50%);
        left: 0;
        right: 0;
        margin-left: auto;
        margin-right: auto;
        color: #fff;
        background-color: rgba(0, 0, 0, 0.6);
        background: rgba(0, 0, 0, 0.6);
        font-family: "Open Sans", sans-serif;
        border-radius: 20px;
    }

    #owl_carousel_4 .item .owl-text-overlay h2 {
        font-size: 40px;
        font-weight: 700;
        margin: 0 0 15px 0;
    }

    #owl_carousel_4 .item .owl-text-overlay p {
        font-size: 16px;
        line-height: 26px;
    }

    @media only screen and (max-width: 520px) {
        #owl_carousel_4 .item {
            height: 325px;
        }

        #owl_carousel_4 .item .owl-text-overlay p {
            display: none;
        }
    }

    .owl-controls {
        position: absolute;
        bottom: 5px;
        right: 10px;
        margin-left: auto;
        margin-right: auto;
    }

    .owl-controls .owl-page span {
        background: green !important;
        border: 2px solid white;
    }
    .h2-carousel-4{
        color: #fff;
    }
</style>

<div class="carousel_4_container">
    <div class="owl-carousel owl-theme" id="owl_carousel_4">
        <div class="item" style="background-image:url('<?=$banner_crousl_4_1?>');">
            <div class="owl-text-overlay">
                <h2 class="h2-carousel-4">Tour Sahara</h2>
                <p>Descubre el misterio del Sahara en un tour emocionante y único. ¡Vive la aventura en el desierto hoy.</p>
            </div>
        </div>
        <div class="item" style="background-image:url('<?=$banner_crousl_4_2?>');">
            <div class="owl-text-overlay">
                <h2 class="h2-carousel-4">Tour sahara</h2>
                <p>Embárcate en una odisea épica en el Sahara: dunas doradas, oasis ocultos y noches estrelladas te esperan. ¡Explora ahora!</p>
            </div>
        </div>
    </div>
</div>