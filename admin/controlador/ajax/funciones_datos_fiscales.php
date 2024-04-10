<?php
include '../../../config/config.php';
include '../../../includes/funciones/funciones_varias.php';


function bn_guardar_datos_fiscales($datos)
{
    $guardado = false;
    $fecha_hoy = date('Y-m-d H:i:s');
    $sql_insert_adress = "INSERT INTO address_empresa SET tipo_via='" . mysql_esc($datos['select_tipo_de_via']) . "',
    direccion='" . mysql_esc($datos['direccion']) . "', 
    numero='" . mysql_esc($datos['numero']) . "', 
    piso='" . mysql_esc($datos['piso']) . "', 
    puerta='" . mysql_esc($datos['puerta']) . "', 
    cp='" . mysql_esc($datos['codigo_postal']) . "', 
    municipio='" . mysql_esc($datos['municipio']) . "', 
    ciudad='" . mysql_esc($datos['ciudad']) . "', 
    pais='" . mysql_esc($datos['pais']) . "', 
    es_principal=1, 
    activo=1, 
    created_at='" . mysql_esc($fecha_hoy) . "', 
    updated_at='" . mysql_esc($fecha_hoy) . "'
    ";



    if (mysql_query($sql_insert_adress)) {
        $last_id = mysql_insert_id();
        if (is_numeric($last_id)) {
            $sql_insert_datos_fiscales = "INSERT INTO datos_fiscales SET document_type='" . mysql_esc($datos['select_tipo_de_documento']) . "',
            razon_social='" . mysql_esc($datos['razon_social']) . "', 
            document_id='" . mysql_esc($datos['documento_id']) . "', 
            adress_prim_id='" . mysql_esc($last_id) . "', 
            email='" . mysql_esc($datos['email']) . "', 
            fix_phone='" . mysql_esc($datos['telefono_fijo']) . "', 
            movil_phone='" . mysql_esc($datos['telefono_movil']) . "', 
            url_logo='" . mysql_esc($datos['url_logo']) . "', 
            active=1, 
            created_at='" . mysql_esc($fecha_hoy) . "', 
            updated_at='" . mysql_esc($fecha_hoy) . "' 
            ";
            if (mysql_query($sql_insert_datos_fiscales)) {
                $id_datos_fiscales = mysql_insert_id();
                mysql_query("UPDATE address_empresa SET id_datos_fiscales='" . mysql_esc($id_datos_fiscales) . "' WHERE id='" . mysql_esc($last_id) . "' LIMIT 1 ");
                $guardado = true;
            }
        }
    }

    return $guardado;
}

function bn_editar_datos_fiscales($datos)
{
    $guardado = false;
    $fecha_hoy = date('Y-m-d H:i:s');
    $sql_update_adress = "UPDATE  address_empresa SET tipo_via='" . mysql_esc($datos['select_tipo_de_via']) . "',
    direccion='" . mysql_esc($datos['direccion']) . "', 
    numero='" . mysql_esc($datos['numero']) . "', 
    piso='" . mysql_esc($datos['piso']) . "', 
    puerta='" . mysql_esc($datos['puerta']) . "', 
    cp='" . mysql_esc($datos['codigo_postal']) . "', 
    municipio='" . mysql_esc($datos['municipio']) . "', 
    ciudad='" . mysql_esc($datos['ciudad']) . "', 
    pais='" . mysql_esc($datos['pais']) . "', 
    updated_at='" . mysql_esc($fecha_hoy) . "' WHERE id='" . mysql_esc($datos['adress_id']) . "' LIMIT 1";
    mysql_query($sql_update_adress);

    $add_sql_update_datos_fiscales = "";

    if ($datos['url_logo'] != '') {
        $add_sql_update_datos_fiscales .= " , url_logo='" . mysql_esc($datos['url_logo']) . "' ";
    }

    $sql_update_datos_fiscales = "UPDATE datos_fiscales SET document_type='" . mysql_esc($datos['select_tipo_de_documento']) . "',
            razon_social='" . mysql_esc($datos['razon_social']) . "', 
            document_id='" . mysql_esc($datos['documento_id']) . "', 
            email='" . mysql_esc($datos['email']) . "', 
            fix_phone='" . mysql_esc($datos['telefono_fijo']) . "', 
            movil_phone='" . mysql_esc($datos['telefono_movil']) . "',  
            updated_at='" . mysql_esc($fecha_hoy) . "' " . $add_sql_update_datos_fiscales . " WHERE id='" . mysql_esc($datos['datos_fiscales_id']) . "' LIMIT 1";
    if (mysql_query($sql_update_datos_fiscales)) $guardado = true;

    return $guardado;
}


function bn_guardar_nueva_direccion_fiscal($datos)
{
    $guardado = false;

    if (is_numeric($datos['id_datos_fiscales'])) {
        $fecha_hoy = date('Y-m-d H:i:s');
        $sql_insert_adress = "INSERT INTO address_empresa SET tipo_via='" . mysql_esc($datos['select_tipo_de_via']) . "',
        id_datos_fiscales='" . mysql_esc($datos['id_datos_fiscales']) . "', 
        direccion='" . mysql_esc($datos['direccion']) . "', 
        numero='" . mysql_esc($datos['numero']) . "', 
        piso='" . mysql_esc($datos['piso']) . "', 
        puerta='" . mysql_esc($datos['puerta']) . "', 
        cp='" . mysql_esc($datos['codigo_postal']) . "', 
        municipio='" . mysql_esc($datos['municipio']) . "', 
        ciudad='" . mysql_esc($datos['ciudad']) . "', 
        pais='" . mysql_esc($datos['pais']) . "', 
        es_principal=0, 
        activo=1, 
        created_at='" . mysql_esc($fecha_hoy) . "', 
        updated_at='" . mysql_esc($fecha_hoy) . "' ";

        if (mysql_query($sql_insert_adress)) $guardado = true;
    }

    return $guardado;
}

function bn_editar_direccion_fiscal($datos)
{
    $guardado = false;

    $fecha_hoy = date('Y-m-d H:i:s');
    $sql_update_adress = "UPDATE  address_empresa SET tipo_via='" . mysql_esc($datos['select_tipo_de_via']) . "',
    direccion='" . mysql_esc($datos['direccion']) . "', 
    numero='" . mysql_esc($datos['numero']) . "', 
    piso='" . mysql_esc($datos['piso']) . "', 
    puerta='" . mysql_esc($datos['puerta']) . "', 
    cp='" . mysql_esc($datos['codigo_postal']) . "', 
    municipio='" . mysql_esc($datos['municipio']) . "', 
    ciudad='" . mysql_esc($datos['ciudad']) . "', 
    pais='" . mysql_esc($datos['pais']) . "', 
    updated_at='" . mysql_esc($fecha_hoy) . "' WHERE id='" . mysql_esc($datos['adress_id']) . "' LIMIT 1";

    //echo '<pre>'; print_r($sql_update_adress); echo '</pre>';


    if (mysql_query($sql_update_adress)) {
        if ($datos['select_es_principal'] == 1) {
            $sql = "SELECT * FROM address_empresa WHERE id_datos_fiscales='" . mysql_esc($datos['id_datos_fiscales']) . "' ";
            $result = mysql_query($sql);
            while ($fetch_lite = mysql_fetch_assoc($result)) :
                if ($fetch_lite['id'] == $datos['adress_id']) {
                    $sql_update="UPDATE address_empresa SET es_principal=1 WHERE id='" . mysql_esc($fetch_lite['id']) . "' LIMIT 1 ";
                    mysql_query($sql_update);
                }else{
                    $sql_update="UPDATE address_empresa SET es_principal=0 WHERE id='" . mysql_esc($fetch_lite['id']) . "' LIMIT 1 ";
                    mysql_query($sql_update);
                }
            endwhile;
            mysql_query("UPDATE datos_fiscales SET adress_prim_id='" . mysql_esc($datos['adress_id']) . "' WHERE id='" . mysql_esc($datos['id_datos_fiscales']) . "' LIMIT 1");
        }
        $guardado = true;
    }

    return $guardado;
}



if (isset($_POST['accion']) && $_POST['accion'] != '') {

    switch ($_POST['accion']) {

        case 'guardar_datos_fiscales':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['datos_guardados_correctamente'] = 'error';

            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['razon_social'] = $_POST['razon_social'] ?? '';
            $respuesta['datos_post']['select_tipo_de_documento'] = $_POST['select_tipo_de_documento'] ?? '';
            $respuesta['datos_post']['documento_id'] = $_POST['documento_id'] ?? '';
            $respuesta['datos_post']['email'] = $_POST['email'] ?? '';
            $respuesta['datos_post']['telefono_fijo'] = $_POST['telefono_fijo'] ?? '';
            $respuesta['datos_post']['telefono_movil'] = $_POST['telefono_movil'] ?? '';

            $respuesta['datos_post']['select_tipo_de_via'] = $_POST['select_tipo_de_via'] ?? '';
            $respuesta['datos_post']['direccion'] = $_POST['direccion'] ?? '';
            $respuesta['datos_post']['numero'] = $_POST['numero'] ?? '';
            $respuesta['datos_post']['piso'] = $_POST['piso'] ?? '';
            $respuesta['datos_post']['puerta'] = $_POST['puerta'] ?? '';
            $respuesta['datos_post']['codigo_postal'] = $_POST['codigo_postal'] ?? '';
            $respuesta['datos_post']['municipio'] = $_POST['municipio'] ?? '';
            $respuesta['datos_post']['ciudad'] = $_POST['ciudad'] ?? '';
            $respuesta['datos_post']['pais'] = $_POST['pais'] ?? '';

            $respuesta['datos_post']['avatar'] = $_FILES['avatar'] ?? '';
            $respuesta['datos_post']['url_logo'] =  '';

            $logo_subido = false;


            $carpeta_uploads = '../../../admin/uploads/imgs/datos_fiscales/';

            if ($respuesta['datos_post']['avatar'] != '' && $respuesta['datos_post']['avatar']['name'] != '') {
                $nombre_logo = time() . '_' . uniqid() . '_' . $_FILES['avatar']['name'];
                $ruta_logo = $carpeta_uploads . $nombre_logo;
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta_logo)) {
                    $logo_subido = true;
                }
                if ($logo_subido) $respuesta['datos_post']['url_logo'] = '/admin/uploads/imgs/datos_fiscales/' . $nombre_logo;
            }

            $respuesta['datos_guardados_correctamente'] = bn_guardar_datos_fiscales($respuesta['datos_post']);

            if ($respuesta['datos_guardados_correctamente'] != true) {
                if (file_exists($respuesta['datos_post']['url_logo'])) {
                    unlink($respuesta['datos_post']['url_logo']);
                }
            } else {
                $respuesta['status'] = 'success';
            }

            echo json_encode($respuesta);
            break;

        case 'editar_datos_fiscales':

            $respuesta = [];
            $respuesta['status'] = 'error';

            $respuesta['datos_post'] = [];

            $respuesta['datos_post']['razon_social'] = $_POST['razon_social'] ?? '';
            $respuesta['datos_post']['select_tipo_de_documento'] = $_POST['select_tipo_de_documento'] ?? '';
            $respuesta['datos_post']['documento_id'] = $_POST['documento_id'] ?? '';
            $respuesta['datos_post']['email'] = $_POST['email'] ?? '';
            $respuesta['datos_post']['telefono_fijo'] = $_POST['telefono_fijo'] ?? '';
            $respuesta['datos_post']['telefono_movil'] = $_POST['telefono_movil'] ?? '';
            $respuesta['datos_post']['select_tipo_de_via'] = $_POST['select_tipo_de_via'] ?? '';
            $respuesta['datos_post']['direccion'] = $_POST['direccion'] ?? '';
            $respuesta['datos_post']['numero'] = $_POST['numero'] ?? '';
            $respuesta['datos_post']['piso'] = $_POST['piso'] ?? '';
            $respuesta['datos_post']['puerta'] = $_POST['puerta'] ?? '';
            $respuesta['datos_post']['codigo_postal'] = $_POST['codigo_postal'] ?? '';
            $respuesta['datos_post']['municipio'] = $_POST['municipio'] ?? '';
            $respuesta['datos_post']['ciudad'] = $_POST['ciudad'] ?? '';
            $respuesta['datos_post']['pais'] = $_POST['pais'] ?? '';
            $respuesta['datos_post']['adress_id'] = $_POST['adress_id'] ?? '';
            $respuesta['datos_post']['datos_fiscales_id'] = $_POST['datos_fiscales_id'] ?? '';
            $respuesta['datos_post']['url_logo_anterior'] = $_POST['url_logo_anterior'] ?? '';


            $respuesta['datos_post']['avatar'] = $_FILES['avatar'] ?? '';
            $respuesta['datos_post']['url_logo'] =  '';

            $logo_subido = false;

            if (!is_numeric($respuesta['datos_post']['adress_id']) || !is_numeric($respuesta['datos_post']['datos_fiscales_id'])) {
                $respuesta['motivo'] = 'Faltan identificadores de los datos fiscales o de la direccion';
            } else {

                $carpeta_uploads = '../../../admin/uploads/imgs/datos_fiscales/';

                if ($respuesta['datos_post']['avatar'] != '' && $respuesta['datos_post']['avatar']['name'] != '') {
                    $nombre_logo = time() . '_' . uniqid() . '_' . $_FILES['avatar']['name'];
                    $ruta_logo = $carpeta_uploads . $nombre_logo;
                    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $ruta_logo)) {
                        $logo_subido = true;
                        $logo_anterior = '../..' . $respuesta['datos_post']['url_logo_anterior'];
                        if (file_exists($logo_anterior)) {
                            unlink($logo_anterior);
                        }
                    }
                    if ($logo_subido) $respuesta['datos_post']['url_logo'] = '/admin/uploads/imgs/datos_fiscales/' . $nombre_logo;
                }

                $respuesta['datos_guardados_correctamente'] = bn_editar_datos_fiscales($respuesta['datos_post']);

                if ($respuesta['datos_guardados_correctamente'] != true) {
                    if (file_exists($respuesta['datos_post']['url_logo'])) {
                        unlink($respuesta['datos_post']['url_logo']);
                    }
                } else {
                    $respuesta['status'] = 'success';
                }
            }

            echo json_encode($respuesta);
            break;


        case 'nueva_direccion_fiscal':

            $respuesta = [];
            $respuesta['status'] = 'error';

            $respuesta['datos_post'] = [];


            $respuesta['datos_post']['select_tipo_de_via'] = $_POST['select_tipo_de_via'] ?? '';
            $respuesta['datos_post']['direccion'] = $_POST['direccion'] ?? '';
            $respuesta['datos_post']['numero'] = $_POST['numero'] ?? '';
            $respuesta['datos_post']['piso'] = $_POST['piso'] ?? '';
            $respuesta['datos_post']['puerta'] = $_POST['puerta'] ?? '';
            $respuesta['datos_post']['codigo_postal'] = $_POST['codigo_postal'] ?? '';
            $respuesta['datos_post']['municipio'] = $_POST['municipio'] ?? '';
            $respuesta['datos_post']['ciudad'] = $_POST['ciudad'] ?? '';
            $respuesta['datos_post']['pais'] = $_POST['pais'] ?? '';
            $respuesta['datos_post']['id_datos_fiscales'] = $_POST['id_datos_fiscales'] ?? '';


            if (bn_guardar_nueva_direccion_fiscal($respuesta['datos_post'])) {
                $respuesta['status'] = 'success';
            }


            echo json_encode($respuesta);
            break;

        case 'editar_direccion_fiscal':

            $respuesta = [];
            $respuesta['status'] = 'error';

            $respuesta['datos_post'] = [];


            $respuesta['datos_post']['select_tipo_de_via'] = $_POST['select_tipo_de_via'] ?? '';
            $respuesta['datos_post']['direccion'] = $_POST['direccion'] ?? '';
            $respuesta['datos_post']['numero'] = $_POST['numero'] ?? '';
            $respuesta['datos_post']['piso'] = $_POST['piso'] ?? '';
            $respuesta['datos_post']['puerta'] = $_POST['puerta'] ?? '';
            $respuesta['datos_post']['codigo_postal'] = $_POST['codigo_postal'] ?? '';
            $respuesta['datos_post']['municipio'] = $_POST['municipio'] ?? '';
            $respuesta['datos_post']['ciudad'] = $_POST['ciudad'] ?? '';
            $respuesta['datos_post']['pais'] = $_POST['pais'] ?? '';
            $respuesta['datos_post']['adress_id'] = $_POST['adress_id'] ?? '';
            $respuesta['datos_post']['select_es_principal'] = $_POST['select_es_principal'] ?? '';
            $respuesta['datos_post']['id_datos_fiscales'] = $_POST['id_datos_fiscales'] ?? '';



            if (bn_editar_direccion_fiscal($respuesta['datos_post'])) {
                $respuesta['status'] = 'success';
            }


            echo json_encode($respuesta);
            break;


        case 'eliminar_direccion':

            $respuesta = [];
            $respuesta['status'] = 'error';
            $respuesta['id'] = $_POST['id'] ?? '';
            $respuesta['message'] = 'No ha sido posible eliminar la direccion, intentalo mas tarde';
            if (is_numeric($respuesta['id'])) {
                $sql = mysql_query("SELECT * FROM address_empresa WHERE id='" . mysql_esc($respuesta['id']) . "' AND es_principal=1");
                if (mysql_num_rows($sql) == 0) {
                    $sql_delete = "DELETE FROM address_empresa WHERE id='" . mysql_esc($respuesta['id']) . "' LIMIT 1";
                    if (mysql_query($sql_delete)) {
                        $respuesta['status'] = 'success';
                        $respuesta['message'] = 'Dirección eliminada correctamente';
                    }
                } else {
                    $respuesta['message'] = 'La dirección no puede ser eliminada porque es la principal, debes escoger otra como principal antes de seguir';
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
