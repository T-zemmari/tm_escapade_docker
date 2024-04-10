<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';
session_start();


function fn_guardar_info_nuevo_servicio_ciruito($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['servicio_guardado'] = false;
    $respuesta['imagen_principal_guardada'] = false;
    $respuesta['resto_imagenes_guardados'] = false;
    $date = date('Y-m-d H:i:s');

    $referencia_unica_servicio = 'ref-' . time() . '_' . uniqid();

    $sql_insert = "INSERT INTO productos_servicios SET servicio_tipo='" . mysql_esc($datos['select_tipo_servicio']) . "',
    ref_servicio='" . mysql_esc($referencia_unica_servicio) . "',
    url_img_landing='" . mysql_esc($datos['ruta_imagen_landing']) . "',
    servicio_titulo='" . mysql_esc($datos['titulo_circuito']) . "',
    servicio_titulo_largo='" . mysql_esc($datos['titulo_circuito_largo']) . "',
    servicio_descripcion='" . mysql_esc($datos['descripcion_circuito_oferta']) . "',
    descripcion_dos='" . mysql_esc($datos['descripcion_secundaria_uno']) . "',
    descripcion_tres='" . mysql_esc($datos['descripcion_secundaria_dos']) . "',
    precio_servicio='" . mysql_esc($datos['precio_circuito_oferta']) . "',
    porcentaje='" . mysql_esc($datos['select_porcentaje_circuito_oferta']) . "',
    precio_a_adelantar='" . mysql_esc($datos['cantidad_a_ingresar']) . "',
    estado='" . mysql_esc($datos['select_estado_circuito']) . "',
    particular_o_empresa='" . mysql_esc($datos['select_particular_o_empresa_servicio']) . "',
    mostrar_en_web=0,
    mostrar_precio=0,
    created_at='" . mysql_esc($date) . "',
    updated_at='" . mysql_esc($date) . "'
    ";

    if (mysql_query($sql_insert)) {
        $last_id = mysql_insert_id();
        if (is_numeric($last_id)) {

            $respuesta['servicio_guardado'] = true;

            if (count($datos['array_servicios_incluidos']) > 0) {
                foreach ($datos['array_servicios_incluidos'] as $incluido) {
                    $sql_incluido = "INSERT INTO info_servs_incluidos SET servicio_id='" . mysql_esc($last_id) . "',mostrar_en_web=1,incluido_id='" . mysql_esc($incluido) . "',es_incluido=1,created_at='" . mysql_esc($date) . "' ";
                    //echo '<pre>'; print_r($sql_incluido); echo '</pre>';
                    mysql_query($sql_incluido);
                }
            }

            if (count($datos['array_servicios_no_incluidos']) > 0) {
                foreach ($datos['array_servicios_no_incluidos'] as $no_incluido) {
                    $sql_no_incluido = "INSERT INTO info_servs_incluidos SET servicio_id='" . mysql_esc($last_id) . "',mostrar_en_web=1,incluido_id='" . mysql_esc($no_incluido) . "',es_incluido=0,created_at='" . mysql_esc($date) . "' ";
                    //echo '<pre>'; print_r($sql_no_incluido); echo '</pre>';
                    mysql_query($sql_no_incluido);
                }
            }

            $sql_insert_media_principal = "INSERT INTO servicio_media SET servicio_id='" . mysql_esc($last_id) . "',
            url='" . mysql_esc($datos['ruta_imagen_principal']) . "',
            es_principal=1,
            estado='" . mysql_esc($datos['select_estado_circuito']) . "',
            created_at='" . mysql_esc($date) . "',
            updated_at='" . mysql_esc($date) . "'
            ";
            if (mysql_query($sql_insert_media_principal)) {
                $respuesta['imagen_principal_guardada'] = true;
            };

            if (count($datos['array_rutas_resto_imagenes']) > 0) {
                foreach ($datos['array_rutas_resto_imagenes'] as $imagen_segundaria_url) {
                    $sql_insert_media_secundaria = "INSERT INTO servicio_media SET servicio_id='" . mysql_esc($last_id) . "',
                url='" . mysql_esc($imagen_segundaria_url) . "',
                es_principal=0,
                estado='" . mysql_esc($datos['select_estado_circuito']) . "',
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


function fn_editar_nuevo_servicio_ciruito($datos)
{
    $respuesta = [];
    $respuesta['status'] = 'error';
    $respuesta['servicio_editado'] = false;
    $date = date('Y-m-d H:i:s');


    $sql_update = "UPDATE  productos_servicios SET servicio_tipo='" . mysql_esc($datos['select_tipo_servicio']) . "',
    servicio_titulo='" . mysql_esc($datos['titulo_circuito']) . "',
    servicio_titulo_largo='" . mysql_esc($datos['titulo_circuito_largo']) . "',
    servicio_descripcion='" . mysql_esc($datos['descripcion_circuito_oferta']) . "',
    descripcion_dos='" . mysql_esc($datos['descripcion_secundaria_uno']) . "',
    descripcion_tres='" . mysql_esc($datos['descripcion_secundaria_dos']) . "',
    precio_servicio='" . mysql_esc($datos['precio_circuito_oferta']) . "',
    porcentaje='" . mysql_esc($datos['select_porcentaje_circuito_oferta']) . "',
    precio_a_adelantar='" . mysql_esc($datos['cantidad_a_ingresar']) . "',
    estado='" . mysql_esc($datos['select_estado_circuito']) . "',
    mostrar_en_web='" . mysql_esc($datos['mostrar_en_la_web']) . "',
    particular_o_empresa='" . mysql_esc($datos['select_particular_o_empresa_servicio']) . "',
    updated_at='" . mysql_esc($date) . "' WHERE id='" . mysql_esc($datos['servicio_id']) . "' LIMIT 1 ";

    if (mysql_query($sql_update)) $respuesta['servicio_editado'] = true;

    return $respuesta;
}


function fn_eliminar_servicio($servicio_id)
{
    $eliminado = false;
    $sql_eliminar_servicio = "DELETE FROM productos_servicios WHERE id='" . mysql_esc($servicio_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar_servicio)) {
        $sql = mysql_query("SELECT * FROM servicio_media WHERE servicio_id='" . mysql_esc($servicio_id) . "' ");
        while ($fetch = mysql_fetch_assoc($sql)) :
            $ruta_archivo_media = '../../' . $fetch['url'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        endwhile;
        $sql_eliminar_media = "DELETE FROM servicio_media WHERE servicio_id='" . mysql_esc($servicio_id) . "'";
        mysql_query($sql_eliminar_media);
        $sql_eliminar_complemento = "DELETE FROM servicio_complemento WHERE servicio_id='" . mysql_esc($servicio_id) . "' ";
        mysql_query($sql_eliminar_complemento);
        $sql_eliminar_inlcuidos_y_no_incluidos = "DELETE FROM info_servs_incluidos WHERE servicio_id='" . mysql_esc($servicio_id) . "' ";
        mysql_query($sql_eliminar_inlcuidos_y_no_incluidos);
        $eliminado = true;
    }
    return $eliminado;
}

function fn_eliminar_medio($media_id)
{
    $eliminado = false;
    $sql = mysql_query("SELECT * FROM servicio_media WHERE id='" . mysql_esc($media_id) . "' ");
    while ($fetch = mysql_fetch_assoc($sql)) :
        $ruta_archivo_media = '../../' . $fetch['url'];
        if (file_exists($ruta_archivo_media)) {
            unlink($ruta_archivo_media);
        }
    endwhile;
    $sql_eliminar_media = "DELETE FROM servicio_media WHERE id='" . mysql_esc($media_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar_media)) $eliminado = true;
    return $eliminado;
}

function fn_eliminar_media_servicio($media_id)
{
    $eliminado = false;
    $sql = mysql_query("SELECT * FROM servicio_media WHERE id='" . mysql_esc($media_id) . "' ");
    while ($fetch = mysql_fetch_assoc($sql)) :
        $ruta_archivo_media = '../../' . $fetch['url'];
        if (file_exists($ruta_archivo_media)) {
            unlink($ruta_archivo_media);
        }
    endwhile;
    $sql_eliminar = "DELETE FROM servicio_media WHERE id='" . mysql_esc($media_id) . "' LIMIT 1";
    if (mysql_query($sql_eliminar)) $eliminado = true;
    return $eliminado;
}

function fn_modificar_imagen_principal_servicio($servicio_id, $nueva_url)
{
    $modificado = false;
    $sql = "SELECT * FROM servicio_media WHERE servicio_id='" . mysql_esc($servicio_id) . "' ";
    $result = mysql_query($sql);
    while ($fetch = mysql_fetch_assoc($result)) :
        if ($fetch['es_principal'] == 1) {
            $ruta_archivo_media = '../../' . $fetch['url'];
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
            $sql_update = "UPDATE servicio_media SET url='" . mysql_esc($nueva_url) . "' WHERE id='" . mysql_esc($fetch['id']) . "' LIMIT 1";
            if (mysql_query($sql_update)) {
                $modificado = true;
            }
        }
    endwhile;
    return $modificado;
}

function fn_modificar_landing_imagen_servicio($servicio_id, $nueva_url)
{
    $modificado = false;
    $sql = "SELECT * FROM productos_servicios WHERE id='" . mysql_esc($servicio_id) . "' ";
    $result = mysql_query($sql);
    if ($fetch = mysql_fetch_assoc($result)) :
        if (isset($fetch['url_img_landing']) && $fetch['url_img_landing'] != '') {
            $ruta_archivo_media = '../..' . $fetch['url_img_landing'] ?? '';
            if (file_exists($ruta_archivo_media)) {
                unlink($ruta_archivo_media);
            }
        }

        $sql_update = "UPDATE productos_servicios SET url_img_landing='" . mysql_esc($nueva_url) . "' WHERE id='" . mysql_esc($servicio_id) . "' LIMIT 1";
        if (mysql_query($sql_update)) {
            $modificado = true;
        }

    endif;
    return $modificado;
}

if (isset($_POST['accion']) && $_POST['accion'] != '') {

    switch ($_POST['accion']) {

        case 'guardar_nuevo_circuito':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_creado'] = false;
            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['select_estado_circuito'] = $_POST['select_estado_circuito'] ?? '';
            $respuesta['datos_post']['select_tipo_servicio'] = $_POST['select_tipo_servicio'] ?? '';
            $respuesta['datos_post']['titulo_circuito'] = trim($_POST['titulo_circuito']) ?? '';
            $respuesta['datos_post']['titulo_circuito_largo'] = trim($_POST['titulo_circuito_largo']) ?? '';
            $respuesta['datos_post']['descripcion_circuito_oferta'] = trim($_POST['descripcion_circuito_oferta']) ?? '';
            $respuesta['datos_post']['precio_circuito_oferta'] = $_POST['precio_circuito_oferta'] ?? '';
            $respuesta['datos_post']['select_porcentaje_circuito_oferta'] = $_POST['select_porcentaje_circuito_oferta'] ?? '';
            $respuesta['datos_post']['select_particular_o_empresa_servicio'] = $_POST['select_particular_o_empresa_servicio'] ?? '';
            $respuesta['datos_post']['cantidad_a_ingresar'] = $_POST['cantidad_a_ingresar'] ?? '';
            $respuesta['datos_post']['ruta_imagen_landing'] = '';
            $respuesta['datos_post']['ruta_imagen_principal'] = '';
            $respuesta['datos_post']['array_rutas_resto_imagenes'] = [];

            $respuesta['datos_post']['descripcion_secundaria_uno'] = trim($_POST['descripcion_secundaria_uno']) ?? '';
            $respuesta['datos_post']['descripcion_secundaria_dos'] = trim($_POST['descripcion_secundaria_dos']) ?? '';


            if ($respuesta['datos_post']['select_estado_circuito'] == '' || $respuesta['datos_post']['select_estado_circuito'] == 'no_activo') $respuesta['datos_post']['select_estado_circuito'] = 0;
            if ($respuesta['datos_post']['select_estado_circuito'] == 'activo') $respuesta['datos_post']['select_estado_circuito'] = 1;

            $respuesta['datos_post']['array_servicios_incluidos'] = json_decode($_POST['array_servicios_incluidos'], true) ?? [];
            $respuesta['datos_post']['array_servicios_no_incluidos'] = json_decode($_POST['array_servicios_no_incluidos'], true) ?? [];


            // Lógica para manejar la imagen principal
            $carpetaUploads = '../../../admin/uploads/imgs/servicios/circuito/';
            $nombreLandingImage = '';

            if (isset($_FILES['landing_image']) && $_FILES['landing_image']['error'] == UPLOAD_ERR_OK) {
                // Generar nombre de archivo único
                $nombreLandingImage = time() . '_' . uniqid() . '_' . $_FILES['landing_image']['name'];

                // Mover la imagen al directorio de subidas
                if (move_uploaded_file($_FILES['landing_image']['tmp_name'], $carpetaUploads . $nombreLandingImage)) {
                    $respuesta['datos_post']['ruta_imagen_landing'] = '/admin/uploads/imgs/servicios/circuito/' . $nombreLandingImage;
                };
            }

            if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == UPLOAD_ERR_OK) {
                // Generar nombre de archivo único
                $nombreArchivoPrincipal = time() . '_' . uniqid() . '_' . $_FILES['main_image']['name'];

                // Mover la imagen al directorio de subidas
                if (move_uploaded_file($_FILES['main_image']['tmp_name'], $carpetaUploads . $nombreArchivoPrincipal)) {
                    $respuesta['datos_post']['ruta_imagen_principal'] = '/admin/uploads/imgs/servicios/circuito/' . $nombreArchivoPrincipal;
                };
            }

            // Lógica para manejar imágenes adicionales
            $nombreArchivosAdicionales = [];

            if (!empty($_FILES['additional_images'])) {
                foreach ($_FILES['additional_images']['tmp_name'] as $index => $tmpName) {
                    $nombreArchivoAdicional = time() . '_' . uniqid() . '_' . $_FILES['additional_images']['name'][$index];
                    if (move_uploaded_file($tmpName, $carpetaUploads . $nombreArchivoAdicional)) {
                        $respuesta['datos_post']['array_rutas_resto_imagenes'][] = '/admin/uploads/imgs/servicios/circuito/' . $nombreArchivoAdicional;
                    };
                }
            }

            $info_guardado = fn_guardar_info_nuevo_servicio_ciruito($respuesta['datos_post']);
            if ($info_guardado['servicio_guardado'] == true) {
                $respuesta['status'] = 'success';
                $respuesta['servicio_creado'] = true;
            }

            echo json_encode($respuesta);
            break;


        case 'editar_servicio_circuito':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_editado'] = false;
            $data = $_POST['data'] ?? [];
            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['servicio_id'] = $data['servicio_id'] ?? '';
            $respuesta['datos_post']['select_estado_circuito'] = $data['select_estado_circuito'] ?? '';
            $respuesta['datos_post']['select_tipo_servicio'] = $data['select_tipo_servicio'] ?? '';
            $respuesta['datos_post']['titulo_circuito'] = trim($data['titulo_circuito']) ?? '';
            $respuesta['datos_post']['titulo_circuito_largo'] = trim($data['titulo_circuito_largo']) ?? '';
            $respuesta['datos_post']['descripcion_circuito_oferta'] = trim($data['descripcion_circuito_oferta']) ?? '';
            $respuesta['datos_post']['precio_circuito_oferta'] = $data['precio_circuito_oferta'] ?? '';
            $respuesta['datos_post']['select_porcentaje_circuito_oferta'] = $data['select_porcentaje_circuito_oferta'] ?? '';
            $respuesta['datos_post']['cantidad_a_ingresar'] = $data['cantidad_a_ingresar'] ?? '';
            $respuesta['datos_post']['mostrar_en_la_web'] = $data['mostrar_en_la_web'] ?? '';
            $respuesta['datos_post']['select_particular_o_empresa_servicio'] = $data['select_particular_o_empresa_servicio'] ?? '';


            $respuesta['datos_post']['descripcion_secundaria_uno'] = trim($data['descripcion_secundaria_uno']) ?? '';
            $respuesta['datos_post']['descripcion_secundaria_dos'] = trim($data['descripcion_secundaria_dos']) ?? '';


            if ($respuesta['datos_post']['select_estado_circuito'] == '' || $respuesta['datos_post']['select_estado_circuito'] == 'no_activo') $respuesta['datos_post']['select_estado_circuito'] = 0;
            if ($respuesta['datos_post']['select_estado_circuito'] == 'activo') $respuesta['datos_post']['select_estado_circuito'] = 1;

            if ($respuesta['datos_post']['mostrar_en_la_web'] == '' || $respuesta['datos_post']['mostrar_en_la_web'] == 'no') $respuesta['datos_post']['mostrar_en_la_web'] = 0;
            if ($respuesta['datos_post']['mostrar_en_la_web'] == 'si') $respuesta['datos_post']['mostrar_en_la_web'] = 1;



            $info_guardado = fn_editar_nuevo_servicio_ciruito($respuesta['datos_post']);
            if ($info_guardado['servicio_editado'] == true) {
                $respuesta['status'] = 'success';
                $respuesta['servicio_editado'] = true;
            }

            echo json_encode($respuesta);
            break;



        case 'eliminar_servicio_circuito':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_id'] = $_POST['servicio_id'] ?? '';
            if (is_numeric($respuesta['servicio_id'])) {
                $eliminado = fn_eliminar_servicio($respuesta['servicio_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;



        case 'eliminar_imagen_servicio':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['media_id'] = $_POST['media_id'] ?? '';
            if (is_numeric($respuesta['media_id'])) {
                $eliminado = fn_eliminar_medio($respuesta['media_id']);
                if ($eliminado) $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        case 'modificar_imagen_principal_servicio':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_id'] = $_POST['servicio_id'] ?? null;

            if (is_numeric($respuesta['servicio_id'])) {
                // Verificar si se recibió un archivo
                if (isset($_FILES['imagen_principal']) && $_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK) {
                    $carpetaUploads = '../../../admin/uploads/imgs/servicios/circuito/';
                    $nombre = time() . '_' . uniqid() . '_' . $_FILES['imagen_principal']['name'];
                    if (move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $carpetaUploads . $nombre)) {
                        $respuesta['nueva_url'] = '/admin/uploads/imgs/servicios/circuito/' . $nombre;
                        // Llamar a la función para modificar la URL de la imagen en la base de datos
                        $modificado = fn_modificar_imagen_principal_servicio($respuesta['servicio_id'], $respuesta['nueva_url']);
                        if ($modificado) {
                            $respuesta['status'] = 'success';
                        }
                    }
                }
            }

            echo json_encode($respuesta);
            break;

        case 'modificar_landing_imagen_servicio':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_id'] = $_POST['servicio_id'] ?? null;

            if (is_numeric($respuesta['servicio_id'])) {
                // Verificar si se recibió un archivo
                if (isset($_FILES['imagen_landing']) && $_FILES['imagen_landing']['error'] == UPLOAD_ERR_OK) {
                    $carpetaUploads = '../../../admin/uploads/imgs/servicios/circuito/';
                    $nombre = time() . '_' . uniqid() . '_' . $_FILES['imagen_landing']['name'];
                    if (move_uploaded_file($_FILES['imagen_landing']['tmp_name'], $carpetaUploads . $nombre)) {
                        $respuesta['nueva_url'] = '/admin/uploads/imgs/servicios/circuito/' . $nombre;
                        // Llamar a la función para modificar la URL de la imagen en la base de datos
                        $modificado = fn_modificar_landing_imagen_servicio($respuesta['servicio_id'], $respuesta['nueva_url']);
                        if ($modificado) {
                            $respuesta['status'] = 'success';
                        }
                    }
                }
            }
            echo json_encode($respuesta);
            break;

        case 'anyadir_mas_imagenes_servicio':
            $respuesta = [];
            $respuesta['datos_post'] = [];
            $respuesta['datos_post']['servicio_id'] = $_POST['servicio_id'] ?? '';
            $respuesta['datos_post']['array_rutas_resto_imagenes'] = [];
            $respuesta['status'] = 'error';
            $respuesta['message'] = 'Ha ocurrido un error! Inténtalo más tarde o contacta con el administrador.';
            $fecha_hoy = date('Y-m-d H:i:s');
            $nombreArchivosAdicionales = [];
            $carpetaUploads = '../../../admin/uploads/imgs/servicios/circuito/';

            // Verificar el número actual de imágenes con es_principal=0 para el servicio
            $sql = "SELECT COUNT(*) AS num_imagenes FROM servicio_media WHERE servicio_id = '" . mysql_esc($respuesta['datos_post']['servicio_id']) . "' AND es_principal = 0";
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
                                $nueva_url = '/admin/uploads/imgs/servicios/circuito/' . $nombreArchivoAdicional;
                                $sql = "INSERT INTO servicio_media SET servicio_id='" . mysql_esc($respuesta['datos_post']['servicio_id']) . "' , url='" . mysql_esc($nueva_url) . "' ,es_principal=0,estado=1,created_at='" . mysql_esc($fecha_hoy) . "' , updated_at='" . mysql_esc($fecha_hoy) . "' ";
                                if (mysql_query($sql)) {
                                    $image_id = mysql_insert_id();
                                    $respuesta['datos_post']['array_rutas_resto_imagenes'][] = ['nueva_url' => $nueva_url, 'id' => $image_id];
                                } else {
                                    if (file_exists('../..' . $nueva_url)) {
                                        unlink('../..' . $nueva_url);
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

        case 'nuevo_servicio_incluido':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['servicio_incluido_creado'] = false;
            $respuesta['datos_post'] = [];

            if (!empty($_POST['titulo_servicio'])  && isset($_FILES['icono_servicio_incluido'])) {

                $tituloServicio = $_POST['titulo_servicio'];
                $iconoServicio = $_FILES['icono_servicio_incluido'];
                $check_mostrar_para_seleccionar = $_POST['check_mostrar_para_seleccionar'] ?? 0;
                $select_tipo = $_POST['select_tipo'] ?? '';
                //echo '<pre>'; print_r($check_mostrar_para_seleccionar); echo '</pre>';

                if ($iconoServicio['error'] === UPLOAD_ERR_OK) {
                    $fileExtension = pathinfo($iconoServicio['name'], PATHINFO_EXTENSION);

                    $nombreArchivo = time() . '_' . uniqid() . '_' . $iconoServicio['name'];

                    $carpetaUploads = '../../../admin/uploads/imgs/incluidos_iconos/';

                    if (move_uploaded_file($iconoServicio['tmp_name'], $carpetaUploads . $nombreArchivo)) {

                        $respuesta['datos_post']['url_icono_servicio_incluido'] = "/admin/uploads/imgs/incluidos_iconos/" . $nombreArchivo;
                        $respuesta['datos_post']['titulo_servicio'] = $tituloServicio;
                        $respuesta['datos_post']['check_mostrar_para_seleccionar'] = $check_mostrar_para_seleccionar;
                        $respuesta['datos_post']['select_tipo'] = $select_tipo;

                        $fecha_hoy = date('Y-m-d H:i:s');
                        $sql = "INSERT INTO tabla_incluidos SET nombre='" . mysql_esc(trim($tituloServicio)) . "',tipo='" . mysql_esc($select_tipo) . "',mostrar_para_seleccionar=" . mysql_esc($check_mostrar_para_seleccionar) . ",  url_icono='" . mysql_esc($respuesta['datos_post']['url_icono_servicio_incluido']) . "',created_at='" . mysql_esc($fecha_hoy) . "' ";
                        //echo '<pre>'; print_r($sql ); echo '</pre>';
                        if (mysql_query($sql)) {
                            $last_id = mysql_insert_id();
                            $respuesta['status'] = 'success';
                            $respuesta['servicio_incluido_creado'] = true;
                            $respuesta['datos_post']['last_id'] = $last_id;
                        }
                    } else {
                        $respuesta['error'] = 'Error al subir la imagen.';
                    }
                } else {
                    $respuesta['error'] = 'Error al cargar la imagen.';
                }
            } else {
                $respuesta['error'] = 'Todos los campos son requeridos.';
            }

            echo json_encode($respuesta);
            break;


        case 'eliminar_item_inlcuido_o_no_incluido':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            if (is_numeric($respuesta['item_id'])) {
                $sql_eliminar_releacion = "DELETE FROM info_servs_incluidos WHERE incluido_id='" . mysql_esc($respuesta['item_id']) . "' ";
                if (mysql_query($sql_eliminar_releacion)) {
                    $sql_obtener_icono = mysql_query("SELECT url_icono FROM tabla_incluidos WHERE id='" . mysql_esc($respuesta['item_id']) . "' ");
                    if ($fetch_icono = mysql_fetch_assoc($sql_obtener_icono)) {
                        $ruta = '../..' . $fetch_icono['url_icono'];
                        if (file_exists($ruta)) {
                            unlink($ruta);
                        }
                    }
                    $sql_delete_item = "DELETE FROM tabla_incluidos WHERE id='" . mysql_esc($respuesta['item_id']) . "' LIMIT 1";
                    if (mysql_query($sql_delete_item)) {
                        $respuesta['status'] = 'success';
                    }
                }
            }

            echo json_encode($respuesta);
            break;


        case 'modificar_estado_mostrar_para_seleccionar':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['checked'] = $_POST['checked'] ?? '';

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['checked'])) {
                $sql_update = "UPDATE tabla_incluidos SET mostrar_para_seleccionar='" . mysql_esc($respuesta['checked']) . "' WHERE id='" . mysql_esc($respuesta['item_id']) . "' LIMIT 1";
                if (mysql_query($sql_update)) {
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;


        case 'modificar_es_incluido':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['checked'] = $_POST['checked'] ?? '';

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['checked'])) {
                $sql_update = "UPDATE info_servs_incluidos SET es_incluido='" . mysql_esc($respuesta['checked']) . "' WHERE id='" . mysql_esc($respuesta['item_id']) . "' LIMIT 1";
                if (mysql_query($sql_update)) {
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;

        case 'desvincular_incluidos_del_servicio':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['servicio_id'] = $_POST['servicio_id'] ?? '';

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['servicio_id'])) {
                $sql_desvincular = "DELETE FROM info_servs_incluidos WHERE  incluido_id='" . mysql_esc($respuesta['item_id']) . "' AND servicio_id='" . mysql_esc($respuesta['servicio_id']) . "' LIMIT 1";
                if (mysql_query($sql_desvincular)) {
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;

        case 'vincular_item_con_el_servicio':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['item_id'] = $_POST['item_id'] ?? '';
            $respuesta['servicio_id'] = $_POST['servicio_id'] ?? '';

            $date = date('Y-m-d H:i:s');

            if (is_numeric($respuesta['item_id']) && is_numeric($respuesta['servicio_id'])) {
                $sql_vincular = "INSERT INTO info_servs_incluidos SET incluido_id='" . mysql_esc($respuesta['item_id']) . "' , servicio_id='" . mysql_esc($respuesta['servicio_id']) . "' ,mostrar_en_web=1, es_incluido=0,created_at='" . mysql_esc($date) . "' ";
                if (mysql_query($sql_vincular)) {
                    $respuesta['status'] = 'success';
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
