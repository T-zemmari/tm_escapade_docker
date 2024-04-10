<style>
    .btn_carousel {
        background-color: transparent;
        border: 1px solid white;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        border-radius: 4px;
        font-size: 16px;
        margin: 20px 0;
    }

    .btn_carousel:hover {
        background-color: white;
        color: black;
        transition: 0.5s;
    }

    /* Slider */

    .slider-container {
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 100vw;
        height: 700px;
        margin: auto;
    }

    .slide_carousel {
        display: flex;
        flex: 0 0 100%;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: transform 1s ease-in-out;
        transform: translateX(100%);
    }

    .slide_carousel.active {
        transform: translateX(0);
    }

    .text-box {
        flex: 3;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        color: #fff;
        padding: 4em;
        box-sizing: border-box;
        width: 30%;
    }

    .img_carousel {
        object-fit: cover;
        flex: 7;
        width: 70px;
        height: auto;
        box-sizing: border-box;
    }

    .arrow_carousel {
        position: absolute;
        top: 50%;
        font-size: 24px;
        color: #fff;
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
    }

    #prev_btn {
        left: 10px;
    }

    #next_btn {
        right: 10px;
    }

    /* Background colors for each slide*/
    #slide1 {
        background-color: #93bebc;
    }

    #slide2 {
        background-color: #0767b2;
    }

    #slide3 {
        background-color: #d89069;
    }



    /* Tablet */
    @media screen and (max-width: 768px) {
        .slide_carousel {
            flex-direction: column;
        }

        .text-box {
            order: 2;
            width: 100%;
            padding: 2em;
        }

        .img_carousel {
            width: 100%;
        }

    }

    /* Mobile */
    @media screen and (max-width: 480px) {
        .slide_carousel {
            flex-direction: column;
        }

        .text-box {
            order: 2;
            width: 100%;
            padding: 1em;
        }

        .img_carousel {
            width: 100%;
        }

        .services_text {
            padding: 20px !important;
        }
    }
</style>

<div class="services_section layout_padding servicios_elemento_carousel_1" style="padding-top: 0px;height:600px;min-height:770px" id="servicios_elemento_carousel_1">
    <div class="container-fluid">
        <hr>
        <div class="slider-container" style="margin-top: 100px;">
            <div class="slide_carousel active" id="slide1">
                <div class="text-box">
                    <h2>Explora Marrakech: Un Viaje a la Esencia de Marruecos</h2>
                    <p>
                        Explora Marrakech: zocos, Jemaa el-Fna, arquitectura histórica, Jardines Majorelle, Mezquita Koutoubia. Colores, aromas, hospitalidad única. Descubre la auténtica Marruecos.
                    </p>
                    <a href="/contacto" class="btn_carousel">Contacta-nos</a>
                </div>
                <img class="img_carousel" src="assets/images/custom_img/marrak_1.jpg" alt="mr_1">
            </div>
            <div class="slide_carousel" id="slide2">
                <div class="text-box">
                    <h2>Travesía Mágica por el Desierto del Sahara</h2>
                    <p>
                        Embárcate en el mágico Desierto del Sahara: dunas doradas, autenticidad nómada,
                        atardeceres en camello y noches estrelladas. ¡Vive la serenidad y majestuosidad del Sahara! 🌅🐪 #ViajeÚnico
                    </p>
                    <a href="/contacto" class="btn_carousel">Contacta-nos</a>
                </div>
                <img class="img_carousel" src="assets/images/custom_img/sahara_1.jpg" alt="mr_2">
            </div>

            <div class="slide_carousel" id="slide3">
                <div class="text-box">
                    <h2>Ouarzazate: Portal al Pasado y Escenario de Ensueño</h2>
                    <p>
                        Explora la magia de Ouarzazate, donde la historia se fusiona con el cine. "Puerta del Desierto" con kasbahs, Kasbah Ait Ben Haddou (Patrimonio UNESCO) y estudios cinematográficos. Descubre la autenticidad y encanto.
                    </p>
                    <a href="/contacto" class="btn_carousel">Contacta-nos</a>
                </div>
                <img class="img_carousel" src="assets/images/custom_img/m_5.jpg" alt="mr_3">
            </div>

            <!--Used font awesome for prev and next icons-->
            <i class="arrow fa-solid fa-arrow-left arrow_carousel" id="prev_btn"></i>
            <i class="arrow fa-solid fa-arrow-right arrow_carousel" id="next_btn"></i>
        </div>
    </div>
</div>

<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slide_carousel');
    const total_sliders = slides.length;
    let slide_Interval;

    const mostrar_slide = (n) => {
        slides[currentSlide].classList.remove('active');
        currentSlide = (n + total_sliders) % total_sliders;
        slides[currentSlide].classList.add('active');
    }

    const slide_siguiente = () => mostrar_slide(currentSlide + 1);
    const slide_anterior = () => mostrar_slide(currentSlide - 1);
    const empezar_slide = () => slide_Interval = setInterval(slide_siguiente, 5000);
    const stopSlideShow = () => clearInterval(slide_Interval);

    document.getElementById('prev_btn').addEventListener('click', slide_anterior);
    document.getElementById('next_btn').addEventListener('click', slide_siguiente);

    document.querySelector('.slider-container').addEventListener('mouseenter', stopSlideShow);
    document.querySelector('.slider-container').addEventListener('mouseleave', empezar_slide);

    mostrar_slide(currentSlide);
    empezar_slide();
</script>