<?php

    session_start();
    if( !isset( $_SESSION['userid'] ) ){
        header( 'Location: index.php' );
        die();
    }
?>

<!-- La página ingreso.php se compone de 

-un formulario compuesto de 
    -una caja de texto y 
    -un botón “Ingresar”. 

**Debe validarse que el valor introducido sea una cifra numérica mayor de cero e inferior a diez mil euros.**

El usuario debe ser redirigido a la página de gestión donde debe mostrarse actualizado su saldo. -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso</title>
</head>
<body>
    <section>
        <a href="gestion.php">volver</a>
        <h1>Ingreso</h1>
        <form action="includes/control_ingreso.php" method="post">
            <label for="monto">Monto a ingresar</label>
            <input type="text" name="monto" id="monto">

            <?php if( isset( $_SESSION['errors']['monto'] ) ): ?>
                <p><?= $_SESSION['errors']['monto'] ?></p>
                <?php unset( $_SESSION['errors']['monto'] ); ?>
            <?php endif; ?>

            <input type="submit" value="Ingresar">
        </form>
    </section>
</body>
</html>