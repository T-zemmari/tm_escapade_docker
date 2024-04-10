<style>
    .carousel_container {
        position: relative;
        width: 360px;
        margin: 100px auto 0 auto;
        perspective: 1000px;
    }

    .carousel_1 {
        position: absolute;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        animation: rotate360 100s infinite forwards linear;
    }

    .carousel_image_1 {
        position: absolute;
        height: 200px;
        top: 20px;
        left: 10px;
        right: 10px;
        background-size: cover;
        /*box-shadow: inset 0 0 0 2000px rgba(0, 0, 0, 0.5);*/
        box-shadow: inset 0 0 0 2000px rgb(0 0 0 / 22%);
        display: flex;
    }

    .carousel_span {
        margin: auto;
        font-size: 2rem;
    }

    @keyframes rotate360 {
        from {
            transform: rotateY(360deg);
        }

        to {
            transform: rotateY(-360deg);
        }
    }

    .carousel_image_1:nth-child(1) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_1.jpg');
        transform: rotateY(0deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(2) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_2.jpg');
        transform: rotateY(40deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(3) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_3.jpg');
        transform: rotateY(80deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(4) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_4.jpg');
        transform: rotateY(120deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(5) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_5.jpg');
        transform: rotateY(160deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(6) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_6.jpg');
        transform: rotateY(200deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(7) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_7.jpg');
        transform: rotateY(240deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(8) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_8.jpg');
        transform: rotateY(280deg) translateZ(480px);
        border-radius: 30px;
    }

    .carousel_image_1:nth-child(9) {
        background-image: url('assets/carousels/carousel_1/imagenes/sah_9.jpg');
        transform: rotateY(320deg) translateZ(480px);
        border-radius: 30px;
    }

    @media only screen and (max-width: 768px) {
        .carousel_container {
            width: 220px;
            padding: 10px;
        }

        .carousel_1 {
            animation: rotate360 60s infinite forwards linear;
        }

        .carousel_image_1:nth-child(1) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_1.jpg');
            transform: rotateY(0deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(2) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_2.jpg');
            transform: rotateY(40deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(3) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_3.jpg');
            transform: rotateY(80deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(4) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_4.jpg');
            transform: rotateY(120deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(5) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_5.jpg');
            transform: rotateY(160deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(6) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_6.jpg');
            transform: rotateY(200deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(7) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_7.jpg');
            transform: rotateY(240deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(8) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_8.jpg');
            transform: rotateY(280deg) translateZ(300px);
            border-radius: 15px;
        }

        .carousel_image_1:nth-child(9) {
            background-image: url('assets/carousels/carousel_1/imagenes/sah_9.jpg');
            transform: rotateY(320deg) translateZ(300px);
            border-radius: 15px;
        }
    }
</style>

<div class="about_section layout_padding sobre_nosotros_elemento_carousel_rotativo_1" style="padding-top: 0px;height:600px" id="sobre_nosotros_elemento_carousel_rotativo_1">
    <div class="container-fluid">
        <hr>

        <div class="carousel_container">
            <div class="carousel_1">
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
                <div class="carousel_image_1"><span class="carousel_span"></span></div>
            </div>
        </div>
    </div>
</div>