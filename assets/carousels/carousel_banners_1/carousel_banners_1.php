<style>
    .carousel-ban-text-adj {
        position: absolute;
        width: 800px;
        display: flex;
        margin-left: 18px;
        bottom: 180px;
        background-color: #000000a8;
        border-radius: 12px;
        padding: 8px;
    }

    .carousel-header-adj {
        margin: 0;
        vertical-align: top;
        padding-left: 0px;
        text-align: left;
        left: -3px;
    }

    .carousel-paragraph {
        margin-left: 0;
        margin-top: 15px;
        margin-bottom: 15px;
        padding-left: 0;
    }

    .carousel-img-fit {
        min-width: 980px;
        min-height: 500px;
        object-fit: cover;
        object-position: 50% 50%;
    }

    .carousel-banner {
        max-height: 600px !important;
        min-height: 500px;
    }

    .carousel-banner-indicator {
        margin-left: auto;
        margin-right: auto;
        transition: 1s;
    }

    .carousel-indicators li {
        width: 250px;
        margin-top: -150px;
        margin-left: -60px;
        transition: 1s;
        opacity: 1;
    }

    .carousel-indicators li.active {
        border-top: 4px solid #8e3387;
        z-index: 15;
    }

    .carousel-swap-adjuster {
        bottom: -20px;
    }

    .carousel-banner.active {
        display: flex;
        justify-content: center;
    }

    .carousel-banner.carousel-item-next {
        display: flex;
        justify-content: center;
    }

    .carousel-banner.carousel-item-prev {
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .carousel-swap-adjuster {
            bottom: -40px;
        }

        .apology_message {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .container-fluid {
            padding-right: 0px !important;
            padding-left: 0px !important;

        }

        .contenedor_descripcion_principal p{
            padding: 2px !important;
            margin: 0px !important;
        }
        .contenedor_imagen_principal img {
            height: auto !important;
        }
    }

    @media (max-width: 550px) {
        .carousel-swap-adjuster {
            bottom: -75px;
        }
    }

    @media (max-width: 380px) {
        .carousel-swap-adjuster {
            bottom: -105px;
        }
    }
</style>


<div class="container-fluid contenedor_banner_1">
    <div id="carousel-thumb" class="carousel carousel-thumbnails slide" data-ride="carousel" data-interval="15000">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active carousel-banner">
                <img class="d-block w-100 carousel-img-fit" src="assets/images/custom_img/sah_1.png" alt="sah_1">
            </div>
            <div class="carousel-item carousel-banner">
                <img class="d-block w-100 carousel-img-fit" src="assets/images/custom_img/sah_2.png" alt="sah_2">
            </div>
            <div class="carousel-item carousel-banner">
                <img class="d-block w-100 carousel-img-fit" src="assets/images/custom_img/sah_3.png" alt="sah_3">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
        <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
    </div>
</div>