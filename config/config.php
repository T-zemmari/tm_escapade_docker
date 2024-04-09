<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$db_host = $_ENV['DB_HOST'];
$db_user = $_ENV['DB_USER'];
$db_pass = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_DATABASE'];

// define('STRIPE_KEY',$_ENV['STRIPE_KEY']);
// define('STRIPE_KEY_PUBLIC',$_ENV['STRIPE_KEY_PUBLIC']);

$isLocal = ($_SERVER['SERVER_NAME'] === 'localhost' || $_SERVER['SERVER_NAME'] === '127.0.0.1' || $_SERVER['SERVER_NAME'] === 'escapade.com');

// Modifica ES_DEBUG dependiendo del entorno
define('ES_DEBUG', $isLocal ? 1 : 0);


function fn_crear_conexion_a_base_de_datos($local = false)
{
    global $db_host;
    global $db_user;
    global $db_pass;
    global $db_name;
    $link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    mysqli_set_charset($link, 'utf8');

    if (mysqli_connect_error()) {
        echo "Error de conexión a la base de datos: " . mysqli_connect_error();
    } else {
        return $link;
    }
}

$link = fn_crear_conexion_a_base_de_datos(true);

// funcion mysql_query

function mysql_query($query)
{
    global $link;
    if ($link == '') {
        $link = fn_crear_conexion_a_base_de_datos(true);
    }
    $respuesta = mysqli_query($link, $query);
    return $respuesta;
}

function mysql_insert_id()
{
    global $link;
    return mysqli_insert_id($link);
}

function mysql_fetch_assoc($result)
{
    global $link;
    if ($result === false) {
        return mysqli_error($link);
    }
    return mysqli_fetch_assoc($result);
}
function mysql_fetch_array($datos)
{
    global $link;
    if ($datos === false) {
        return mysqli_error($link);
    }
    return mysqli_fetch_array($datos);
}
function mysql_real_escape_string($datos)
{
    global $link;
    return mysqli_real_escape_string($link, $datos);
}

function mysql_esc($datos)
{
    return mysql_real_escape_string($datos);
}

function mysql_num_rows($result)
{
    if ($result === false) {
        return false;
    } else {
        return mysqli_num_rows($result);
    }
}
