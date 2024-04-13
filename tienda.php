<?php
// Comprueba el host
$__host = $_SERVER['HTTP_HOST'];
$__local = ($__host !== 'tmescapade.com');

include 'includes/header/header_2.php';
$array_categorias = bn_obtener_categorias();
$array_productos_destacados = bt_productos_destacados();
?>

<style>
    .contenedor_productos_principal {
        padding: 0 150px;
    }

    .menu {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 80px;
    }

    .menu-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }
 
    .nice-select-wrapper .nice-select {
        font-size: 14px;

    }

    .article-box {
        position: relative;
        color: white;
    }

    .article-box .image img {
        width: 100%;
        height: 100%;
        transition: transform 1s ease;
    }

    .article-box .image {
        width: 100%;
        height: 100%;
        overflow: hidden;
        box-shadow: 0 5px 20px -5px rgb(0 0 0 / 10%);
    }

    .article-box:hover .image {
        box-shadow: 0 10px 30px rgb(0 0 0 / 20%);
    }

    .article-box:hover .image img {
        transform: scale(1.1);
        transition: transform 0.5s ease;
    }

    .article-box .name {
        position: absolute;
        bottom: 50px;
        right: 0px;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.075s ease-out;
        color: rgba(51, 51, 51, 1);
        text-align: center;
        text-transform: uppercase;
        font-size: 13px;
        padding: 8px 16px;
        font-weight: bold;
    }

    .article-box .description .text-more {
        font-size: 11px;
        color: #333;
        text-align: right;
        padding-top: 10px;
    }

    .custom_bg_categorie {
        background: radial-gradient(120.74% 1304.26% at 0% 0%, rgb(242, 164, 30) 0%, rgb(242, 164, 30) 9.51%, rgb(249, 181, 246) 100%);
    }
</style>


<?php if (!$__local) : ?>
    <div class="services_section" style="padding-bottom:20px;min-height:80vh">
        <div style="display: flex; justify-content: center; align-items: center; height: 100vh; font-size: 24px;">Sitio en mantenimiento</div>
    </div>
<?php else : ?>
    <div class="services_section" style="padding-bottom:20px;min-height:100vh">
        <div class="container-fluid mx-auto mt-10">
            <div class="grey-background mt-5 mb-5">
                <div class="container-fluid" style="padding: 20px;">
                    <!--<div class="row">
                        <div class="col my-3">
                            <h3>CATEGORIAS</h3>
                            <p>Nuestros lanzamientos calientes, seleccionados con amor y pasión.</p>
                        </div>
                    </div>-->
                    <div class="row">
                        <?php foreach (array_slice($array_categorias, 0, 4) as $categoria) :
                            if ($categoria['categoria_estado'] == 0) continue;
                            if ($categoria['categoria_descatalogada'] == 1) continue;
                        ?>
                            <div class="col-sm-3" id="bloque_categoria_ref_<?= $categoria['ref_categoria'] ?? '' ?>">
                                <div class="article-box">
                                    <a style="cursor: pointer;" onclick="obtener_y_renderizar_productos_de_una_categoria('<?= $categoria['ref_categoria'] ?? '' ?>')">
                                        <div class="image"><img src="<?= $categoria['url_imagen_principal'] ?? '' ?>" alt="<?= $categoria['nombre'] ?? '' ?>"></div>
                                        <div class="description">
                                            <div class="name"><?= $categoria['nombre'] ?? '' ?></div>
                                            <!--<div class="text-more" id="mostrar_productos_<?= $categoria['ref_categoria'] ?? '' ?>">Ver productos</div>-->
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>
        <hr>


        <div class="container-fluid contenedor_productos_principal" id="contenedor_info_productos">
            <?php include 'includes/cards/card_1/card_1.php'; ?>
            <div class="row">
                <div class="col-xl-3 col-md-12 col-sm-12">

                    <div class="menu">
                        <div class="menu-header">
                            <h3>Filtrar Productos</h3>
                        </div>
                        <div class="form-group">
                            <label for="genero">Género:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="genero1" value="hombre">
                                <label class="form-check-label" for="genero1">Hombre</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="genero2" value="mujer">
                                <label class="form-check-label" for="genero2">Mujer</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="genero3" value="infantil">
                                <label class="form-check-label" for="genero3">Infantil</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="genero" id="genero4" value="unisex">
                                <label class="form-check-label" for="genero4">Unisex</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="productos_select_ordenar_por">Ordenar por:</label>
                            <div class="nice-select-wrapper">
                                <select class="form-control nice-select" id="productos_select_ordenar_por" name="ordenar">
                                    <option value="nombre">Nombre</option>
                                    <option value="precio">Precio</option>
                                    <option value="popularidad">Popularidad</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buscar">Buscar por nombre:</label>
                            <input type="text" class="form-control" id="filtrar_por_nombre" name="buscar" placeholder="Filtrar por nombre">
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-md-12 col-sm-12">
                    <div class="contenedorCards" id="contenedor_cards_productos">
                        <?php foreach ($array_productos_destacados as $item) : ?>
                            <div class="card">
                                <div class="wrapper">
                                    <div class="colorProd"></div>
                                    <div class="imgProd" style="background-image: url(<?= $item['url_imagen_principal'] ?>);"></div>
                                    <div class="infoProd">
                                        <p class="nombreProd"><?= $item['nombre'] ?></p>
                                        <div class="actions">
                                            <div class="preciosGrupo">
                                                <p class="precio precioOferta"><?= $item['precio_pvr'] ?></p>
                                                <p class="precio precioProd"><?= $item['precio_actual'] ?></p>
                                            </div>
                                            <div class="icono action aFavs" onclick="fn_agregar_producto_a_favoritos('<?= $item['referencia_producto'] ?>',1)">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                                    <path d="M47 5c-6.5 0-12.9 4.2-15 10-2.1-5.8-8.5-10-15-10A15 15 0 0 0 2 20c0 13 11 26 30 39 19-13 30-26 30-39A15 15 0 0 0 47 5z">
                                                    </path>
                                                </svg>
                                            </div>
                                            <div class="icono action alCarrito" onclick="fn_agregar_producto_al_carrito('<?= $item['referencia_producto'] ?>',1)">
                                                <svg class="inCart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                                    <title>Quitar del carrito</title>
                                                    <path d="M30 22H12M2 6h6l10 40h32l3.2-9.7"></path>
                                                    <circle cx="20" cy="54" r="4"></circle>
                                                    <circle cx="46" cy="54" r="4"></circle>
                                                    <circle cx="46" cy="22" r="16"></circle>
                                                    <path d="M53 18l-8 9-5-5"></path>
                                                </svg>
                                                <svg class="outCart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                                    <title>Agregar al carrito</title>
                                                    <path d="M2 6h10l10 40h32l8-24H16"></path>
                                                    <circle cx="23" cy="54" r="4"></circle>
                                                    <circle cx="49" cy="54" r="4"></circle>
                                                </svg>
                                            </div>
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



<?php include 'includes/footer/footer.php'; ?>