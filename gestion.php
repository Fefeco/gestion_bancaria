<?php
    session_start();
    if( !isset( $_SESSION['userid'] ) ){
        header( 'Location: index.php' );
        die();
    }

    $nombre = $_SESSION['usuario']['nombre'];
    $apellidos = $_SESSION['usuario']['apellidos'];
    $saldo = $_SESSION['usuario']['saldo'];
    $ingreso_actual = $_SESSION['usuario']['ingreso_actual'];

    if( isset( $_COOKIE['ultimo_ingreso'] ) ){
        $ultimo_ingreso = date( 'D d M H:i:s', $_COOKIE['ultimo_ingreso'] );
    } else $ultimo_ingreso = date( 'D d M H:i:s', $ingreso_actual );

    setcookie( 'ultimo_ingreso', $ingreso_actual, time() + 60 * 60 * 24 * 30 );
?>
<!-- Está pagina debe indicar al usuario 
- la fecha del último acceso registrado mediante cookies. 

Esta página muestra al usuario 
- su nombre, 
- apellido, 
- el saldo del que dispone y 
- dos botones ingreso y reintegro
- uno para cerrar la sesión

). Cada uno de los botones redirige al usuario a las página ingreso.php y reintegro.php. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Gestion</title>
    <style>
        .btn2 {
            padding: 1rem 0.75rem;
        }
    </style>
</head>
<body>
    <section class="container-md mt-5 p-5 pt-1 shadow rounded" style="max-width: 600px;">
        <p class="text-end"><small>Último acceso: <?= $ultimo_ingreso ?>hs</small></p>

        <?php if( isset( $_SESSION['success']['ingreso'] ) ): ?>
            <p><?= $_SESSION['success']['ingreso'] ?></p>
            <?php unset ( $_SESSION['success']['ingreso'] ); ?>
        <?php endif; ?>

        <h1 class="display-6" ><?= $nombre ?></h1>
        <p class="fw-light "><?= $apellidos ?></p>

        <h2>Saldo</h2>
        <p><?= $saldo ?> €</p>

        <a href="ingreso.php"><button class="btn btn-primary btn2" >Ingresar dinero</button></a>
        <a href="reintegro.php"><button class="btn btn-outline-primary">Retirar dinero</button></a>
        <a href="includes/logout.php"><button class="btn btn-secondary btn-sm">Cerrar sesión</button></a>

    </section>

</body>
</html>
