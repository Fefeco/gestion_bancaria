<?php

    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
        header( 'Location: ../reintegro.php' );
        exit();
    }
    session_start();

    $monto = htmlspecialchars( $_POST['monto'] );

    if( !is_numeric( $monto ) ){
        $_SESSION['errors']['monto'] = 'Debe ingresar un valor numérico';
        header( 'Location: ../ingreso.php' );
        exit();
    }

    $saldo = $_SESSION['usuario']['saldo'];

    if( $monto > $saldo || $monto <= 0 ){
        $_SESSION['errors']['monto'] = ( $monto > $saldo ) ? 'El monto indicado es mayor al saldo en cuenta' : 'Monto inválido';
        header( 'Location: ../reintegro.php' );
        exit();
    }

    $_SESSION['usuario']['saldo'] -= sprintf( '%.2f', $monto );

    header( 'Location: actualizar_saldo.php?saldo=resta' );
    exit();