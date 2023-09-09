<?php

    session_start();
    if( !isset( $_SESSION['userid'] ) ){
        header( 'Location: index.php' );
        die();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reintegro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
    <section  class="container-md mt-5 p-5 pt-1 shadow rounded" style="max-width: 600px; height: 422px;">
        <a href="gestion.php">volver</a>
        <h1 class="display-3 mt-4">Reintegro</h1>

        <form class="mt-4" action="includes/control_egreso.php" method="post">
            <label class="form-label lead" for="monto">Monto</label>
            <div class="d-flex gap-1">
                <input type="text" name="monto" id="monto">
                <input class="btn btn-primary btn-sm" type="submit" value="Extraer" style="width: 6rem;">
            </div>
            
            <?php if( isset( $_SESSION['errors']['monto'] ) ): ?>
                <p class='form-text text-danger'><?= $_SESSION['errors']['monto'] ?></p>
                <?php unset( $_SESSION['errors']['monto'] ); ?>
            <?php endif; ?>

        </form>

    </section>
</body>
</html>