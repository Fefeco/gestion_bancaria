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

    if( isset( $_COOKIE[$nombre.'ultimo_ingreso'] ) ){
        $ultimo_ingreso = date( 'D d M H:i:s', $_COOKIE[$nombre.'ultimo_ingreso'] );
    } else {
        $ultimo_ingreso = date( 'D d M H:i:s', $ingreso_actual );
    }

    setcookie( $nombre.'ultimo_ingreso', $ingreso_actual, time() + 60 * 60 * 24 * 30 );
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>Gestion</title>
    <style>
        .btn2 {
            padding: 1rem 0.75rem;
        }
    </style>
</head>
<body>
    <section class="container mt-5 p-5 pt-1 pe-2 shadow rounded" style="max-width: 600px;">
        <p class="text-end fw-light"><small>Último acceso: <?= $ultimo_ingreso ?> hs</small></p>

        <?php if( isset( $_SESSION['success']['saldo'] ) ): ?>
            <p class="py-1 px-3 text-success bg-success-subtle border-success border-start border-3 rounded-1"><?= $_SESSION['success']['saldo'] ?></p>
            <?php unset ( $_SESSION['success']['saldo'] ); ?>
        <?php endif; ?>

        <div class="row mb-4">

            <div class="col-3 col-md-2">
                <img class="img-fluid" src="assets/person-square.svg" alt="user_picture" style="width: 100%;"">
            </div>

            <div class="col">
                <div class="row">
                    <h1 class="display-6 mb-1"><?= $nombre ?></h1>
                </div>
                <div class="row">
                    <p class="fw-light"><?= $apellidos ?></p>
                </div>
            </div>

        </div>

        <h2>Saldo</h2>
        <p class="lead mb-5"><?= $saldo ?> €</p>

        <div>
            <a href="ingreso.php"><button class="btn btn-primary btn2" >Ingresar dinero</button></a>
            <a href="reintegro.php"><button class="btn btn-outline-primary btn2">Retirar dinero</button></a>
        </div>
        
        <div class="d-flex justify-content-end">
            <a href="includes/logout.php"><button class="btn btn-secondary btn-sm me-4 mt-4">Cerrar sesión</button></a>
        </div>

    </section>

</body>
</html>
