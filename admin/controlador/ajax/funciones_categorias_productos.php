<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';
session_start();



/*########################################################################*/
/*##################   FUNCIONES CATEGORIA ###############################*/
/*########################################################################*/


function obn_obtener_medias_de_una_categoria($id)
{
    $info = [];
    $sql = "SELECT * FROM categoria_media WHERE categoria_id='" . mysql_esc($id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}

function obn_obtener_categorias()
{
    $info = [];
    $sql = "SELECT * FROM categorias ORDER BY nombre ASC ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_categoria'] = obn_obtener_medias_de_una_categoria($fetch['id']);
        $info[] = $fetch;
    endwhile;
    return $info;
}

function fn_guardar_info_nueva_categoria($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['categoria_guardada'] = false;
    $respuesta['resto_imagenes_guardados'] = false;
    $date = date('Y-m-d H:i:s');


    $referencia_unica_servicio = 'ref-' . time() . '_' . uniqid();

    $sql_insert = "INSERT INTO categorias SET ref_categoria='" . mysql_esc($referencia_unica_servicio) . "',
    nombre='" . mysql_esc($datos['categoria_nombre']) . "',
    descripcion='" . mysql_esc($datos['categoria_descripcion']) . "',
    categoria_descatalogada='" . mysql_esc($datos['categoria_descatalogada']) . "',
    categoria_estado='" . mysql_esc($datos['categoria_estado']) . "',
    url_imagen_principal='" . mysql_esc($datos['ruta_imagen_principal']) . "',
    created_at='" . mysql_esc($date) . "',
    updated_at='" . mysql_esc($date) . "' ";

    if (mysql_query($sql_insert)) {
        $last_id = mysql_insert_id();
        if (is_numeric($last_id)) {
            $respuesta['categoria_guardada'] = true;
            $respuesta['status'] = 'success';
            if (isset($datos['array_rutas_resto_imagenes']) && count($datos['array_rutas_resto_imagenes']) > 0) {
                foreach ($datos['array_rutas_resto_imagenes'] as $media) {
                    $sql_insert_media = "INSERT INTO categoria_media SET categoria_id='" . mysql_esc($last_id) . "',url_media='" . mysql_esc($media) . "',tipo_media='img',es_principal=0,created_at='" . mysql_esc($date) . "',updated_at='" . mysql_esc($date) . "' ";
                    mysql_query($sql_insert_media);
                    $respuesta['resto_imagenes_guardados'] = true;
                }
            }
        }
    }

    return $respuesta;
}


function fn_modificar_categoria($datos)
{
    $categoria_modificada = false;
    $date = date('Y-m-d H:i:s');


    $sql_update = "UPDATE categorias SET nombre='" . mysql_esc($datos['categoria_nombre']) . "',
    descripcion='" . mysql_esc($datos['categoria_descripcion']) . "',
    categoria_descatalogada='" . mysql_esc($datos['categoria_descatalogada']) . "',
    categoria_estado='" . mysql_esc($datos['categoria_estado']) . "',
    updated_at='" . mysql_esc($date) . "' WHERE id='" . mysql_esc($datos['categoria_id']) . "' LIMIT 1";

    if (mysql_query($sql_update)) {
        $categoria_modificada = true;
    }

    return $categoria_modificada;
}


function fn_eliminar_categoria($categoria_id)
{
    $eliminado = false;
    $sql_img_principal = mysql_query("SELECT * FROM categorias WHERE id='" . mysql_esc($categoria_id) . "' LIMIT 1");
    if ($fetch_img = mysql_fetch_assoc($sql_img_principal)) {
        if (file_exists('../../..' . $fetch_img['url_imagen_principal'])) {
            unlink('../../..' . $fetch_img['url_imagen_principal']);
        }
    }
    $sql_eliminar_categoria = "DELETE FROM categorias WHERE id='" . mysql_esc($categoria_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar_categoria)) {
        $sql = mysql_query("SELECT * FROM categoria_media WHERE categoria_id='" . mysql_esc($categoria_id) . "' ");
        while ($fetch = mysql_fetch_assoc($sql)) :
            $ruta_archivo_media = '../../..' . $fetch['url_media'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        endwhile;
        $sql_eliminar_media = "DELETE FROM categoria_media WHERE categoria_id='" . mysql_esc($categoria_id) . "'";
        mysql_query($sql_eliminar_media);
        $sql_eliminar_categoria_producto = "DELETE FROM productos_categoria WHERE categoria_id='" . mysql_esc($categoria_id) . "' ";
        mysql_query($sql_eliminar_categoria_producto);
        $eliminado = true;
    }
    return $eliminado;
}


function fn_modificar_imagen_principal_categoria($categoria_id, $nueva_url)
{
    $modificado = false;
    $sql = "SELECT * FROM categorias WHERE id='" . mysql_esc($categoria_id) . "' ";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) {
        if (isset($fetch['url_imagen_principal']) && $fetch['url_imagen_principal'] != '') {
            $ruta_archivo_media = '../../..' . $fetch['url_imagen_principal'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        }

        $sql_update = "UPDATE categorias SET url_imagen_principal='" . mysql_esc($nueva_url) . "' WHERE id='" . mysql_esc($categoria_id) . "' LIMIT 1";
        if (mysql_query($sql_update)) {
            $modificado = true;
        }
    }
    return $modificado;
}


/*########################################################################*/
/*##################   FUNCIONES PRODUCTO  ###############################*/
/*########################################################################*/


function fn_guardar_info_nuevo_producto($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['producto_guardado'] = false;
    $respuesta['resto_imagenes_guardadas'] = false;
    $date = date('Y-m-d H:i:s');


    $referencia_unica_producto = 'ref_' . time() . '_' . uniqid();

    $sql_insert = "INSERT INTO productos SET referencia_producto='" . mysql_esc($referencia_unica_producto) . "',
    nombre='" . mysql_esc($datos['producto_nombre']) . "',
    url_imagen_principal='" . mysql_esc($datos['ruta_imagen_principal']) . "',
    descripcon_larga='" . mysql_esc($datos['producto_descripcion']) . "',
    descripcion_corta='" . mysql_esc($datos['producto_descripcion_corta']) . "',
    activo='" . mysql_esc($datos['producto_estado']) . "',
    producto_destacado=0,
    mostrar_en_web='" . mysql_esc($datos['select_mostrar_en_web']) . "',
    descatalogado=0,
    ean='" . mysql_esc($datos['ean_producto']) . "',
    stock_minimo='" . mysql_esc($datos['stock_minimo']) . "',
    precio_coste='" . mysql_esc($datos['precio_de_coste']) . "',
    precio_pvr='" . mysql_esc($datos['pvr']) . "',
    en_oferta=0,
    precio_actual='" . mysql_esc($datos['precio_de_venta']) . "',
    created_at='" . mysql_esc($date) . "',
    updated_at='" . mysql_esc($date) . "' ";

    if (mysql_query($sql_insert)) {
        $last_id = mysql_insert_id();
        if (is_numeric($last_id)) {
            $respuesta['producto_guardado'] = true;
            $respuesta['status'] = 'success';
            if (isset($datos['array_rutas_resto_imagenes']) && count($datos['array_rutas_resto_imagenes']) > 0) {
                foreach ($datos['array_rutas_resto_imagenes'] as $media) {
                    $sql_insert_media = "INSERT INTO producto_media SET producto_id='" . mysql_esc($last_id) . "', url_media='" . mysql_esc($media) . "', tipo_media='img', es_principal=0, created_at='" . mysql_esc($date) . "', updated_at='" . mysql_esc($date) . "' ";
                    mysql_query($sql_insert_media);
                    $respuesta['resto_imagenes_guardadas'] = true;
                }
            }
            mysql_query("INSERT INTO productos_categoria SET producto_id='" . mysql_esc($last_id) . "',categoria_id='" . mysql_esc($datos['categoria_id']) . "',created_at='" . mysql_esc($date) . "',updated_at='" . mysql_esc($date) . "' ");

            mysql_query("INSERT INTO producto_stock SET producto_id='" . mysql_esc($last_id) . "',stock='" . mysql_esc($datos['stock_inicial']) . "',created_at='" . mysql_esc($date) . "', updated_at='" . mysql_esc($date) . "' ");
        }
    }

    return $respuesta;
}

function fn_modificar_producto($datos)
{
    $producto_modificado = false;
    $date = date('Y-m-d H:i:s');

    $sql_update = "UPDATE productos SET 
    nombre='" . mysql_esc($datos['producto_nombre']) . "',
    descripcon_larga='" . mysql_esc($datos['producto_descripcion']) . "',
    descripcion_corta='" . mysql_esc($datos['descripcion_corta']) . "',
    activo='" . mysql_esc($datos['select_producto_estado']) . "',
    producto_destacado='" . mysql_esc($datos['select_producto_destacado']) . "',
    mostrar_en_web='" . mysql_esc($datos['select_mostrar_en_web']) . "',
    descatalogado='" . mysql_esc($datos['producto_descatalogado']) . "',
    ean='" . mysql_esc($datos['ean_producto']) . "',
    stock_minimo='" . mysql_esc($datos['stock_minimo']) . "',
    precio_coste='" . mysql_esc($datos['precio_de_coste']) . "',
    precio_pvr='" . mysql_esc($datos['pvr']) . "',
    precio_actual='" . mysql_esc($datos['precio_de_venta']) . "',
    updated_at='" . mysql_esc($date) . "'  WHERE id='" . mysql_esc($datos['producto_id']) . "' LIMIT 1";

    if (mysql_query($sql_update)) {
        $producto_modificado = true;
    }

    if (is_numeric($datos['cantidad_stock'])) {
        $sql_modificar_stock_actual = "UPDATE producto_stock SET stock='" . mysql_esc($datos['cantidad_stock']) . "' WHERE producto_id='" . mysql_esc($datos['producto_id']) . "' LIMIT 1 ";
        mysql_query($sql_modificar_stock_actual);
    }

    return $producto_modificado;
}

function obn_medias_de_un_producto($id)
{
    $info = [];
    $sql = "SELECT * FROM producto_media WHERE producto_id='" . mysql_esc($id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}

function obn_obtener_categoria_del_producto($producto_id)
{
    $categoria = '';
    $sql = "SELECT id FROM categorias WHERE id IN(SELECT categoria_id FROM productos_categoria WHERE producto_id='" . mysql_esc($producto_id) . "')";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) $categoria = $fetch['id'];
    return $categoria;
}

function obn_obtener_stock_actual_del_producto($producto_id)
{
    $stock_actual = 0;
    $sql = "SELECT stock FROM producto_stock WHERE producto_id='" . mysql_esc($producto_id) . "' ORDER BY created_at DESC LIMIT 1 ";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) $stock_actual = $fetch['stock'];
    return $stock_actual;
}

function obn_producto_por_id($id)
{
    $info = [];
    $sql = "SELECT * FROM productos WHERE id='" . mysql_esc($id) . "' LIMIT 1";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        $fetch['categoria_del_producto'] = obn_obtener_categoria_del_producto($fetch['id']);
        $fetch['categorias'] = obn_obtener_categorias();
        $fetch['resto_imagenes_producto'] = obn_medias_de_un_producto($fetch['id']);
        $fetch['stock_actual'] = obn_obtener_stock_actual_del_producto($fetch['id']);
        $info = $fetch;
    endif;
    return $info;
}

function fn_eliminar_producto($producto_id)
{
    $eliminado = false;
    $sql_img_principal = mysql_query("SELECT * FROM productos WHERE id='" . mysql_esc($producto_id) . "' LIMIT 1");
    if ($fetch_img = mysql_fetch_assoc($sql_img_principal)) {
        if (file_exists('../../..' . $fetch_img['url_imagen_principal'])) {
            unlink('../../..' . $fetch_img['url_imagen_principal']);
        }
    }
    $sql_eliminar_producto = "DELETE FROM productos WHERE id='" . mysql_esc($producto_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar_producto)) {
        $sql = mysql_query("SELECT * FROM producto_media WHERE producto_id='" . mysql_esc($producto_id) . "' ");
        while ($fetch = mysql_fetch_assoc($sql)) :
            $ruta_archivo_media = '../../../' . $fetch['url_media'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        endwhile;
        $sql_eliminar_media = "DELETE FROM producto_media WHERE producto_id='" . mysql_esc($producto_id) . "'";
        mysql_query($sql_eliminar_media);
        $sql_eliminar_categoria_producto = "DELETE FROM productos_categoria WHERE producto_id='" . mysql_esc($producto_id) . "' ";
        mysql_query($sql_eliminar_categoria_producto);
        $sql_eliminar_producto_stock = "DELETE FROM producto_stock WHERE producto_id='" . mysql_esc($producto_id) . "'";
        mysql_query($sql_eliminar_producto_stock);
        $eliminado = true;
    }
    return $eliminado;
}

function fn_modificar_imagen_principal_producto($producto_id, $nueva_url)
{
    $modificado = false;
    $sql = "SELECT * FROM productos WHERE id='" . mysql_esc($producto_id) . "' ";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) {
        if (isset($fetch['url_imagen_principal']) && $fetch['url_imagen_principal'] != '') {
            $ruta_archivo_media = '../../..' . $fetch['url_imagen_principal'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        }

        $sql_update = "UPDATE productos SET url_imagen_principal='" . mysql_esc($nueva_url) . "' WHERE id='" . mysql_esc($producto_id) . "' LIMIT 1";
        if (mysql_query($sql_update)) {
            $modificado = true;
        }
    }
    return $modificado;
}



/*#############################################*/
/*##################   POSTS  #################*/
/*#############################################*/

if (isset($_POST['accion']) && $_POST['accion'] != '') {
    switch ($_POST['accion']) {

        case 'guardar_nueva_categoria':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['categoria_creada'] = false;
            $respuesta['datos_categoria'] = [];
            $respuesta['datos_categoria']['array_rutas_resto_imagenes'] = [];

            // Obtener los valores del formulario
            $categoria_nombre = $_POST['categoria_nombre'] ?? '';
            $categoria_descripcion = $_POST['categoria_descripcion'] ?? '';
            $categoria_estado = $_POST['categoria_estado'] ?? '';
            $categoria_descatalogada = 0;

            $respuesta['datos_categoria']['categoria_nombre'] = trim($categoria_nombre);
            $respuesta['datos_categoria']['categoria_descripcion'] = trim($categoria_descripcion);
            $respuesta['datos_categoria']['categoria_estado'] = $categoria_estado;
            $respuesta['datos_categoria']['categoria_descatalogada'] = $categoria_descatalogada;


            // Verificar si se han recibido todos los datos necesarios
            if (!empty($categoria_nombre) && !empty($categoria_descripcion)) {


                // Procesar la imagen principal
                $carpetaUploads = '../../../admin/uploads/imgs/categorias/';
                $nombreArchivoPrincipal = '';

                if (isset($_FILES['categoria_imagen_principal']) && $_FILES['categoria_imagen_principal']['error'] == UPLOAD_ERR_OK) {
                    $nombreArchivoPrincipal = time() . '_' . uniqid() . '_' . $_FILES['categoria_imagen_principal']['name'];

                    if (move_uploaded_file($_FILES['categoria_imagen_principal']['tmp_name'], $carpetaUploads . $nombreArchivoPrincipal)) {
                        $respuesta['datos_categoria']['ruta_imagen_principal'] = '/admin/uploads/imgs/categorias/' . $nombreArchivoPrincipal;
                    }
                }

                // Procesar imágenes adicionales
                $nombreArchivosAdicionales = [];

                if (isset($_FILES['categoria_resto_imagenes']) && !empty($_FILES['categoria_resto_imagenes'])) {
                    foreach ($_FILES['categoria_resto_imagenes']['tmp_name'] as $index => $tmpName) {
                        $nombreArchivoAdicional = time() . '_' . uniqid() . '_' . $_FILES['categoria_resto_imagenes']['name'][$index];
                        if (move_uploaded_file($tmpName, $carpetaUploads . $nombreArchivoAdicional)) {
                            $respuesta['datos_categoria']['array_rutas_resto_imagenes'][] = '/admin/uploads/imgs/categorias/' . $nombreArchivoAdicional;
                        }
                    }
                }

                $categoria_guardada = fn_guardar_info_nueva_categoria($respuesta['datos_categoria']);
                if ($categoria_guardada['categoria_guardada'] == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['categoria_creada'] = true;
                }
            }


            echo json_encode($respuesta);
            break;


        case 'modificar_categoria':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['categoria_modificada'] = false;
            $respuesta['datos_categoria'] = [];

            // Obtener los valores del formulario
            $categoria_id = $_POST['categoria_id'] ?? '';
            $categoria_nombre = $_POST['categoria_nombre'] ?? '';
            $categoria_descripcion = $_POST['categoria_descripcion'] ?? '';
            $categoria_estado = $_POST['categoria_estado'] ?? '';
            $categoria_descatalogada = $_POST['categoria_descatalogada'] ?? 0;

            $respuesta['datos_categoria']['categoria_id'] = $categoria_id;
            $respuesta['datos_categoria']['categoria_nombre'] = trim($categoria_nombre);
            $respuesta['datos_categoria']['categoria_descripcion'] = trim($categoria_descripcion);
            $respuesta['datos_categoria']['categoria_estado'] = $categoria_estado;
            $respuesta['datos_categoria']['categoria_descatalogada'] = $categoria_descatalogada;

            // Verificar si se han recibido todos los datos necesarios

            $categoria_modificada = fn_modificar_categoria($respuesta['datos_categoria']);
            if ($categoria_modificada) {
                $respuesta['status'] = 'success';
                $respuesta['categoria_modificada'] = true;
            }

            echo json_encode($respuesta);
            break;

        case 'eliminar_categoria':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['categoria_id'] = $_POST['categoria_id'] ?? '';
            if (is_numeric($respuesta['categoria_id'])) {
                $eliminado = fn_eliminar_categoria($respuesta['categoria_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;


        case 'eliminar_imagen_categoria':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['media_id'] = $_POST['media_id'] ?? '';
            if (is_numeric($respuesta['media_id'])) {
                $url_imagen_categoria = '';
                $sql_obtener_url = mysql_query("SELECT * FROM categoria_media WHERE id='" . mysql_esc($respuesta['media_id']) . "' ");
                if ($fetch_url = mysql_fetch_assoc($sql_obtener_url)) {
                    $url_imagen_categoria = $fetch_url['url_media'];
                    $sql_delete_imagen = "DELETE FROM categoria_media WHERE id='" . mysql_esc($respuesta['media_id']) . "' LIMIT 1";
                    if (mysql_query($sql_delete_imagen)) {
                        $respuesta['status'] = 'success';
                        if (file_exists('../../..' . $url_imagen_categoria)) {
                            unlink('../../..' . $url_imagen_categoria);
                        }
                    }
                }
            }
            echo json_encode($respuesta);
            break;



        case 'anyadir_mas_imagenes_categoria':
            $respuesta = [];
            $respuesta['datos_post'] = [];
            $respuesta['datos_post']['categoria_id'] = $_POST['categoria_id'] ?? '';
            $respuesta['datos_post']['array_rutas_resto_imagenes'] = [];
            $respuesta['status'] = 'error';
            $respuesta['message'] = 'Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.';
            $fecha_hoy = date('Y-m-d H:i:s');
            $nombreArchivosAdicionales = [];
            $carpetaUploads = '../../../admin/uploads/imgs/categorias/';

            // Verificar el número actual de imágenes para la categoría
            $sql = "SELECT COUNT(*) AS num_imagenes FROM categoria_media WHERE categoria_id = '" . mysql_esc($respuesta['datos_post']['categoria_id']) . "'";
            $result = mysql_query($sql);
            $row = mysql_fetch_assoc($result);
            $num_imagenes_actuales = $row['num_imagenes'];

            // Verificar si el número actual de imágenes es menor que 4
            if ($num_imagenes_actuales < 4) {
                // Calcular cuántas imágenes se están intentando insertar
                $num_nuevas_imagenes = count($_FILES['imagenes']['tmp_name']);

                // Verificar si el número total de imágenes después de la inserción excede el límite
                if (($num_imagenes_actuales + $num_nuevas_imagenes) <= 4) {
                    if (!empty($_FILES['imagenes'])) {
                        foreach ($_FILES['imagenes']['tmp_name'] as $index => $tmpName) {
                            $nombreArchivoAdicional = time() . '_' . uniqid() . '_' . $_FILES['imagenes']['name'][$index];
                            if (move_uploaded_file($tmpName, $carpetaUploads . $nombreArchivoAdicional)) {
                                $nueva_url = '/admin/uploads/imgs/categorias/' . $nombreArchivoAdicional;
                                $sql = "INSERT INTO categoria_media SET categoria_id='" . mysql_esc($respuesta['datos_post']['categoria_id']) . "' ,tipo_media='img',es_principal=0, url_media='" . mysql_esc($nueva_url) . "' ,created_at='" . mysql_esc($fecha_hoy) . "' , updated_at='" . mysql_esc($fecha_hoy) . "' ";
                                if (mysql_query($sql)) {
                                    $image_id = mysql_insert_id();
                                    $respuesta['datos_post']['array_rutas_resto_imagenes'][] = ['nueva_url' => $nueva_url, 'id' => $image_id];
                                } else {
                                    if (file_exists('../../..' . $nueva_url)) {
                                        unlink('../../..' . $nueva_url);
                                    }
                                }
                            };
                        }
                        $respuesta['status'] = 'success';
                        $respuesta['message'] = 'Operación realizada correctamente';
                    }
                } else {
                    $respuesta['message'] = 'No puedes guardar más de 4 imágenes en total.';
                }
            } else {
                $respuesta['message'] = 'No puedes guardar más de 4 imágenes.';
            }

            echo json_encode($respuesta);
            break;

        case 'modificar_imagen_principal_categoria':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $categoria_id = $_POST['categoria_id'] ?? null;

            if (is_numeric($categoria_id)) {
                // Verificar si se recibió un archivo
                if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK) {
                    $carpetaUploads = '../../../admin/uploads/imgs/categorias/';
                    $nombre = time() . '_' . uniqid() . '_' . $_FILES['imagen_principal']['name'];
                    if (move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $carpetaUploads . $nombre)) {
                        $nueva_url = '/admin/uploads/imgs/categorias/' . $nombre;
                        // Llamar a la función para modificar la URL de la imagen en la base de datos
                        $modificado = fn_modificar_imagen_principal_categoria($categoria_id, $nueva_url);
                        if ($modificado) {
                            $respuesta['status'] = 'success';
                            $respuesta['nueva_url'] = $nueva_url;
                        }
                    }
                }
            }
            echo json_encode($respuesta);
            break;

            /*##########################################################################*/
            /*######################## CASOS PRODUCTO ##################################*/
            /*##########################################################################*/

        case 'guardar_nuevo_producto':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['producto_creado'] = false;
            $respuesta['datos_producto'] = [];
            $respuesta['datos_producto']['array_rutas_resto_imagenes'] = [];

            // Obtener los valores del formulario
            $producto_nombre = $_POST['producto_nombre'] ?? '';
            $categoria_id = $_POST['select_categoria'] ?? '';
            $stock_minimo = $_POST['stock_minimo'] ?? '';
            $ean_producto = $_POST['ean_producto'] ?? '';
            $producto_descripcion = $_POST['producto_descripcion'] ?? '';
            $producto_descripcion_corta = $_POST['descripcion_corta'] ?? '';
            $producto_estado = $_POST['select_producto_estado'] ?? '';
            $precio_de_coste = $_POST['precio_de_coste'] ?? '';
            $pvr = $_POST['pvr'] ?? '';
            $precio_de_venta = $_POST['precio_de_venta'] ?? '';
            $select_mostrar_en_web = $_POST['select_mostrar_en_web'] ?? '';
            $stock_inicial = $_POST['stock_inicial'] ?? '';


            $respuesta['datos_producto']['producto_nombre'] = trim($producto_nombre);
            $respuesta['datos_producto']['categoria_id'] = $categoria_id;
            $respuesta['datos_producto']['producto_descripcion'] = trim($producto_descripcion);
            $respuesta['datos_producto']['producto_descripcion_corta'] = trim($producto_descripcion_corta);
            $respuesta['datos_producto']['producto_estado'] = $producto_estado;
            $respuesta['datos_producto']['precio_de_coste'] = $precio_de_coste;
            $respuesta['datos_producto']['pvr'] = $pvr;
            $respuesta['datos_producto']['precio_de_venta'] = $precio_de_venta;
            $respuesta['datos_producto']['stock_minimo'] = $stock_minimo;
            $respuesta['datos_producto']['ean_producto'] = $ean_producto;
            $respuesta['datos_producto']['select_mostrar_en_web'] = $select_mostrar_en_web;
            $respuesta['datos_producto']['stock_inicial'] = $stock_inicial;

            // Verificar si se han recibido todos los datos necesarios
            if (!empty($producto_nombre) && !empty($producto_descripcion)) {

                // Procesar la imagen principal
                $carpetaUploads = '../../../admin/uploads/imgs/productos/';
                $nombreArchivoPrincipal = '';

                if (isset($_FILES['producto_imagen_principal']) && $_FILES['producto_imagen_principal']['error'] == UPLOAD_ERR_OK) {
                    $nombreArchivoPrincipal = time() . '_' . uniqid() . '_' . $_FILES['producto_imagen_principal']['name'];

                    if (move_uploaded_file($_FILES['producto_imagen_principal']['tmp_name'], $carpetaUploads . $nombreArchivoPrincipal)) {
                        $respuesta['datos_producto']['ruta_imagen_principal'] = '/admin/uploads/imgs/productos/' . $nombreArchivoPrincipal;
                    }
                }

                // Procesar imágenes adicionales
                $nombreArchivosAdicionales = [];

                if (isset($_FILES['producto_resto_imagenes']) && !empty($_FILES['producto_resto_imagenes'])) {
                    foreach ($_FILES['producto_resto_imagenes']['tmp_name'] as $index => $tmpName) {
                        $nombreArchivoAdicional = time() . '_' . uniqid() . '_' . $_FILES['producto_resto_imagenes']['name'][$index];
                        if (move_uploaded_file($tmpName, $carpetaUploads . $nombreArchivoAdicional)) {
                            $respuesta['datos_producto']['array_rutas_resto_imagenes'][] = '/admin/uploads/imgs/productos/' . $nombreArchivoAdicional;
                        }
                    }
                }

                $producto_guardado = fn_guardar_info_nuevo_producto($respuesta['datos_producto']);
                if ($producto_guardado['producto_guardado'] == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['producto_creado'] = true;
                } else {
                    foreach ($respuesta['datos_producto']['array_rutas_resto_imagenes'] as $url_media) {
                        if (file_exists('../../..' . $url_media)) {
                            unlink('../../..' . $url_media);
                        }
                    }
                }
            }

            echo json_encode($respuesta);
            break;



        case 'modificar_producto':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['producto_modificado'] = false;
            $respuesta['datos_producto'] = [];

            // Verificar si se han recibido todos los datos necesarios
            if (isset($_POST['data'])) {
                $datos_producto = $_POST['data'];

                // Obtener los valores del formulario
                $respuesta['datos_producto']['producto_id'] = $datos_producto['producto_id'] ?? '';
                $respuesta['datos_producto']['producto_nombre'] = $datos_producto['producto_nombre'] ?? '';
                $respuesta['datos_producto']['descripcion_corta'] = $datos_producto['descripcion_corta'] ?? '';
                $respuesta['datos_producto']['producto_descripcion'] = $datos_producto['producto_descripcion'] ?? '';
                $respuesta['datos_producto']['select_categoria'] = $datos_producto['select_categoria'] ?? '';
                $respuesta['datos_producto']['select_producto_estado'] = $datos_producto['select_producto_estado'] ?? '';
                $respuesta['datos_producto']['precio_de_coste'] = $datos_producto['precio_de_coste'] ?? '';
                $respuesta['datos_producto']['pvr'] = $datos_producto['pvr'] ?? '';
                $respuesta['datos_producto']['precio_de_venta'] = $datos_producto['precio_de_venta'] ?? '';
                $respuesta['datos_producto']['stock_minimo'] = $datos_producto['stock_minimo'] ?? '';
                $respuesta['datos_producto']['ean_producto'] = $datos_producto['ean_producto'] ?? '';
                $respuesta['datos_producto']['select_mostrar_en_web'] = $datos_producto['select_mostrar_en_web'] ?? '';
                $respuesta['datos_producto']['producto_descatalogado'] = $datos_producto['producto_descatalogado'] ?? '';
                $respuesta['datos_producto']['select_producto_destacado'] = $datos_producto['producto_destacado'] ?? '';
                $respuesta['datos_producto']['cantidad_stock'] = $datos_producto['cantidad_stock'] ?? '';
                // Verificar si se han recibido todos los datos necesarios
                $datos_producto = $respuesta['datos_producto'];
                $producto_modificado = fn_modificar_producto($datos_producto);
                if ($producto_modificado) {
                    $respuesta['status'] = 'success';
                    $respuesta['producto_modificado'] = true;
                }
            }


            echo json_encode($respuesta);
            break;

        case 'modificar_imagen_principal_producto':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $producto_id = $_POST['producto_id'] ?? null;

            if (is_numeric($producto_id)) {
                // Verificar si se recibió un archivo
                if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK) {
                    $carpetaUploads = '../../../admin/uploads/imgs/productos/';
                    $nombre = time() . '_' . uniqid() . '_' . $_FILES['imagen_principal']['name'];
                    if (move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $carpetaUploads . $nombre)) {
                        $nueva_url = '/admin/uploads/imgs/productos/' . $nombre;

                        //$nueva_url_imagen_sin_fondo=bn_eliminar_fondo_imagen('../..'.$nueva_url);
                        //echo '<pre>'; print_r($nueva_url_imagen_sin_fondo); echo '</pre>';
                        // Llamar a la función para modificar la URL de la imagen en la base de datos
                        $modificado = fn_modificar_imagen_principal_producto($producto_id, $nueva_url);
                        if ($modificado) {
                            $respuesta['status'] = 'success';
                            $respuesta['nueva_url'] = $nueva_url;
                        }
                    }
                }
            }
            echo json_encode($respuesta);
            break;



        case 'obtener_info_producto':
            $respuesta = [];
            $respuesta['info_producto'] = [];
            $respuesta['status'] = 'error';
            $respuesta['producto_id'] = $_POST['producto_id'] ?? '';
            if (is_numeric($respuesta['producto_id'])) {
                $respuesta['info_producto'] = obn_producto_por_id($respuesta['producto_id']);
                $respuesta['status'] = 'success';
            }
            echo json_encode($respuesta);
            break;


        case 'eliminar_producto':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['producto_id'] = $_POST['producto_id'] ?? '';
            if (is_numeric($respuesta['producto_id'])) {
                $eliminado = fn_eliminar_producto($respuesta['producto_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;


        case 'eliminar_imagen_producto':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['media_id'] = $_POST['media_id'] ?? '';
            if (is_numeric($respuesta['media_id'])) {
                $url_imagen_producto = '';
                $sql_obtener_url = mysql_query("SELECT * FROM producto_media WHERE id='" . mysql_esc($respuesta['media_id']) . "' ");
                if ($fetch_url = mysql_fetch_assoc($sql_obtener_url)) {
                    $url_imagen_producto = $fetch_url['url_media'];
                    $sql_delete_imagen = "DELETE FROM producto_media WHERE id='" . mysql_esc($respuesta['media_id']) . "' LIMIT 1";
                    if (mysql_query($sql_delete_imagen)) {
                        $respuesta['status'] = 'success';
                        if (file_exists('../../..' . $url_imagen_producto)) {
                            unlink('../../..' . $url_imagen_producto);
                        }
                    }
                }
            }

            echo json_encode($respuesta);
            break;

            /*##############################*/
            /*######## POR DEFECTO #########*/
            /*##############################*/

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no proporcionada.']);
    exit();
}
