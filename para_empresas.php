<?php include 'includes/header/header_2.php' ?>

<style>
    .getquote_bt a {
        width: 100%;
        float: left;
        font-size: 16px;
        color: #000000;
        background-color: #e7e7e7;
        text-align: center;
        padding: 10px 0px;
        border-radius: 0px;
        font-weight: bold;
    }


    @media(max-width:768px) {
        .services_text {
            padding: 20px !important;
        }
    }
</style>

<!--div class="services_section layout_padding" style="padding-bottom:150px">
    <?php include 'assets/carousels/carousel_banners_1/carousel_banners_1.php' ?>
</div>-->

<div class="services_section layout_padding" style="padding-bottom:150px;padding-top: 0px;">
    <div class="container-fluid" style="padding-left:0px;padding-right:0px ;">
        <div class="row">
            <div class="col-12">
                <?php include 'assets/carousels/carousel_4/carousel_4.php'; ?>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h1 class="services_taital">Tours para Empresas</h1>
        <p class="services_text" style="margin-top: 20px;">
            Experimenta un nivel excepcional con nuestros exclusivos servicios para empresas en <strong>TM-ESCAPADE</strong>. Desde paquetes diseñados especialmente hasta destinos de prestigio, te brindamos experiencias empresariales únicas, rutas premium y escapadas sofisticadas.
            Nuestros tours exclusivos y travesías corporativas te llevan a destinos distinguidos, proporcionándote experiencias elevadas y personalizadas que se adaptan a las necesidades de tu empresa. Con <strong>TM-ESCAPADE</strong>, cada viaje se convierte en una aventura atemporal, donde la distinción y la elegancia se fusionan para ofrecerte lo mejor en viajes corporativos de lujo.
            ¡Explora la diferencia con <strong>TM-ESCAPADE</strong> y descubre la excelencia en cada servicio para empresas!
        </p>

        <p class="services_text" style="margin-top: 20px;">
            Para obtener más información y personalizar su experiencia empresarial, no dude en ponerse en contacto con nosotros.
        </p>
        <p class="services_text" style="margin-top: 20px;">
            Estamos aquí para atender todas sus necesidades y garantizar que su viaje corporativo sea inolvidable.
        </p>

        <div class="getquote_bt"><a href="/contacto" style="margin-top: 50px;">Empezar</a></div>


        <?php if (isset($obtener_servicios_empresas) && count($obtener_servicios_empresas) > 0) : ?>
            <div class="services_section_2">
                <div class="row" style="display: flex;flex-direction:row;flex-wrap:wrap">
                    <?php foreach ($obtener_servicios_empresas as $servicio) :
                        if ($servicio['mostrar_en_web'] == 0) continue;
                    ?>
                        <div class="col-md-4 col-xl-4 col-sm-12" id="info_servicio_ref_<?= $servicio['ref_servicio_id'] ?>" style="height:580px;">
                            <div style="border-radius: 10px;">
                                <img id="img_portada_servicio_<?= $servicio['ref_servicio_id'] ?>" src="<?= $servicio['imagen_principal'] ?>" class="services_img" style="border-radius: 10px;height:450px;">
                            </div>
                            <div class="btn_main_container" style="width:100%">
                                <a href="/info_serv?referencia=<?= $servicio['ref_servicio_id'] ?>" target="_blank" class="button type--B" id="a_ver_servicio_<?= $servicio['ref_servicio_id'] ?>">
                                    <div class="button__line"></div>
                                    <div class="button__line"></div>
                                    <span class="button__text"><?= $servicio['servicio_titulo'] ?>"</span>
                                    <div class="button__drow1"></div>
                                    <div class="button__drow2"></div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>
    </div>
</div>

<?php if (isset($mostrar_carousel_vista_servicios_1) && $mostrar_carousel_vista_servicios_1 == true) : ?>
    <?php include 'assets/carousels/carousel_2/carousel_2.php' ?>
<?php endif ?>


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