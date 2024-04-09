<?php


function fn_obtener_datos_login_admin($email, $password)
{
    $datos = [];
    $datos['admin_id'] = '';
    $datos['admin_nombre'] = '';
    $datos['admin_email'] = '';
    $datos['admin_role'] = '';
    $datos['admin_localizado'] = false;

    $sql_verificar_credenciales = "SELECT u.email as email, ad.id as admin_id , ad.admin_name as admin_name,u.* FROM user u , administrador ad WHERE ad.id=u.admin_id AND u.email='" . mysql_esc($email) . "' AND u.admin_id IS NOT NULL AND u.admin_id !='' AND u.admin_id !=0";
    $resultado_verificar_credenciales = mysql_query($sql_verificar_credenciales);

    if (mysql_num_rows($resultado_verificar_credenciales) > 0) {
        $admin = mysql_fetch_assoc($resultado_verificar_credenciales);

        if (password_verify($password, $admin['password'])) {
            $datos['admin_localizado'] = true;
            $datos['admin_nombre'] = $admin['admin_name'];
            $datos['admin_email'] = $admin['email'];
            $datos['admin_id'] = $admin['admin_id'];
            unset($admin['password']);
            $datos['data_user'] = $admin;
            $datos['data_profile'] = bt_obtener_datos_perfil_admin($datos['admin_id']) ?? '';
        }
    }

    return $datos;
}


function fn_registrar_datos_admin($email, $password, $nombre, $apellidos, $codigo_registro)
{
    $respuesta = [];
    $respuesta['estado_registro'] = false;
    $respuesta['existe_email'] = false;
    $respuesta['codigo_registro_correcto'] = true;

    $password = password_hash($password, PASSWORD_DEFAULT); // Hash del password
    $date = date('Y-m-d H:i:s');

    // Verificar si el usuario ya existe
    $sql_verificar = "SELECT * FROM user WHERE email='" . mysql_esc($email) . "'";
    $resultado_verificar = mysql_query($sql_verificar);

    if (trim($codigo_registro) != 'Ta00') {
        $respuesta['codigo_registro_correcto'] = false;
    } else {
        if (mysql_num_rows($resultado_verificar) > 0) {
            $respuesta['existe_email'] = true;
        } else {
            // Insertar nuevo usuario
            $rolesArray = ['ROLE_ADMIN', 'ROLE_USER'];
            $rolesString = json_encode($rolesArray);
            $sql_insertar_nuevo_admin = "INSERT INTO administrador SET admin_name='" . mysql_esc($nombre) . "',roles='" . mysql_esc($rolesString) . "', active=1,created_at='" . mysql_esc($date) . "' ";

            if (mysql_query($sql_insertar_nuevo_admin)) {
                $admin_id = mysql_insert_id();
                if (is_numeric($admin_id)) {
                    mysql_query("INSERT INTO admin_profile SET admin_id='" . mysql_esc($admin_id) . "',activo=1,created_at='" . mysql_esc($date) . "' ");
                    $sql_insertar = "INSERT INTO user SET name='" . mysql_esc($nombre) . "',lastname='" . mysql_esc($apellidos) . "',roles='" . mysql_esc($rolesString) . "',admin_id='" . mysql_esc($admin_id) . "',email='" . mysql_esc($email) . "',password='" . mysql_esc($password) . "',active=1,created_at='" . mysql_esc($date) . "' ";
                    if (mysql_query($sql_insertar)) {
                        $respuesta['estado_registro'] = true;
                    }
                }
            }
        }
    }

    return $respuesta;
}

function bn_obtener_banners()
{
    $banners = [];
    $sql = "SELECT * FROM banners ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $banners[] = $fetch;
    endwhile;
    return $banners;
}

function bn_obtener_elementos()
{
    $elementos = [];
    $sql = "SELECT * FROM elementos_web ORDER BY created_at ASC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $elementos[] = $fetch;
    endwhile;
    return $elementos;
}

function bt_obtener_info_suscripciones()
{
    $info = [];
    $sql = "SELECT * FROM email_suscripciones ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}


function bn_obtener_proveedores()
{
    $info = [];
    $sql = "SELECT * FROM proveedor ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}

function info_elementos_vista()
{
    $elementos = [];
    $sql = "SELECT * FROM elementos_web ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        if (!isset($elementos[$fetch['ref_elemento_id']])) $elementos[$fetch['ref_elemento_id']] = [];
        $elementos[$fetch['ref_elemento_id']] = $fetch;
    endwhile;
    return $elementos;
}

function info_testimonios()
{
    $testimonios = [];
    $sql = "SELECT * FROM testimonios ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $testimonios[] = $fetch;
    endwhile;
    return $testimonios;
}



function bn_obtener_direcciones()
{
    $direcciones = [];
    $sql = "SELECT * FROM address_empresa WHERE activo=1";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $direcciones[] = $fetch;
    endwhile;
    return $direcciones;
}

function bt_obtener_datos_perfil_admin($admin_id)
{
    $datos = [];
    $sql = "SELECT * FROM admin_profile WHERE admin_id='" . mysql_esc($admin_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $datos = $fetch;
    endwhile;
    return $datos;
}

function bt_obtener_info_roles_admin($admin_id)
{
    $datos = [];
    $sql = "SELECT * FROM administrador WHERE id='" . mysql_esc($admin_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $datos = $fetch;
    endwhile;
    return $datos;
}

function bn_obtener_administradores()
{
    $administradores = [];
    $sql = "SELECT * FROM user WHERE admin_id IS NOT NULL";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['profile_data'] = bt_obtener_datos_perfil_admin($fetch['admin_id']);
        $fetch['info_admin'] =  bt_obtener_info_roles_admin($fetch['admin_id']);
        $administradores[] = $fetch;
    endwhile;
    return $administradores;
}


function bt_obtener_info_admin($admin_id)
{
    $info = [];
    $sql = "SELECT * FROM user WHERE admin_id='" . mysql_esc($admin_id) . "' LIMIT 1";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        $fetch['profile_data'] = bt_obtener_datos_perfil_admin($fetch['admin_id']);
        $fetch['info_admin'] =  bt_obtener_info_roles_admin($fetch['admin_id']);
        $info = $fetch;
    endif;
    return $info;
}


function bn_obtener_datos_ficales()
{
    $datos = [];
    $datos['resto_de_direcciones'] = [];
    $datos['direccion_principal'] = [];
    $sql = "SELECT * FROM datos_fiscales";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        $datos = $fetch;
        $direcciones = bn_obtener_direcciones();
        if (!empty($direcciones)) {
            foreach ($direcciones as $direccion) {
                if ($direccion['es_principal'] == 1) {
                    $datos['direccion_principal'] = $direccion;
                } else {
                    $datos['resto_de_direcciones'][] = $direccion;
                }
            }
        }
    endif;
    return $datos;
}


function obtener_imagenes_servicios($servicio_id)
{
    $respuesta = [];
    $sql = "SELECT * FROM servicio_media WHERE servicio_id='" . mysql_esc($servicio_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $respuesta[] = $fetch;
    endwhile;
    return $respuesta;
}

function bn_obtener_servicios_circuitos()
{
    $servicios = [];

    $sql = "SELECT * FROM productos_servicios ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $temp = [];
        $temp['imagen_principal'] = '';
        $temp['resto_imagenes'] = [];
        $temp['servicio_id'] = $fetch['id'];
        $temp['url_img_landing'] = $fetch['url_img_landing'];
        $temp['ref_servicio_id'] = $fetch['ref_servicio'];
        $temp['servicio_tipo'] = $fetch['servicio_tipo'];
        $temp['servicio_titulo'] = $fetch['servicio_titulo'];
        $temp['servicio_titulo_largo'] = $fetch['servicio_titulo_largo'];
        $temp['servicio_descripcion'] = $fetch['servicio_descripcion'];
        $temp['descripcion_dos'] = $fetch['descripcion_dos'];
        $temp['descripcion_tres'] = $fetch['descripcion_tres'];
        $temp['precio_servicio'] = $fetch['precio_servicio'];
        $temp['porcentaje'] = $fetch['porcentaje'];
        $temp['precio_a_adelantar'] = $fetch['precio_a_adelantar'];
        $temp['estado'] = $fetch['estado'];
        $temp['mostrar_en_web'] = $fetch['mostrar_en_web'];
        $temp['particular_o_empresa'] = $fetch['particular_o_empresa'];
        $temp['created_at'] = $fetch['created_at'];
        $temp['updated_at'] = $fetch['updated_at'];
        $items_inlcuido_no_incluido = bn_obtener_items_incluidos_y_no_incluidos($fetch['id']);
        $temp['array_incluidos_y_no_incluidos'] = $items_inlcuido_no_incluido['items_del_servicio'];
        $temp['items_por_incluido_id'] = $items_inlcuido_no_incluido['items_por_incluido_id'];
        $imagenes = obtener_imagenes_servicios($fetch['id']);
        if (count($imagenes) > 0) {
            foreach ($imagenes as $imagen) {
                if ($imagen['es_principal']) {
                    $temp['imagen_principal'] = $imagen['url'];
                } else {
                    $temp['resto_imagenes'][] = $imagen['url'];
                    $temp['resto_imagenes_info_completa'][] = $imagen;
                }
            }
        }

        $servicios[] = $temp;
    endwhile;

    return $servicios;
}

function bn_obtener_items_servicios_incluidos_by_id($id)
{
    $info = [];
    $sql = "SELECT * FROM tabla_incluidos WHERE id='" . mysql_esc($id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $info = $fetch;
    endwhile;
    return $info;
}



function bn_obtener_items_incluidos_y_no_incluidos($servicio_id, $mostrar = false)
{
    $items = [];
    $items['items_del_servicio'] = [];
    $items['items_por_incluido_id'] = [];
    if ($mostrar == true) {
        $sql = "SELECT * FROM info_servs_incluidos WHERE servicio_id='" . mysql_esc($servicio_id) . "' AND mostrar_en_web=1 ";
    }
    $sql = "SELECT * FROM info_servs_incluidos WHERE servicio_id='" . mysql_esc($servicio_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['mas_info'] = bn_obtener_items_servicios_incluidos_by_id($fetch['incluido_id']);
        $items['items_del_servicio'][] = $fetch;
        if (!isset($items['items_por_incluido_id'][$fetch['incluido_id']])) {
            $items['items_por_incluido_id'][$fetch['incluido_id']] = [];
        }
        $items['items_por_incluido_id'][$fetch['incluido_id']] = $fetch;
    endwhile;
    return $items;
}


function bn_obtener_items_incluidos_y_no_incluidos_de_un_complemento($complemento_id, $mostrar = false)
{
    $items = [];
    $items['items_del_servicio'] = [];
    $items['items_por_incluido_id'] = [];
    if ($mostrar == true) {
        $sql = "SELECT * FROM info_servs_incluidos WHERE complemento_id='" . mysql_esc($complemento_id) . "' AND mostrar_en_web=1 ";
    }
    $sql = "SELECT * FROM info_servs_incluidos WHERE complemento_id='" . mysql_esc($complemento_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['mas_info'] = bn_obtener_items_servicios_incluidos_by_id($fetch['incluido_id']);
        $items['items_del_servicio'][] = $fetch;
        if (!isset($items['items_por_incluido_id'][$fetch['incluido_id']])) {
            $items['items_por_incluido_id'][$fetch['incluido_id']] = [];
        }
        $items['items_por_incluido_id'][$fetch['incluido_id']] = $fetch;
    endwhile;
    return $items;
}

function bn_obtener_info_servicio_por_referencia($refencia)
{
    $info_servicio = [];
    $sql = "SELECT * FROM productos_servicios WHERE ref_servicio='" . mysql_esc($refencia) . "' LIMIT 1";

    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $fetch['imagen_principal'] = '';
        $fetch['resto_imagenes'] = [];
        $fetch['complementos'] = bt_obtener_complementos_por_servicio_id($fetch['id']);
        $fetch['array_incluidos_y_no_incluidos'] = bn_obtener_items_incluidos_y_no_incluidos($fetch['id'], true)['items_del_servicio'];
        $imagenes = obtener_imagenes_servicios($fetch['id']);
        if (count($imagenes) > 0) {
            foreach ($imagenes as $imagen) {
                if ($imagen['es_principal']) {
                    $fetch['imagen_principal'] = $imagen['url'];
                } else {
                    $fetch['resto_imagenes'][] = $imagen['url'];
                }
            }
        }
        $info_servicio['info_servicio'] = $fetch;
    endwhile;

    return $info_servicio;
}

function bn_obtener_imagenes_complemento($complemento_id)
{
    $respuesta = [];
    $sql = "SELECT * FROM complemento_media WHERE complemento_id='" . mysql_esc($complemento_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $respuesta[] = $fetch;
    endwhile;
    return $respuesta;
}


function bt_obtener_complementos()
{
    $complementos = [];

    $sql = "SELECT * FROM complementos ORDER BY created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $temp = [];
        $fetch['imagen_principal'] = '';
        $fetch['resto_imagenes_info_completa'] = [];
        $imagenes = bn_obtener_imagenes_complemento($fetch['id']);
        if (count($imagenes) > 0) {
            foreach ($imagenes as $imagen) {
                if ($imagen['es_principal']) {
                    $fetch['imagen_principal'] = $imagen['url_archivo'];
                } else {
                    $fetch['resto_imagenes'][] = $imagen['url_archivo'];
                    $fetch['resto_imagenes_info_completa'][] = $imagen;
                }
            }
        }
        $temp = $fetch;

        $complementos[] = $temp;
    endwhile;

    return $complementos;
}


function bt_obtener_complemento_by_id($complemento_id)
{
    $info = [];

    $sql = "SELECT * FROM complementos WHERE id='" . mysql_esc($complemento_id) . "' ";
    $respuesta = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($respuesta)) :
        $fetch['imagen_principal'] = '';
        $fetch['resto_imagenes_info_completa'] = [];
        $imagenes = bn_obtener_imagenes_complemento($fetch['id']);
        $fetch['array_info_servicios_inluidos'] = bn_obtener_items_incluidos_y_no_incluidos_de_un_complemento($complemento_id, $mostrar = false);
        $fetch['servicios_nuevos_a_mostrar'] = [];

        if (count($imagenes) > 0) {
            foreach ($imagenes as $imagen) {
                if ($imagen['es_principal']) {
                    $fetch['imagen_principal'] = $imagen['url_archivo'];
                } else {
                    $fetch['resto_imagenes'][] = $imagen['url_archivo'];
                    $fetch['resto_imagenes_info_completa'][] = $imagen;
                }
            }
        }

        $sql_incluidos = mysql_query("SELECT * FROM tabla_incluidos WHERE mostrar_para_seleccionar=1 AND id NOT IN(SELECT incluido_id FROM info_servs_incluidos WHERE complemento_id='" . mysql_esc($complemento_id) . "') ORDER BY nombre ASC");
        while ($fetch_lite = mysql_fetch_assoc($sql_incluidos)) :
            $fetch['servicios_nuevos_a_mostrar'][] = $fetch_lite;
        endwhile;

        $info = $fetch;
    endif;

    return $info;
}

function bt_obtener_complementos_por_servicio_id($servicio_id)
{
    $complementos = [];
    $sql = "SELECT c.*,sc.mostrar_en_web as mostrar_en_web FROM complementos c INNER JOIN servicio_complemento sc ON sc.complemento_id=c.id WHERE servicio_id='" . mysql_esc($servicio_id) . "' ORDER BY c.created_at DESC";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        $temp = [];
        $fetch['imagen_principal'] = '';
        $fetch['resto_imagenes_info_completa'] = [];
        $imagenes = bn_obtener_imagenes_complemento($fetch['id']);
        if (count($imagenes) > 0) {
            foreach ($imagenes as $imagen) {
                if ($imagen['es_principal']) {
                    $fetch['imagen_principal'] = $imagen['url_archivo'];
                } else {
                    $fetch['resto_imagenes'][] = $imagen['url_archivo'];
                    $fetch['resto_imagenes_info_completa'][] = $imagen;
                }
            }
        }
        $temp = $fetch;

        $complementos[] = $temp;
    endwhile;

    return $complementos;
}


function bn_obtener_medias_de_una_categoria($id)
{
    $info = [];
    $sql = "SELECT * FROM categoria_media WHERE categoria_id='" . mysql_esc($id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}


function bn_obtener_categorias()
{
    $info = [];
    $sql = "SELECT * FROM categorias ORDER BY nombre ASC ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_categoria'] = bn_obtener_medias_de_una_categoria($fetch['id']);
        $info[] = $fetch;
    endwhile;
    return $info;
}




function bn_obtener_medias_de_un_producto($id)
{
    $info = [];
    $sql = "SELECT * FROM producto_media WHERE producto_id='" . mysql_esc($id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $info[] = $fetch;
    endwhile;
    return $info;
}


function bn_obtener_productos()
{
    $info = [];
    $sql = "SELECT * FROM productos ORDER BY nombre ASC ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_producto'] = bn_obtener_medias_de_un_producto($fetch['id']);
        $info[] = $fetch;
    endwhile;
    return $info;
}

function bt_productos_destacados()
{
    $info = [];
    $sql = "SELECT * FROM productos WHERE mostrar_en_web=1 AND producto_destacado = 1 AND activo=1 AND descatalogado=0 ORDER BY nombre ASC ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_producto'] = bn_obtener_medias_de_un_producto($fetch['id']);
        $info[] = $fetch;
    endwhile;
    return $info;
}
function bn_obtener_producto_por_id($id)
{
    $info = [];
    $sql = "SELECT * FROM productos WHERE id='" . mysql_esc($id) . "' LIMIT 1";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_producto'] = bn_obtener_medias_de_un_producto($fetch['id']);
        $info = $fetch;
    endif;
    return $info;
}

function bn_obtener_producto_por_referencia($ref)
{
    $info = [];
    $sql = "SELECT * FROM productos WHERE referencia_producto='" . mysql_esc($ref) . "' LIMIT 1";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_producto'] = bn_obtener_medias_de_un_producto($fetch['id']);
        $info = $fetch;
    endif;
    return $info;
}

function bn_obtener_productos_por_categoria($categoria_ref)
{
    $info = [];
    $sql = "SELECT * FROM productos WHERE id IN(SELECT producto_id FROM productos_categoria WHERE categoria_id IN(SELECT id FROM categorias WHERE ref_categoria='" . mysql_esc($categoria_ref) . "')) ORDER BY nombre ASC ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        $fetch['resto_imagenes_producto'] = bn_obtener_medias_de_un_producto($fetch['id']);
        $info[] = $fetch;
    endwhile;
    return $info;
}

function bn_eliminar_fondo_imagen($url_imagen)
{
    // Obtener la extensión del archivo
    $extension = pathinfo($url_imagen, PATHINFO_EXTENSION);

    // Cargar la imagen según la extensión
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            $imagen = imagecreatefromjpeg($url_imagen);
            break;
        case 'png':
            $imagen = imagecreatefrompng($url_imagen);
            break;
        case 'gif':
            $imagen = imagecreatefromgif($url_imagen);
            break;
        default:
            // Si la extensión no es compatible, no se puede procesar la imagen
            return false;
    }

    // Obtener el ancho y alto de la imagen
    $ancho = imagesx($imagen);
    $alto = imagesy($imagen);

    // Crear un nuevo lienzo con fondo blanco del mismo tamaño que la imagen original
    $nueva_imagen = imagecreatetruecolor($ancho, $alto);
    $fondo_blanco = imagecolorallocate($nueva_imagen, 255, 255, 255);
    imagefill($nueva_imagen, 0, 0, $fondo_blanco);

    // Copiar la imagen original en el nuevo lienzo
    imagecopy($nueva_imagen, $imagen, 0, 0, 0, 0, $ancho, $alto);

    // Generar el nombre y la ruta para la nueva imagen
    $nombre_nueva_imagen = time() . '_' . uniqid() . '.' . $extension;
    $ruta_nueva_imagen = '../../admin/uploads/imgs/productos/' . $nombre_nueva_imagen;

    // Guardar la nueva imagen con fondo blanco
    switch ($extension) {
        case 'jpg':
        case 'jpeg':
            imagejpeg($nueva_imagen, $ruta_nueva_imagen);
            break;
        case 'png':
            imagepng($nueva_imagen, $ruta_nueva_imagen);
            break;
        case 'gif':
            imagegif($nueva_imagen, $ruta_nueva_imagen);
            break;
    }

    // Liberar memoria
    imagedestroy($imagen);
    imagedestroy($nueva_imagen);

    $nueva_url_img = str_replace('../..', '', $ruta_nueva_imagen);
    return $nueva_url_img;
}
