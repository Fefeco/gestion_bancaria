<?php

    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
        header( 'Location: ../index.php' );
        die();
    }

    session_start();

    if( empty( $_POST['cuenta'] ) ){
        $_SESSION['errors']['cuenta'] = 'Debe intoducir el número de cuenta';
    } else {
        $cuenta = htmlspecialchars( $_POST['cuenta'] );
        $_SESSION['cuenta'] = $cuenta;
    }
    
    if( empty( $_POST['pin'] ) ){
        $_SESSION['errors']['pin'] = 'Debe introducir el PIN';
    } else {
        $pass = filter_input( INPUT_POST, 'pin', FILTER_SANITIZE_SPECIAL_CHARS );
    }

    if( isset($_SESSION['errors']) ){
        header( 'Location: ../index.php' );
        die();
    }

    

