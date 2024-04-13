<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';


function fn_guardar_nuevo_banner($datos)
{
    $guardado = false;
    $fecha_hoy = date('Y-m-d H:i:s');
    $sql = "INSERT INTO banners SET url_escritorio='" . $datos['url_escritorio'] . "', url_movil='" . $datos['url_movil'] . "',texto='" . $datos['texto'] . "', ref_elemento_id='" . $datos['elementosWeb'] . "', fecha_ini='" . $datos['fechaInicio'] . "',fecha_fin='" . $datos['fechaFin'] . "', link='" . $datos['link'] . "', tipo='" . $datos['tipo'] . "', orden='" . $datos['selectOrden'] . "',mostrar_temporizador='" . $datos['mostrarTemporizador'] . "', activo=1, created_at='" . $fecha_hoy . "', updated_at='" . $fecha_hoy . "' ";
    if (mysql_query($sql)) {
        $guardado = true;
    }

    return $guardado;
}

function fn_modificar_estado_banner($datos)
{
    $modificado = false;

    $fecha = date('Y-m-d H:i:s');
    if ($datos['estado'] == 1) {
        $sql = mysql_query("SELECT * FROM banners WHERE ref_elemento_id='" . mysql_esc($datos['ref_elemento_id']) . "' ");
        if (mysql_num_rows($sql) > 0) {
            while ($fetch = mysql_fetch_assoc($sql)) {
                if ($fetch['activo'] == 1) {
                    mysql_query("UPDATE banners SET activo='0' WHERE ref_elemento_id='" . mysql_esc($fetch['ref_elemento_id']) . "' ");
                }
            }
        }
    }
    $sql_modificar = "UPDATE banners SET activo='" . mysql_esc(trim($datos['estado'])) . "',updated_at='" . mysql_esc($fecha) . "' WHERE id='" . mysql_esc($datos['id']) . "' LIMIT 1";
    if (mysql_query($sql_modificar)) $modificado = true;
    return $modificado;
}

function fn_eliminar_banner($banner_id)
{
    $eliminado = false;
    $sql = "SELECT * FROM banners WHERE id='" . mysql_esc($banner_id) . "' ";
    $respuesta = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($respuesta)) :
        if (file_exists('../../..' . $fetch['url_escritorio'])) {
            unlink('../../..' . $fetch['url_escritorio']);
        }
        if (file_exists('../../..' . $fetch['url_movil'])) {
            unlink('../../..' . $fetch['url_movil']);
        }
    endwhile;
    $sql_delete = "DELETE FROM banners WHERE id='" . mysql_esc($banner_id) . "' LIMIT 1";
    if (mysql_query($sql_delete)) $eliminado = true;
    return $eliminado;
}


if (isset($_POST['accion']) && $_POST['accion'] != '') {
    switch ($_POST['accion']) {

        case 'nuevo_banner':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['mensaje'] = 'No ha sido posible guardar el banner';
            $respuesta['url_escritorio'] = '';
            $respuesta['url_movil'] = NULL;
            $fecha_hoy = date('Y-m-d H:i:s');

            // Obtener todos los datos del formulario
            $fechaInicio = $_POST['fechaInicio'] ?? '';
            $fechaFin = $_POST['fechaFin'] ?? '';
            $texto = $_POST['texto'] ?? '';
            $elementosWeb = $_POST['elementosWeb'] ?? '';
            $selectOrden = $_POST['selectOrden'] ?? '';
            $link = $_POST['link'] ?? '';
            $tipo = $_POST['tipo'] ?? '';
            $mostrarTemporizador = $_POST['mostrarTemporizador'] ?? '';


            if ($fechaInicio != '') $fechaInicio = $fechaInicio . ' 00:00:00';
            if ($fechaFin != '') $fechaFin = $fechaFin . ' 23:59:59';


            if ($mostrarTemporizador != '' && $mostrarTemporizador == true) $mostrarTemporizador == 1;
            if ($mostrarTemporizador == '' || $mostrarTemporizador == false) $mostrarTemporizador == 0;

            // Generar un nombre único para las imágenes
            $nombreUnico = time() . '_' . uniqid();



            // Inicializar las variables de imágenes subidas
            $imagen_escritorio_subida = false;
            $imagen_movil_subida = false;

            // Subir la imagen de escritorio si está presente
            if (isset($_FILES['bannerEscritorio'])) {
                $carpetaUploads = '../../../admin/uploads/imgs/banners/';
                $nombreImagenEscritorio = $_FILES['bannerEscritorio']['name'];
                $rutaImagenEscritorio = $carpetaUploads . $nombreUnico . '_' . $nombreImagenEscritorio;
                $respuesta['url_escritorio'] = '/admin/uploads/imgs/banners/' . $nombreUnico . '_' . $nombreImagenEscritorio;

                if (move_uploaded_file($_FILES['bannerEscritorio']['tmp_name'], $rutaImagenEscritorio)) {
                    $imagen_escritorio_subida = true;
                }
            }

            // Subir la imagen móvil si está presente
            if (isset($_FILES['bannerMovil'])) {
                $carpetaUploads = '../../../admin/uploads/imgs/banners/';
                $nombreImagenMovil = $_FILES['bannerMovil']['name'];
                $rutaImagenMovil = $carpetaUploads . $nombreUnico . '_' . $nombreImagenMovil;
                $respuesta['url_movil'] = '/admin/uploads/imgs/banners/' . $nombreUnico . '_' . $nombreImagenMovil;

                if (move_uploaded_file($_FILES['bannerMovil']['tmp_name'], $rutaImagenMovil)) {
                    $imagen_movil_subida = true;
                }
            }

            // Añadir las variables a la respuesta
            $respuesta['imagen_escritorio_subida'] = $imagen_escritorio_subida;
            $respuesta['imagen_movil_subida'] = $imagen_movil_subida;

            $sql = '';
            if ($imagen_escritorio_subida) {

                $datos = [];
                $datos['fechaInicio'] = $fechaInicio;
                $datos['fechaFin'] = $fechaFin;
                $datos['texto'] = $texto;
                $datos['elementosWeb'] = $elementosWeb;
                $datos['selectOrden'] = $selectOrden;
                $datos['link'] = $link;
                $datos['tipo'] = $tipo;
                $datos['mostrarTemporizador'] = $mostrarTemporizador;
                $datos['url_escritorio'] = $respuesta['url_escritorio'];
                $datos['url_movil'] = $respuesta['url_movil'];

                $guardado = fn_guardar_nuevo_banner($datos);
                if ($guardado) {
                    $respuesta['status'] = 'success';
                    $respuesta['mensaje'] = 'Banner guardaro correctamente';
                } else {
                    $rutaImagenMovil = __DIR__ . '/uploads/imgs/banners/' . $nombreImagenMovil;

                    if (file_exists('admin/uploads/imgs/banners/' . $rutaImagenMovil)) {
                        unlink('admin/uploads/imgs/banners/' . $rutaImagenMovil);
                    }
                    if (file_exists('admin/uploads/imgs/banners/' . $rutaImagenEscritorio)) {
                        unlink('admin/uploads/imgs/banners/' . $rutaImagenEscritorio);
                    }
                }
            }

            echo json_encode($respuesta);
            break;

        case 'modificar_estado_banner':
            $respuesta = [];
            $respuesta['datos_post'] = $_POST['data'] ?? [];
            $respuesta['status'] = 'error';
            $respuesta['modificado'] = false;

            $data = $_POST['data'];
            $id = $data['id'] ?? '';
            $estado = $data['estado'] ?? '';
            $ref_elemento_id  = $data['ref_elemento_id'] ?? '';

            if (is_numeric($id) && is_numeric($estado) && is_numeric($ref_elemento_id)) {
                $datos = [];
                $datos['id'] = $id;
                $datos['estado'] = $estado;
                $datos['ref_elemento_id'] = $ref_elemento_id;
                $info_guardado = fn_modificar_estado_banner($datos);
                if ($info_guardado == true) {
                    $respuesta['status'] = 'success';
                    $respuesta['modificado'] = true;
                    $respuesta['estado'] = $estado;
                }
            }
            echo json_encode($respuesta);
            break;


        case 'eliminar_banner':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['banner_id'] = $_POST['banner_id'] ?? '';
            if (is_numeric($respuesta['banner_id'])) {
                $eliminado = fn_eliminar_banner($respuesta['banner_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
            exit();
    }
}
