<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';
session_start();


function complemento_modificar_ver_en_web($datos)
{
    $modificado = false;
    $fecha = date('Y-m-d H:i:s');
    $sql_modificar = "UPDATE servicio_complemento SET mostrar_en_web='" . mysql_esc(trim($datos['ver_en_web'])) . "',updated_at='" . mysql_esc($fecha) . "' WHERE id='" . mysql_esc($datos['id']) . "' LIMIT 1";
    if (mysql_query($sql_modificar)) $modificado = true;
    return $modificado;
}


function fn_guardar_info_nuevo_complemento($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['complemento_guardado'] = false;
    $respuesta['imagen_principal_guardada'] = false;
    $respuesta['resto_imagenes_guardados'] = false;
    $date = date('Y-m-d H:i:s');

    $add_sql = "";

    if (isset($datos['tiene_fecha_caducidad']) && $datos['tiene_fecha_caducidad']  == 1) {
        if ($datos['fecha_ini'] != '' && $datos['fecha_fin'] != '') {
            $fecha_ini = $datos['fecha_ini'] . ' 00:00:00';
            $fecha_fin = $datos['fecha_fin'] . ' 23:59:59';
            $add_sql = ",fecha_ini='" . mysql_esc($fecha_ini) . "', fecha_fin='" . mysql_esc($fecha_fin) . "' ";
        }
    }

    $referencia_unica_servicio = 'ref-' . time() . '_' . uniqid();

    $sql_insert = "INSERT INTO complementos SET ref_complemento='" . mysql_esc($referencia_unica_servicio) . "',
    titulo_complemento='" . mysql_esc($datos['titulo_complemento']) . "',
    descripcion_complemento='" . mysql_esc($datos['descripcion_complemento']) . "',
    precio_complemento='" . mysql_esc($datos['precio_complemento']) . "',
    porcentaje_complemento='" . mysql_esc($datos['select_porcentaje_complemento']) . "',
    cantidad_a_adelantar='" . mysql_esc($datos['cantidad_a_ingresar']) . "',
    active='" . mysql_esc($datos['select_estado_complemento']) . "',
    tiene_fecha_caducidad='" . mysql_esc($datos['select_complemento_tiene_caducidad']) . "',
    created_at='" . mysql_esc($date) . "',
    updated_at='" . mysql_esc($date) . "'
    " . $add_sql;

    if (mysql_query($sql_insert)) {
        $last_id = mysql_insert_id();
        if (is_numeric($last_id)) {

            $respuesta['complemento_guardado'] = true;

            if (count($datos['array_servicios_incluidos']) > 0) {
                foreach ($datos['array_servicios_incluidos'] as $incluido) {
                    $sql_incluido = "INSERT INTO info_servs_incluidos SET complemento_id='" . mysql_esc($last_id) . "',mostrar_en_web=1,incluido_id='" . mysql_esc($incluido) . "',es_incluido=1,created_at='" . mysql_esc($date) . "' ";
                    mysql_query($sql_incluido);
                }
            }

            if (count($datos['array_servicios_no_incluidos']) > 0) {
                foreach ($datos['array_servicios_no_incluidos'] as $no_incluido) {
                    $sql_no_incluido = "INSERT INTO info_servs_incluidos SET complemento_id='" . mysql_esc($last_id) . "',mostrar_en_web=1,incluido_id='" . mysql_esc($no_incluido) . "',es_incluido=0,created_at='" . mysql_esc($date) . "' ";
                    mysql_query($sql_no_incluido);
                }
            }

            $sql_insert_media_principal = "INSERT INTO complemento_media SET complemento_id='" . mysql_esc($last_id) . "',
            url_archivo='" . mysql_esc($datos['ruta_imagen_principal']) . "',
            es_principal=1,
            active=1,
            created_at='" . mysql_esc($date) . "',
            updated_at='" . mysql_esc($date) . "'
            ";
            if (mysql_query($sql_insert_media_principal)) {
                $respuesta['imagen_principal_guardada'] = true;
            };

            if (count($datos['array_rutas_resto_imagenes']) > 0) {
                foreach ($datos['array_rutas_resto_imagenes'] as $imagen_segundaria_url) {
                    $sql_insert_media_secundaria = "INSERT INTO complemento_media SET complemento_id='" . mysql_esc($last_id) . "',
                url_archivo='" . mysql_esc($imagen_segundaria_url) . "',
                es_principal=0,
                active=1,
                created_at='" . mysql_esc($date) . "',
                updated_at='" . mysql_esc($date) . "'
                ";
                    mysql_query($sql_insert_media_secundaria);
                }
                $respuesta['resto_imagenes_guardados'] = true;
            }
        }
    }

    return $respuesta;
}

function fn_eliminar_complemento($complemento_id)
{
    $eliminado = false;
    $sql_eliminar_complemento_de_los_servicios = "DELETE FROM complementos WHERE id='" . mysql_esc($complemento_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar_complemento_de_los_servicios)) {
        $sql = mysql_query("SELECT * FROM complemento_media WHERE complemento_id='" . mysql_esc($complemento_id) . "' ");
        while ($fetch = mysql_fetch_assoc($sql)) :
            $ruta_archivo_media = '../..' . $fetch['url_archivo'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        endwhile;
        $sql_eliminar_media = "DELETE FROM complemento_media WHERE complemento_id='" . mysql_esc($complemento_id) . "'";
        mysql_query($sql_eliminar_media);
        $sql_eliminar_complemento = "DELETE FROM servicio_complemento WHERE complemento_id='" . mysql_esc($complemento_id) . "' ";
        mysql_query($sql_eliminar_complemento);
        $eliminado = true;
    }
    return $eliminado;
}

function fn_modificar_datos_del_compelemento($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['complemento_modificado'] = false;

    $date = date('Y-m-d H:i:s');
    $add_sql = "";

    if ($datos['select_complemento_tiene_caducidad'] == 1) {
        if ($datos['complemento_fecha_ini'] != '' && $datos['complemento_fecha_fin'] != '') {
            $fecha_ini = $datos['complemento_fecha_ini'] . ' 00:00:00';
            $fecha_fin = $datos['complemento_fecha_fin'] . ' 23:59:59';
            $add_sql = ",fecha_ini='" . mysql_esc($fecha_ini) . "', fecha_fin='" . mysql_esc($fecha_fin) . "' ";
        }
    }


    $sql_update = "UPDATE complementos SET titulo_complemento='" . mysql_esc(trim($datos['titulo_complemento'])) . "',
    descripcion_complemento='" . mysql_esc(trim($datos['descripcion_complemento'])) . "',
    precio_complemento='" . mysql_esc($datos['precio_complemento']) . "',
    porcentaje_complemento='" . mysql_esc($datos['select_porcentaje_complemento']) . "',
    cantidad_a_adelantar='" . mysql_esc($datos['cantidad_a_ingresar']) . "',
    active='" . mysql_esc($datos['select_estado_complemento']) . "',
    tiene_fecha_caducidad='" . mysql_esc($datos['select_complemento_tiene_caducidad']) . "',
    updated_at='" . mysql_esc($date) . "' " . $add_sql . " WHERE id='" . mysql_esc($datos['complemento_id']) . "' LIMIT 1";

    if (mysql_query($sql_update)) {
        $respuesta['complemento_modificado'] = true;
    }

    return $respuesta;
}


if (isset($_POST['accion']) && $_POST['accion'] != '') {

    switch ($_POST['accion']) {

        case 'guardar_nuevo_complemento':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['complemento_creado'] = false;
            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['select_estado_complemento'] = $_POST['select_estado_complemento'] ?? '';
            $respuesta['datos_post']['select_complemento_tiene_caducidad'] = $_POST['select_complemento_tiene_caducidad'] ?? '';
            $respuesta['datos_post']['titulo_complemento'] = trim($_POST['titulo_complemento']) ?? '';
            $respuesta['datos_post']['descripcion_complemento'] = trim($_POST['descripcion_complemento']) ?? '';
            $respuesta['datos_post']['precio_complemento'] = $_POST['precio_complemento'] ?? '';
            $respuesta['datos_post']['select_porcentaje_complemento'] = $_POST['select_porcentaje_complemento'] ?? '';
            $respuesta['datos_post']['cantidad_a_ingresar'] = $_POST['cantidad_a_ingresar'] ?? '';
            $respuesta['datos_post']['fecha_ini'] = $_POST['complemento_fecha_ini'] ?? '';
            $respuesta['datos_post']['fecha_fin'] = $_POST['complemento_fecha_fin'] ?? '';
            $respuesta['datos_post']['ruta_imagen_principal'] = '';
            $respuesta['datos_post']['array_rutas_resto_imagenes'] = [];

            if ($respuesta['datos_post']['fecha_ini'] != '') $respuesta['datos_post']['fecha_ini'] = $respuesta['datos_post']['fecha_ini'] . ' 00:00:00';
            if ($respuesta['datos_post']['fecha_fin'] != '') $respuesta['datos_post']['fecha_fin'] = $respuesta['datos_post']['fecha_fin'] . ' 23:59:59';


            if ($respuesta['datos_post']['select_estado_complemento'] == '') $respuesta['datos_post']['select_estado_complemento'] = 0;
            if ($respuesta['datos_post']['select_estado_complemento'] == '1') $respuesta['datos_post']['select_estado_complemento'] = 1;

            if ($respuesta['datos_post']['select_complemento_tiene_caducidad'] == '') $respuesta['datos_post']['select_complemento_tiene_caducidad'] = 0;
            if ($respuesta['datos_post']['select_complemento_tiene_caducidad'] == '1') $respuesta['datos_post']['select_complemento_tiene_caducidad'] = 1;


            $respuesta['datos_post']['array_servicios_incluidos'] = json_decode($_POST['array_servicios_incluidos'], true) ?? [];
            $respuesta['datos_post']['array_servicios_no_incluidos'] = json_decode($_POST['array_servicios_no_incluidos'], true) ?? [];


            if ($respuesta['datos_post']['select_complemento_tiene_caducidad'] = 0) {
                $respuesta['datos_post']['fecha_ini'] = null;
                $respuesta['datos_post']['fecha_fin'] = null;
            }
            // Lógica para manejar la imagen principal
            $carpetaUploads = '../../../admin/uploads/imgs/complementos/';
            $nombreArchivoPrincipal = '';

            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == UPLOAD_ERR_OK) {
                // Generar nombre de archivo único
                $nombreArchivoPrincipal = time() . '_' . uniqid() . '_' . $_FILES['main_image']['name'];

                // Mover la imagen al directorio de subidas
                if (move_uploaded_file($_FILES['main_image']['tmp_name'], $carpetaUploads . $nombreArchivoPrincipal)) {
                    $respuesta['datos_post']['ruta_imagen_principal'] = '/admin/uploads/imgs/complementos/' . $nombreArchivoPrincipal;
                };
            }

            // Lógica para manejar imágenes adicionales
            $nombreArchivosAdicionales = [];

            if (!empty($_FILES['additional_images'])) {
                foreach ($_FILES['additional_images']['tmp_name'] as $index => $tmpName) {
                    $nombreArchivoAdicional = time() . '_' . uniqid() . '_' . $_FILES['additional_images']['name'][$index];
                    if (move_uploaded_file($tmpName, $carpetaUploads . $nombreArchivoAdicional)) {
                        $respuesta['datos_post']['array_rutas_resto_imagenes'][] = '/admin/uploads/imgs/complementos/' . $nombreArchivoAdicional;
                    };
                }
            }

            $info_guardado = fn_guardar_info_nuevo_complemento($respuesta['datos_post']);
            if ($info_guardado['complemento_guardado'] == true) {
                $respuesta['status'] = 'success';
                $respuesta['complemento_creado'] = true;
            }

            echo json_encode($respuesta);
            break;

        case 'editar_complemento':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['complemento_editado_correctamente'] = false;
            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['select_complemento_tiene_caducidad'] = $_POST['data']['select_complemento_tiene_caducidad'] ?? '';
            $respuesta['datos_post']['select_estado_complemento'] = $_POST['data']['select_estado_complemento'] ?? '';
            $respuesta['datos_post']['titulo_complemento'] = $_POST['data']['titulo_complemento'] ?? '';
            $respuesta['datos_post']['complemento_fecha_ini'] = $_POST['data']['complemento_fecha_ini'] ?? '';
            $respuesta['datos_post']['complemento_fecha_fin'] = $_POST['data']['complemento_fecha_fin'] ?? '';
            $respuesta['datos_post']['descripcion_complemento'] = $_POST['data']['descripcion_complemento'] ?? '';
            $respuesta['datos_post']['precio_complemento'] = $_POST['data']['precio_complemento'] ?? '';
            $respuesta['datos_post']['select_porcentaje_complemento'] = $_POST['data']['select_porcentaje_complemento'] ?? '';
            $respuesta['datos_post']['cantidad_a_ingresar'] = $_POST['data']['cantidad_a_ingresar'] ?? '';
            $respuesta['datos_post']['complemento_id'] = $_POST['data']['complemento_id'] ?? '';


            if ($respuesta['datos_post']['titulo_complemento'] == '') {
                echo json_encode($respuesta);
                break;
            }
            if ($respuesta['datos_post']['descripcion_complemento'] == '') {
                echo json_encode($respuesta);
                break;
            }
            if ($respuesta['datos_post']['precio_complemento'] == '') {
                echo json_encode($respuesta);
                break;
            }
            if ($respuesta['datos_post']['cantidad_a_ingresar'] == '') {
                echo json_encode($respuesta);
                break;
            }
            if ($respuesta['datos_post']['select_porcentaje_complemento'] == '') {
                echo json_encode($respuesta);
                break;
            }

            if (is_numeric($respuesta['datos_post']['complemento_id'])) {
                $info_modificado = fn_modificar_datos_del_compelemento($respuesta['datos_post']);
                if ($info_modificado['complemento_modificado'] == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['complemento_editado_correctamente'] = true;
                }
            }

            echo json_encode($respuesta);
            break;

        case 'anyadir_complemento_a_servicio':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['anyadido'] = false;
            $data = $_POST['data'] ?? [];
            $respuesta['servicio_id'] = $data['servicio_id'] ?? '';
            $respuesta['complemento_id'] = $data['complemento_id'] ?? '';
            $respuesta['mostrar_en_web'] = $data['mostrar_en_web'] ?? 0;
            $respuesta['es_oferta'] = $data['es_oferta'] ?? 0;

            $fecha_hoy = date('Y-m-d H:i:s');
            if (is_numeric($respuesta['servicio_id']) && is_numeric($respuesta['complemento_id'])) {
                $sql = "SELECT * FROM servicio_complemento WHERE servicio_id='" . mysql_esc($respuesta['servicio_id']) . "' AND complemento_id='" . mysql_esc($respuesta['complemento_id']) . "' ";
                $result = mysql_query($sql);
                if (mysql_num_rows($result) == 0) {
                    $sql_insert = "INSERT INTO servicio_complemento SET servicio_id='" . mysql_esc($respuesta['servicio_id']) . "' , complemento_id='" . mysql_esc($respuesta['complemento_id']) . "' ,estado=1,mostrar_en_web='" . mysql_esc($respuesta['mostrar_en_web']) . "',es_oferta='" . mysql_esc($respuesta['es_oferta']) . "',created_at='" . mysql_esc($fecha_hoy) . "' ";
                    if (mysql_query($sql_insert)) {
                        $respuesta['anyadido'] = true;
                        $respuesta['status'] = 'success';
                    }
                }
            }
            echo json_encode($respuesta);
            break;

        case 'eliminar_complemento_del_servicio':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['elimnado'] = false;
            $data = $_POST['data'] ?? [];
            $respuesta['servicio_id'] = $data['servicio_id'] ?? '';
            $respuesta['complemento_id'] = $data['complemento_id'] ?? '';
            if (is_numeric($respuesta['servicio_id']) && is_numeric($respuesta['complemento_id'])) {
                $sql_insert = "DELETE FROM servicio_complemento WHERE servicio_id='" . mysql_esc($respuesta['servicio_id']) . "' AND complemento_id='" . mysql_esc($respuesta['complemento_id']) . "' ";
                if (mysql_query($sql_insert)) {
                    $respuesta['elimnado'] = true;
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;


        case 'eliminar_complemento':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['complemento_id'] = $_POST['complemento_id'] ?? '';
            if (is_numeric($respuesta['complemento_id'])) {
                $eliminado = fn_eliminar_complemento($respuesta['complemento_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        case 'obtener_info_complemento':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['complemento_id'] = $_POST['complemento_id'] ?? '';
            $respuesta['info_complemento'] = [];
            if (is_numeric($respuesta['complemento_id'])) {
                $respuesta['info_complemento'] = bt_obtener_complemento_by_id($respuesta['complemento_id']);
                $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        case 'desvincular_incluidos_del_complemento':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['complemento_id'] = $_POST['complemento_id'] ?? '';

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['complemento_id'])) {
                $sql_desvincular = "DELETE FROM info_servs_incluidos WHERE  incluido_id='" . mysql_esc($respuesta['item_id']) . "' AND complemento_id='" . mysql_esc($respuesta['complemento_id']) . "' LIMIT 1";
                if (mysql_query($sql_desvincular)) {
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;

        case 'vincular_item_con_el_complemento':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['complemento_id'] = $_POST['complemento_id'] ?? '';

            $date = date('Y-m-d H:i:s');

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['complemento_id'])) {
                $sql_vincular = "INSERT INTO info_servs_incluidos SET incluido_id='" . mysql_esc($respuesta['item_id']) . "' , complemento_id='" . mysql_esc($respuesta['complemento_id']) . "' ,mostrar_en_web=1, es_incluido=0,created_at='" . mysql_esc($date) . "' ";
                if (mysql_query($sql_vincular)) {
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;


        case 'mostrar_complemento_servicio_en_web':
            $respuesta = [];
            $respuesta['datos_post'] = $_POST['data'] ?? [];
            $respuesta['status'] = 'error';
            $respuesta['modificado'] = false;

            $data = $_POST['data'];
            $id = $data['id'] ?? '';
            $ver_en_web = $data['ver_en_web'] ?? '';

            if (is_numeric($id) && is_numeric($ver_en_web)) {
                $datos = [];
                $datos['id'] = $id;
                $datos['ver_en_web'] = $ver_en_web;
                $info_guardado = complemento_modificar_ver_en_web($datos);
                if ($info_guardado == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['modificado'] = true;
                    $respuesta['ver_en_web'] = $ver_en_web;
                }
            }
            echo json_encode($respuesta);
            break;


        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
    exit();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no proporcionada.']);
    exit();
}
