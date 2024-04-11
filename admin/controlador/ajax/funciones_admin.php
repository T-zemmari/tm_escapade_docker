<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';


function bn_editar_perfil_admin($datos)
{
    $editado = false;
    $fehca_hoy = date('Y-m-d H:i:s');
    $sql = "UPDATE admin_profile SET tel_principal='" . mysql_esc($datos['telefono']) . "',direccion='" . mysql_esc($datos['direccion']) . "',updated_at='" . mysql_esc($fehca_hoy) . "' WHERE id='" . mysql_esc($datos['admin_profile_id']) . "' LIMIT 1";
    if (mysql_query($sql)) $editado = true;
    return $editado;
}


if (isset($_POST['accion']) && $_POST['accion'] != '') {

    switch ($_POST['accion']) {


        case 'eliminar_admin':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['id'] = $_POST['id'] ?? '';
            $respuesta['message'] = 'No ha sido posible eliminar el admin, intentalo mas tarde';
            if (is_numeric($respuesta['id'])) {
                $sql = mysql_query("SELECT * FROM user WHERE id='" . mysql_esc($respuesta['id']) . "' LIMIT 1");
                if ($fetch = mysql_fetch_assoc($sql)) {
                    mysql_query("DELETE FROM administrador WHERE id='" . mysql_esc($fetch['admin_id']) . "' LIMIT 1");
                    mysql_query("DELETE FROM admin_profile WHERE admin_id='" . mysql_esc($fetch['admin_id']) . "' LIMIT 1");
                    $sql_delete = "DELETE FROM user WHERE id='" . mysql_esc($respuesta['id']) . "' LIMIT 1";
                    if (mysql_query($sql_delete)) {
                        $respuesta['status'] = 'success';
                        $respuesta['message'] = 'Admin eliminado correctamente';
                    }
                }
            }
            echo json_encode($respuesta);
            break;

        case 'editar_admin_perfil':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['message'] = 'No ha sido posible editar los datos de perfil del admin, intentalo mas tarde';

            $respuesta['datos_post']['direccion'] = $_POST['direccion'] ?? '';
            $respuesta['datos_post']['telefono'] = $_POST['telefono'] ?? '';
            $respuesta['datos_post']['admin_profile_id'] = $_POST['admin_profile_id'] ?? '';

            $info_editar_perfil = bn_editar_perfil_admin($respuesta['datos_post']);
            if ($info_editar_perfil == true) $respuesta['status'] = 'success';

            echo json_encode($respuesta);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
    exit();
}
