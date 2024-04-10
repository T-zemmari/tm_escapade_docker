<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';


if (isset($_POST['accion']) && $_POST['accion'] == 'cliente_suscripcion') :
    $resultado = [];
    $resultado['status'] = 'error';

    $email = $_POST['email'] ?? '';
    $date = date('Y-m-d H:i:s');
    $sql = "SELECT * FROM email_suscripciones WHERE email='" . mysql_esc($email) . "' ";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) == 0) {
        $sql_insert = "INSERT INTO email_suscripciones SET email='" . mysql_esc($email) . "' , activo=1,created_at='" . mysql_esc($date) . "', updated_at='" . mysql_esc($date) . "' ";
        if (mysql_query($sql_insert)) {
            $resultado['status'] = 'success';
        };
    }

    echo json_encode($resultado);
    exit();
endif;

if (isset($_POST['accion']) && $_POST['accion'] == 'modificar_estado_suscripcion') :
    $resultado = [];
    $resultado['status'] = 'error';

    $id = $_POST['data']['id'] ?? '';
    $estado = $_POST['data']['estado'] ?? '';
    $date = date('Y-m-d H:i:s');
    $sql = "UPDATE email_suscripciones SET activo='" . mysql_esc($estado) . "' , updated_at='" . mysql_esc($date) . "' WHERE id='" . mysql_esc($id) . "' LIMIT 1 ";
    if (mysql_query($sql)) {
        $resultado['status'] = 'success';
    }

    echo json_encode($resultado);
    exit();
endif;
