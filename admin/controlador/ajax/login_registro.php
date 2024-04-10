<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';
session_start();

$json = file_get_contents('php://input');
$data = json_decode($json, true);

if (isset($data['accion']) && $data['accion'] != '') {
    switch ($data['accion']) {
        case 'login':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $email = $data['email'] ?? '';
            $password = $data['password'] ?? '';
            if ($email != '' && $password != '') {
                $info = fn_obtener_datos_login_admin($email, $password);
                if (is_numeric($info['admin_id'])) {
                    $_SESSION['info_admin'] = $info;
                    $respuesta['status'] = 'success';
                }
            }
            echo json_encode($respuesta);
            break;

        case 'registro':
            $respuesta = [];
            $respuesta['status'] = 'error';
            $email = $data['email'] ?? '';
            $nombre = $data['nombre'] ?? '';
            $password = $data['password'] ?? '';
            $codigo_registro= trim($data['codigo_registro']) ?? '';
            

            if ($codigo_registro == 'Ta00') {
                if ($email != '' && $password != '' && $nombre != '') {
                    $info = fn_registrar_datos_admin($email, $password, $nombre, '', $codigo_registro);
                    if ($info['estado_registro'] == true) {
                        $respuesta['status'] = 'success';
                    } else {
                        if ($info['existe_email'] == true) {
                            $respuesta['mensaje_error'] = 'El email ya existe';
                        }
                    }
                } else {
                    $respuesta['mensaje_error'] = 'Faltan datos';
                }
            }else{
                $respuesta['mensaje_error'] = 'El codigo de registro es incorrecto';
            }

            echo json_encode($respuesta);
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida.']);
            break;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Acción no proporcionada.']);
}

exit();
