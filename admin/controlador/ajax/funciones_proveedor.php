<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';

function bn_guardar_nuevo_proveedor($datos)
{
    $guardado = false;
    $fecha_hoy = date('Y-m-d H:i:s');


    $sql_insert_proveedor = "INSERT INTO proveedor SET 
        proveedor_nombre='" . mysql_esc($datos['razon_social']) . "',
        tipo_documento='" . mysql_esc($datos['select_tipo_de_documento']) . "',
        documento='" . mysql_esc($datos['documento_id']) . "',
        email='" . mysql_esc($datos['email']) . "',
        telefono='" . mysql_esc($datos['telefono']) . "',
        tipo_via='" . mysql_esc($datos['proveedor_select_tipo_de_via']) . "',
        direccion='" . mysql_esc($datos['direccion']) . "', 
        numero='" . mysql_esc($datos['numero']) . "', 
        piso='" . mysql_esc($datos['piso']) . "', 
        puerta='" . mysql_esc($datos['puerta']) . "', 
        cp='" . mysql_esc($datos['proveedor_codigo_postal']) . "', 
        municipio='" . mysql_esc($datos['proveedor_municipio']) . "', 
        ciudad='" . mysql_esc($datos['proveedor_ciudad']) . "', 
        pais='" . mysql_esc($datos['proveedor_pais']) . "', 
        active=1, 
        created_at='" . mysql_esc($fecha_hoy) . "', 
        updated_at='" . mysql_esc($fecha_hoy) . "'";

    if (mysql_query($sql_insert_proveedor)) $guardado = true;

    return $guardado;
}


function bn_editar_proveedor($datos)
{
    $guardado = false;
    $fecha_hoy = date('Y-m-d H:i:s');

    $sql_update_proveedor = "UPDATE proveedor SET 
        proveedor_nombre='" . mysql_esc($datos['razon_social']) . "',
        tipo_documento='" . mysql_esc($datos['select_tipo_de_documento']) . "',
        documento='" . mysql_esc($datos['documento_id']) . "',
        email='" . mysql_esc($datos['email']) . "',
        telefono='" . mysql_esc($datos['telefono']) . "',
        tipo_via='" . mysql_esc($datos['proveedor_select_tipo_de_via']) . "',
        direccion='" . mysql_esc($datos['direccion']) . "', 
        numero='" . mysql_esc($datos['numero']) . "', 
        piso='" . mysql_esc($datos['piso']) . "', 
        puerta='" . mysql_esc($datos['puerta']) . "', 
        cp='" . mysql_esc($datos['proveedor_codigo_postal']) . "', 
        municipio='" . mysql_esc($datos['proveedor_municipio']) . "', 
        ciudad='" . mysql_esc($datos['proveedor_ciudad']) . "', 
        pais='" . mysql_esc($datos['proveedor_pais']) . "', 
        updated_at='" . mysql_esc($fecha_hoy) . "'
        WHERE id='" . mysql_esc($datos['id']) . "' LIMIT 1";

    if (mysql_query($sql_update_proveedor)) $guardado = true;

    return $guardado;
}

if (isset($_POST['accion']) && $_POST['accion'] != '') {
    switch ($_POST['accion']) {

        case 'guardar_nuevo_proveedor':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['datos_guardados_correctamente'] = 'error';

            $datos_proveedor = [
                'razon_social' => $_POST['razon_social'] ?? '',
                'select_tipo_de_documento' => $_POST['select_tipo_de_documento'] ?? '',
                'documento_id' => $_POST['documento_id'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'proveedor_select_tipo_de_via' => $_POST['select_tipo_de_via'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'numero' => $_POST['numero'] ?? '',
                'piso' => $_POST['piso'] ?? '',
                'puerta' => $_POST['puerta'] ?? '',
                'proveedor_codigo_postal' => $_POST['codigo_postal'] ?? '',
                'proveedor_municipio' => $_POST['municipio'] ?? '',
                'proveedor_ciudad' => $_POST['ciudad'] ?? '',
                'proveedor_pais' => $_POST['pais'] ?? '',
            ];

            $respuesta['datos_post'] = $datos_proveedor;

            $resultado_guardar = bn_guardar_nuevo_proveedor($datos_proveedor);
            if ($resultado_guardar == true) {
                $respuesta['status'] = 'success';
                $respuesta['datos_guardados_correctamente'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        case 'editar_proveedor':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['datos_editados_correctamente'] = 'error';

            $datos_proveedor = [
                'razon_social' => $_POST['razon_social'] ?? '',
                'select_tipo_de_documento' => $_POST['select_tipo_de_documento'] ?? '',
                'documento_id' => $_POST['documento_id'] ?? '',
                'email' => $_POST['email'] ?? '',
                'telefono' => $_POST['telefono'] ?? '',
                'proveedor_select_tipo_de_via' => $_POST['select_tipo_de_via'] ?? '',
                'direccion' => $_POST['direccion'] ?? '',
                'numero' => $_POST['numero'] ?? '',
                'piso' => $_POST['piso'] ?? '',
                'puerta' => $_POST['puerta'] ?? '',
                'proveedor_codigo_postal' => $_POST['codigo_postal'] ?? '',
                'proveedor_municipio' => $_POST['municipio'] ?? '',
                'proveedor_ciudad' => $_POST['ciudad'] ?? '',
                'proveedor_pais' => $_POST['pais'] ?? '',
                'id' => $_POST['id'] ?? '',
            ];

            $respuesta['datos_post'] = $datos_proveedor;

            $resultado_editar = bn_editar_proveedor($datos_proveedor);
            if ($resultado_editar == true) {
                $respuesta['status'] = 'success';
                $respuesta['datos_editados_correctamente'] = 'success';
            }

            echo json_encode($respuesta);
            break;


        case 'eliminar_proveedor':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['id'] = $_POST['id'] ?? '';
            $respuesta['message'] = 'No ha sido posible eliminar al proveedor, intentalo mas tarde';
            if (is_numeric($respuesta['id'])) {
                $sql_delete = "DELETE FROM proveedor WHERE id='" . mysql_esc($respuesta['id']) . "' LIMIT 1";
                if (mysql_query($sql_delete)) {
                    $respuesta['status'] = 'success';
                    $respuesta['message'] = 'Proveedor eliminado correctamente';
                }
            }

            echo json_encode($respuesta);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
    exit();
}
