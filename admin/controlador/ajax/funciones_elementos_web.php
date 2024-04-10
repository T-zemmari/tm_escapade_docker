<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';
session_start();

function guardar_nuevo_elemento($datos)
{
    $info_guardado = [];
    $info_guardado['guardar'] = false;
    $info_guardado['existe'] = false;
    //$info_guardado['sql'] = '';
    $info_guardado['ref_elemento_id'] = trim($datos['ref_elemento_id']);
    $fecha = date('Y-m-d H:i:s');

    $sql = mysql_query("SELECT * FROM elementos_web WHERE ref_elemento_id='" . mysql_esc(trim($datos['ref_elemento_id'])) . "' ");
    if (mysql_num_rows($sql) > 0) {
        $info_guardado['existe'] = true;
    } else {
        $sql_guardar = "INSERT INTO elementos_web SET titulo_elemento='" . mysql_esc(trim($datos['nombre_elemento'])) . "',es_banner='" . mysql_esc($datos['es_banner']) . "', ref_elemento_id='" . mysql_esc($datos['ref_elemento_id']) . "' , ref_elemento_clase='" . mysql_esc($datos['ref_elemento_clase']) . "',activo ='" . mysql_esc($datos['select_estado']) . "',lugar_web='" . mysql_esc($datos['select_lugar_web']) . "',tipo='" . mysql_esc($datos['select_tipo']) . "',contenido='" . mysql_esc(trim($datos['contenido'])) . "',created_at='" . mysql_esc($fecha) . "',updated_at='" . mysql_esc($fecha) . "' ";
        //$info_guardado['sql'] = $sql_guardar;
        if (mysql_query($sql_guardar)) $info_guardado['guardar'] = true;
    }
    return $info_guardado;
}

function editar_contenido_elemento($datos)
{
    $guardado = false;
    $fecha = date('Y-m-d H:i:s');
    $sql_guardar = "UPDATE elementos_web SET contenido='" . mysql_esc(trim($datos['contenido'])) . "',updated_at='" . mysql_esc($fecha) . "' WHERE id='" . mysql_esc($datos['id']) . "' ";
    if (mysql_query($sql_guardar)) $guardado = true;
    return $guardado;
}

function modificar_estado_elemento($datos)
{
    $modificado = false;
    $fecha = date('Y-m-d H:i:s');
    $sql_modificar = "UPDATE elementos_web SET activo='" . mysql_esc(trim($datos['estado'])) . "',updated_at='" . mysql_esc($fecha) . "' WHERE id='" . mysql_esc($datos['id']) . "' ";
    if (mysql_query($sql_modificar)) $modificado = true;
    return $modificado;
}



if (isset($_POST['accion']) && $_POST['accion'] != '') {

    switch ($_POST['accion']) {


        case 'editar_contenido_elemento':
            $respuesta = [];
            $respuesta['datos_post'] = $_POST['data'] ?? [];
            $respuesta['status'] = 'error';
            $respuesta['guardado'] = false;

            $data = $_POST['data'];
            $id = $data['id'] ?? '';
            $contenido = $data['contenido'] ?? '';

            if (is_numeric($id) && $contenido != '') {
                $datos = [];
                $datos['id'] = $id;
                $datos['contenido'] = $contenido;
                $info_guardado = editar_contenido_elemento($datos);
                if ($info_guardado == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['guardado'] = true;
                }
            }

            echo json_encode($respuesta);
            break;

        case 'modificar_estado_elemento':
            $respuesta = [];
            $respuesta['datos_post'] = $_POST['data'] ?? [];
            $respuesta['status'] = 'error';
            $respuesta['modificado'] = false;

            $data = $_POST['data'];
            $id = $data['id'] ?? '';
            $estado = $data['estado'] ?? '';

            if (is_numeric($id) && is_numeric($estado)) {
                $datos = [];
                $datos['id'] = $id;
                $datos['estado'] = $estado;
                $info_guardado = modificar_estado_elemento($datos);
                if ($info_guardado == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['modificado'] = true;
                    $respuesta['estado'] = $estado;
                }
            }

            echo json_encode($respuesta);
            break;

        case 'nuevo_elemento':

            $respuesta = [];
            $respuesta['status'] = 'error';

            // Obtener datos del formulario
            $nombreElemento = $_POST['nombre_elemento'] ?? '';
            $refElementoId = $_POST['ref_elemento_id'] ?? '';
            $refElementoClase = $_POST['ref_elemento_clase'] ?? '';
            $selectEstado = $_POST['select_estado'] ?? '';
            $selectLugarWeb = $_POST['select_lugar_web'] ?? '';
            $selectTipo = $_POST['select_tipo'] ?? '';
            $contenido = $_POST['contenido'] ?? '';
            $esBanner = $_POST['es_banner'] ?? '';

            // Obtener datos del archivo de imagen (si está presente)
            $imagen = $_FILES['imagen'] ?? null;
            $video = $_FILES['video'] ?? null;

            $archivo_media_subido = false;


            $carpeta_uploads = '../../../admin/uploads/';


            if ($selectTipo == 'img') {
                $carpeta_uploads = '../../../admin/uploads/imgs/';
                $nombre_imagen = time() . '_' . uniqid() . '_' . $_FILES['imagen']['name'];
                $ruta_imagen_elemento = $carpeta_uploads . $nombre_imagen;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_imagen_elemento)) {
                    $archivo_media_subido = true;
                }

                if ($archivo_media_subido) $contenido = '/admin/uploads/imgs/' . $nombre_imagen;
            }

            if ($selectTipo == 'video') {
                $carpeta_uploads = '../../../admin/uploads/vids/';
                $nombre_video = time() . '_' . uniqid() . '_' . $_FILES['video']['name'];
                $ruta_video_elemento = $carpeta_uploads . $nombre_video;

                if (move_uploaded_file($_FILES['video']['tmp_name'], $ruta_video_elemento)) {
                    $archivo_media_subido = true;
                }

                if ($archivo_media_subido) $contenido = '/admin/uploads/vids/' . $nombre_video;
            }



            if ($nombreElemento == '' || $refElementoId == '' || $selectEstado == '' || $selectLugarWeb == '' || $selectTipo == '' || $contenido == '') {
                $respuesta = [
                    'status' => 'error',
                    'mensaje' => 'Faltan algunos valores requeridos',
                ];
            } else {
                $datos = [
                    'nombre_elemento' => trim($nombreElemento),
                    'ref_elemento_id' => trim($refElementoId),
                    'ref_elemento_clase' => trim($refElementoClase),
                    'select_estado' => $selectEstado,
                    'select_lugar_web' => trim($selectLugarWeb),
                    'select_tipo' => trim($selectTipo),
                    'contenido' => trim($contenido),
                    'imagen' => $imagen,
                    'es_banner' => $esBanner,
                ];

                $info_guardado = guardar_nuevo_elemento($datos);

                // Respuesta exitosa
                $respuesta = [
                    'status' => $info_guardado['guardar'] == true ? 'success' : 'error',
                    'info_guardado' => $info_guardado,
                ];
            }

            echo json_encode($respuesta);
            break;


        case 'modificar_media_elemento':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['datos_post'] = [];
            $respuesta['info_guardado'] = '';

            try {
                $elemento_id = $_POST['elemento_id'] ?? '';
                $tipo = $_POST['tipo'] ?? '';

                $respuesta['datos_post']['elemento_id'] = $elemento_id;
                $respuesta['datos_post']['tipo'] = $tipo;

                if ($elemento_id && $tipo) {
                    $carpeta_uploads = '../../../admin/uploads/' . ($tipo === 'img' ? 'imgs/' : 'vids/');
                    $nombre_archivo = time() . '_' . uniqid() . '_' . $_FILES['archivo']['name'];
                    $ruta_archivo = $carpeta_uploads . $nombre_archivo;

                    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $ruta_archivo)) {
                        $nueva_url = '/admin/uploads/' . ($tipo === 'img' ? 'imgs/' : 'vids/') . $nombre_archivo;
                        $datos = [];
                        $datos['contenido'] = $nueva_url;
                        $datos['id'] = $elemento_id;
                        $respuesta['info_guardado'] = editar_contenido_elemento($datos);
                        $respuesta['nueva_url'] = $nueva_url;
                        $respuesta['tipo'] = $tipo;
                        if ($respuesta['info_guardado']) $respuesta['status'] = 'success';
                    }
                }
            } catch (Exception $e) {
                // Manejar la excepción de manera adecuada
                $respuesta['status'] = 'error';
                $respuesta['message'] = $e->getMessage();
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
