<?php

    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
        header( 'Location: ../ingreso.php' );
        exit();
    }
    session_start();

    $monto = htmlspecialchars( $_POST['monto'] );

    if( !is_numeric( $monto ) ){
        $_SESSION['errors']['monto'] = 'Debe ingresar un valor numérico';
        header( 'Location: ../ingreso.php' );
        exit();
    }

    if( $monto > 10000 || $monto <= 0 ){
        $_SESSION['errors']['monto'] = ( $monto > 10000 ) ? 'El monto a ingresar no debe superar los 10.000 euros' : 'Monto inválido';
        header( 'Location: ../ingreso.php' );
        exit();
    }

    $_SESSION['usuario']['saldo'] += sprintf( '%.2f', $monto );

    header( 'Location: actualizar_saldo.php?saldo=suma' );
    exit();