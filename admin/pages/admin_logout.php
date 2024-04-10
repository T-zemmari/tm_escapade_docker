<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}

session_destroy();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=/admin_login">
    <title>Redirecting...</title>
</head>
<body>
    <script>
        // Redirige usando JavaScript en caso de que la redirección automática no funcione
        window.location.href = '/admin_login';
    </script>
</body>
</html>