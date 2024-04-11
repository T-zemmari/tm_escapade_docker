<?php include 'includes/header/header_2.php' ?>

<?php

$info_servicio = [];
if (isset($_GET['referencia']) && $_GET['referencia'] != '') {
    $info_servicio = bn_obtener_info_servicio_por_referencia($_GET['referencia']);
}


?>

<style>
    .centrar-elementos {
        display: flex;
        justify-content: center;
        align-items: center;
    }


    .custom-flex-direction-column {
        display: flex;
        flex-direction: column;
    }

    .custom-flex-direction-row {
        display: flex;
        flex-direction: row;
    }

    .contenedor_descripcion_principal {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        width: 100%;
        height: 100%;
        flex-direction: column;
    }

    .contenedor_resto_imagenes {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn_main_container {
        width: 60%;
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

    .complemento-imagen-principal {
        max-height: 300px !important;
        width: 100% !important;
        object-fit: cover !important;
        border-radius: 5px !important;
    }

    .complemento-imagen-secundaria {
        max-height: 140px !important;
        width: 100% !important;
        object-fit: cover !important;
        border-radius: 5px !important;
    }

    .custom-btn-ver-imagenes {
        cursor: pointer;
        background: #fff;
        color: #1b1919;
        box-shadow: 0 0 8px #d7d7d7;
        padding: 8px 12px;
        border-radius: 4px;
        min-height: 40px;
    }

    .contenedor_imagen_principal {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .div-main {
        max-width: 100%;
        margin: 0 auto;
        height: 60vh;
        /*margin-top: 50px;*/
        font-family: 'Montserrat', sans-serif;
    }

    h2 {
        text-transform: uppercase;
    }

    /* Essential CSS */

    .parallax {
        background-image: url("<?= $info_servicio['info_servicio']['url_img_landing'] ?>");
        min-height: 60vh;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .parallax-content {
        min-height: 60vh;
        background-color: rgba(0, 0, 0, 0.5);
        padding: 0 10%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 3em;
        text-align: center;
    }

    .h1-custom-class-servicio {
        font-size: 35px;
        padding: 30px;
    }

    .contenedor_formulario_contacto {
        min-height: 105vh;
        /*border: 1px solid #e3e1e1;*/
    }

    .contenedor_detalle_incluidos {
        min-height: 60vh;
        background-color: #f5f5f5;
    }

    .contenedor-header-mas-detalles {
        width: 100%;
        border-bottom: 3px solid #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .contenedor-incluye,
    .contenedor-no-incluye {
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 40px 20px;
    }

    .header-incluye,
    .header-no-incluye {
        width: 80%;
        border-bottom: 4px solid #e94817;
        height: 80px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .body-incluye,
    .body-no-incluye {
        width: 100%;
        height: 100%;
        padding: 40px 20px;
    }

    .h2-titulo-incluye,
    .h2-titulo-no-incluye {
        color: #7c795d;
        font-family: 'Trocchi', serif;
        font-size: 25px;
        font-weight: normal;
        line-height: 48px;
        margin: 0
    }

    .contenedor_item_incluido {
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        flex-direction: row;
        margin-top: 5px;
        margin-bottom: 5px;
        gap: 10px;
    }

    .contendor-checkbox-servicio {
        width: 4%;
    }

    .contendor-icono-servicio {
        width: 8%;
    }

    .contenedor-titulo-servicio {
        width: 86%;
    }

    .h1-pide-tu-presupuesto {
        color: #fff;
        padding: 30px;
        border-bottom: 1px solid #fff;
    }

    .img_muestra_peq_servicio {
        width: 150px;
        height: 150px;
        border-radius: 10px;
        object-fit: cover;
    }

    .contenedor_img_muestra_peq_servicio {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        flex-direction: column;
    }

    .contenedor_resto_imagenes_version_escritorio {
        display: block;
    }

    .contenedor_resto_imagenes_version_movil {
        display: none;
        margin-top: 25px;
        margin-bottom: 25px;
    }

    @media(max-width:768px) {
        .div-main {
            height: 25vh !important;
        }

        .parallax-content {
            min-height: 0px !important;
        }

        .parallax {
            min-height: 25vh !important;
        }

        .h1-custom-class-servicio {
            font-size: 18px !important;
            padding: 0px !important;
        }

        .contenedor_imagen_principal img {
            width: 100% !important;
        }

        .apology_message {
            padding: 0px !important;
        }

        .row_contenedor_servicio_info {
            margin-top: 2px !important;
            margin-bottom: 4px !important;
        }

        .row_contenedor_servicio_info {
            display: flex;
            flex-direction: column-reverse;
            gap: 50px;
        }

        .h1-custom-class-servicio {
            padding: 20px 10px !important;
        }

        .h2-titulo-incluye,
        .h2-titulo-no-incluye {
            font-family: 'Trocchi', serif;
            font-size: 16px;
            line-height: 2px;
        }

        .contenedor_descripcion_principal {
            gap: 10px;
        }

        .contenedor-incluye,
        .contenedor-no-incluye {
            padding: 0px 0px !important;
        }

        .body-incluye,
        .body-no-incluye {
            padding: 15px 0px !important;
        }

        .header-incluye,
        .header-no-incluye {
            height: 50px !important;
            margin-top: 10px !important;
        }

        .contenedor_imagen_principal img {
            height: auto !important;
        }

        .contenedor_descripcion_principal p {
            margin: 0px !important;
        }

        .custom-btn-ver-imagenes {
            padding: 2px 8px;
            border-radius: 4px;
            top: 4px !important;
            left: 25% !important;
            font-size: 14px;
        }

        .h1_complementos {
            font-size: 18px !important;
        }

        .h2_complementos {
            font-size: 16px !important;
            margin-bottom: 10px;
        }

        .col_descripcion_complemento {
            margin-top: 25px;
            margin-bottom: 25px;
            padding-left: 5px !important;
            padding-right: 5px !important;
            line-height: 1.8;
        }

        .text-secondary {
            font-size: 16px !important;
        }

        .col {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

        .custom_carousel_slide_componente .custom_carousel_inner_slide_componente {
            border-radius: 5px !important;
        }

        .btn_main_container {
            width: 100%;
        }

        .services_section {
            padding: 0px !important;
        }

        .layout_padding {
            padding: 0px !important;
        }

        .contenedor_resto_imagenes_version_escritorio {
            display: none;
        }

        .contenedor_resto_imagenes_version_movil {
            display: block;
        }
    }
</style>




<?php if (!isset($info_servicio) || empty($info_servicio)) : ?>
    <div class="services_section layout_padding">

        <div class="apology_message" style="height: 600px;padding:30px">
            <h2>¡Oops! Parece que hemos tropezado...</h2>
            <p>Lamentablemente, la página que buscas no está disponible en este momento. Pero ¡no te preocupes! Estamos trabajando arduamente para solucionarlo.</p>
            <p>Mientras tanto, no dudes en ponerte en contacto con nosotros a través de nuestra sección de 'Contáctanos'. Estamos aquí para ayudarte en lo que necesites.</p>
            <p>¡Gracias por tu comprensión y paciencia!</p>
        </div>
    </div>
<?php else : ?>
    <div class="services_section layout_padding" style="min-height:100vh;padding:0px;">
        <div class="div-main">
            <section class="parallax">
                <div class="parallax-content">
                    <!--<h2>Simple CSS Parallax</h2>
                    <p>Add depth to your site effortlessly with this lightweight, JavaScript-free parallax effect.</p>
                -->
                </div>
            </section>
        </div>
        <div class="apology_message" style="height:100%;margin-bottom:20px;padding:20px">
            <div class="container" style="margin-top:25px;margin-bottom:25px">
                <div class="row centrar-elementos">
                    <div class="col-md-12 col-sm-12 centrar-elementos">
                        <h1 class="h1-custom-class-servicio" style="color:#e94817"><strong><?= $info_servicio['info_servicio']['servicio_titulo'] ?? '' ?></strong></h1>
                    </div>
                </div>
                <hr>
                <div class="row row_contenedor_servicio_info" style="margin-top: 50px;margin-bottom: 50px;">
                    <div class="col-xl-6">
                        <div class="contenedor_descripcion_principal">
                            <h2 class="text-secondary mb-0" style="font-size:18px;padding:2px !important;line-height: 1.8;margin:0px !important;color:#9d3b00 !important;margin-bottom:10px !important">
                                <?= str_replace('.', ".<br>", $info_servicio['info_servicio']['servicio_titulo_largo']) ?? '' ?>
                            </h2>
                            <p class="text-secondary mb-0" style="font-size:16px;padding:2px !important;line-height: 1.8;margin:0px !important">
                                <?= str_replace('.', ".<br>", $info_servicio['info_servicio']['servicio_descripcion']) ?? '' ?>
                            </p>
                            <?php if (isset($mostrar_form_contacto) && $mostrar_form_contacto == 1) : ?>
                                <div class="btn_main_container">
                                    <a href="#contact_form_<?= $info_servicio['info_servicio']['id'] ?>" class="button type--B">
                                        <div class="button__line"></div>
                                        <div class="button__line"></div>
                                        <span class="button__text">PIDE TU PRESUPUESTO</span>
                                        <div class="button__drow1"></div>
                                        <div class="button__drow2"></div>
                                    </a>
                                </div>
                            <?php else : ?>
                                <div class="btn_main_container ">
                                    <a href="/contacto" class="button type--B">
                                        <div class="button__line"></div>
                                        <div class="button__line"></div>
                                        <span class="button__text">PRESUPUESTO A MEDIDA</span>
                                        <div class="button__drow1"></div>
                                        <div class="button__drow2"></div>
                                    </a>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="contenedor_imagen_principal" style="border-radius: 5px;">
                            <img style="width: 95%;height: 550px;border-radius: 5px;" src="<?= $info_servicio['info_servicio']['imagen_principal'] ?? '' ?>" alt="img_principal">
                        </div>
                    </div>
                </div>
                <hr>
            </div>

            <?php if (isset($info_servicio['info_servicio']['resto_imagenes']) && count($info_servicio['info_servicio']['resto_imagenes']) > 0) :
            ?>
                <div class="container contenedor_resto_imagenes_version_escritorio">
                    <div class="row">
                        <div class="col-md-9 centrar-elementos">
                            <img id="ident_img_serv_grande" style="height:500px;border-radius:10px" src="<?= $info_servicio['info_servicio']['resto_imagenes'][1] ?>" alt="<?= $info_servicio['info_servicio']['servicio_titulo'] ?? '' ?>">
                        </div>
                        <div class="col-md-3 contenedor_img_muestra_peq_servicio version_escritorio">
                            <?php foreach (array_slice($info_servicio['info_servicio']['resto_imagenes'], 0, 4) as $imagen) : ?>
                                <img class="img_muestra_peq_servicio" src="<?= $imagen ?>" alt="<?= $info_servicio['info_servicio']['servicio_titulo'] ?? '' ?>" onclick="mostrar_img_peq_serv('<?= $imagen ?>','ident_img_serv_grande')">
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <div class="container contenedor_resto_imagenes_version_movil">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="custom_slider_img_serv" class="carousel slide carousel-fade">
                                <div class="carousel-inner">
                                    <?php foreach (array_slice($info_servicio['info_servicio']['resto_imagenes'], 0, 4) as $index => $imagen) : ?>
                                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                            <img src="<?= $imagen ?>" alt="<?= $info_servicio['info_servicio']['servicio_titulo'] ?? '' ?>" class="d-block w-100">
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#custom_slider_img_serv" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#custom_slider_img_serv" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>

            <?php if (isset($info_servicio['info_servicio']['array_incluidos_y_no_incluidos']) && count($info_servicio['info_servicio']['array_incluidos_y_no_incluidos']) > 0) :
                $array_incluidos = [];
                $array_no_incluidos = [];
                foreach ($info_servicio['info_servicio']['array_incluidos_y_no_incluidos'] as $item) {
                    if ($item['es_incluido'] == 0) {
                        $array_no_incluidos[] = $item;
                    }
                    if ($item['es_incluido'] == 1) {
                        $array_incluidos[] = $item;
                    }
                }

            ?>
                <div class="container-fluid contenedor_detalle_incluidos" style="margin-top:25px;margin-bottom:25px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="contenedor-header-mas-detalles">
                                <h1 class="h1-custom-class-servicio" style="color:#e94817"><strong>MAS DETALLES</strong></h1>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <?php if (count($array_no_incluidos) > 0) : ?>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="contenedor-incluye">
                                        <div class="header-incluye">
                                            <h2 class="h2-titulo-incluye" style="color:#120679;padding:0px">Servicios inlcuidos</h2>
                                        </div>
                                        <div class="body-incluye">
                                            <?php foreach ($array_incluidos as $incluido) :
                                            ?>
                                                <div class="contenedor_item_incluido" id="contenedor_item_<?= $incluido['id'] ?>">
                                                    <div class="contendor-icono-servicio">
                                                        <img style="width:100%;height:100%" src="<?= $incluido['mas_info']['url_icono'] ?>" alt="<?= $incluido['mas_info']['nombre'] ?>">
                                                    </div>
                                                    <div class="contendor-checkbox-servicio">
                                                        <img style="width:100%;height:100%" src="admin/assets/custom_icons/checked_1.png" alt="checked">
                                                    </div>
                                                    <div class="contendor-titulo-servicio">
                                                        <?= $incluido['mas_info']['nombre'] ?>
                                                    </div>
                                                </div>

                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if (count($array_no_incluidos) > 0) : ?>
                                <div class="col-xl-6 col-md-6 col-sm-12">
                                    <div class="contenedor-no-incluye">
                                        <div class="header-no-incluye">
                                            <h2 class="h2-titulo-no-incluye" style="color:#9d3b00">Servicios no inlcuidos</h2>
                                        </div>
                                        <div class="body-no-incluye">
                                            <?php foreach ($array_no_incluidos as $no_incluido) : ?>
                                                <div class="contenedor_item_incluido" id="contenedor_item_<?= $no_incluido['id'] ?>">
                                                    <div class="contendor-icono-servicio">
                                                        <img style="width:100%;height:100%" src="<?= $no_incluido['mas_info']['url_icono'] ?>" alt="<?= $no_incluido['mas_info']['nombre'] ?>">
                                                    </div>
                                                    <div class="contendor-checkbox-servicio">
                                                        <img style="width:100%;height:100%" src="admin/assets/custom_icons/unchecked_1.png" alt="unchecked">
                                                    </div>
                                                    <div class="contendor-titulo-servicio">
                                                        <?= $no_incluido['mas_info']['nombre'] ?>
                                                    </div>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>

                </div>
            <?php endif ?>

            <?php if (isset($info_servicio['info_servicio']['complementos']) && count($info_servicio['info_servicio']['complementos']) > 0) : ?>

                <?php foreach ($info_servicio['info_servicio']['complementos'] as $complemento) :
                    $mostrar_en_web = false;
                    if ($complemento['mostrar_en_web'] == 1) {
                        $mostrar_en_web = true;
                        break;
                    }
                ?>
                <?php endforeach ?>

                <?php if ($mostrar_en_web == true) : ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="h1_complementos"><strong>¿ Que mas puedes hacer ?</strong></h1>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php endif ?>
                <?php foreach ($info_servicio['info_servicio']['complementos'] as $complemento) :
                    if ($complemento['mostrar_en_web'] == 0) continue;
                    $array_galeria_imagenes = [];
                    if ($complemento['imagen_principal'] != '') {
                        $array_galeria_imagenes[] = $complemento['imagen_principal'];
                    }
                    foreach ($complemento['resto_imagenes_info_completa'] as $imagen) {
                        $array_galeria_imagenes[] = $imagen['url_archivo'];
                    }
                    $lista_imagenes = implode(',', $array_galeria_imagenes);

                ?>

                    <div class="container" style="margin-top: 5px; margin-bottom: 25px;">
                        <div class="row" style="text-align: start;">
                            <div class="col-md-12 col-sm-12">
                                <h2 class="h2_complementos"><?= $complemento['titulo_complemento'] ?? '' ?></h2>
                            </div>
                        </div>
                        <div class="row div-padre-movil-contenedor-imagenes-complemento">
                            <div class="col">
                                <div class="carousel-<?= $complemento['ref_complemento'] ?> slide d-md-none custom_carousel_slide_componente" data-ride="carousel">
                                    <div class="carousel-inner custom_carousel_inner_slide_componente" role="listbox">
                                        <?php foreach ($array_galeria_imagenes as $index => $imagen) : ?>
                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                <img src="<?= $imagen ?>" class="d-block w-100" alt="...">
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                    <a class="carousel-control-prev" href="#carousel-<?= $complemento['ref_complemento'] ?>" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Anterior</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carousel-<?= $complemento['ref_complemento'] ?>" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Siguiente</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row div-padre-desktop-contenedor-imagenes-complemento" style="margin-top: 10px; margin-bottom: 50px;">
                            <div class="col-xl-9 col-md-12 col-sm-12" style="position: relative;">
                                <!-- Imagen principal -->
                                <a style="width:100%" class="image-popup-link mostrar-imagen-pop-up" data-referencia="<?= $complemento['ref_complemento'] ?? '' ?>" href="<?= $complemento['imagen_principal'] ?>">
                                    <img class="imagen-movil-custom-style complemento-imagen-principal" src="<?= $complemento['imagen_principal'] ?? '' ?>" alt="<?= $complemento['titulo_complemento'] ?? '' ?>">
                                </a>
                                <button class="custom-btn-ver-imagenes" style="position:absolute;top:20px;left:25px;" data-lista-imagenes="<?= $lista_imagenes ?>">
                                    Ver todas las imágenes
                                </button>
                            </div>
                            <div class="col-xl-3 col-md-12 col-sm-12 custom-flex-direction-column">
                                <!-- Imágenes adicionales -->
                                <?php if (isset($complemento['resto_imagenes_info_completa']) && count($complemento['resto_imagenes_info_completa']) > 0) : ?>
                                    <div class="row mb-2 centrar-elementos">
                                        <?php foreach (array_slice($complemento['resto_imagenes_info_completa'], 0, 2) as $index => $imagen) : ?>
                                            <div class="col-12  mt-1">
                                                <a style="width:100%" class="image-popup-link mostrar-imagen-pop-up" data-referencia="<?= $complemento['ref_complemento'] ?? '' ?>" href="<?= $imagen['url_archivo'] ?? '' ?>">
                                                    <img class="imagen-movil-custom-style" style="max-height: 143px; width: 100%; object-fit: cover; border-radius: 5px;" src="<?= $imagen['url_archivo'] ?? '' ?>" alt="img_<?= $index + 1 ?>">
                                                </a>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="row mb-2 mt-1">
                            <div class="col-12 col_descripcion_complemento">
                                <span class="span_descripcion_complemento text-secondary">
                                    <?= $complemento['descripcion_complemento'] ?? '' ?>
                                </span>
                            </div>
                        </div>
                        <hr>
                    </div>
                <?php endforeach ?>
            <?php endif ?>

            <?php if (isset($mostrar_form_contacto) && $mostrar_form_contacto == 1) : ?>

                <div class="container-fluid contenedor_formulario_contacto" style="margin-top:25px;margin-bottom:25px" id="contact_form_<?= $info_servicio['info_servicio']['id'] ?>">
                    <div class="row">
                        <div class="col-md-12 centrar-elementos">
                            <h1 class="h1-pide-tu-presupuesto">PIDE TU PRESUPUESTO</h1>
                        </div>
                    </div>
                    <?php include 'includes/contact_forms/form_contact_1.php' ?>
                </div>
            <?php endif ?>

        </div>
        <div class="div-main">
            <section class="parallax">
                <div class="parallax-content">
                    <!--<h2>Simple CSS Parallax</h2>
                    <p>Add depth to your site effortlessly with this lightweight, JavaScript-free parallax effect.</p>
                -->
                </div>
            </section>
        </div>
    </div>

<?php endif ?>





<?php include 'includes/footer/footer.php' ?>