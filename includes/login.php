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
        $pin = filter_input( INPUT_POST, 'pin', FILTER_SANITIZE_SPECIAL_CHARS );
    }

    if( isset($_SESSION['errors']) ){
        header( 'Location: ../index.php' );
        die();
    }
    $archivo = '../datos.dat';
    if( file_exists( $archivo ) ){
        $file = fopen( $archivo, 'r' );
        if( $file ){
            while( !feof( $file ) ){
                $linea = fgets( $file );
                if( empty( $linea ) ) continue;
                list( $campo_cuenta, $campo_pin, $campo_nombre, $campo_apellidos, $campo_saldo ) = explode( ',', $linea );

                if( trim( $campo_cuenta ) !== $cuenta ) continue;
                
                if( trim( $campo_pin ) !== $pin  ){
                    $_SESSION['errors']['pin'] = 'PIN incorrecto';
                    fclose( $file );
                    header( '../index.php' );
                    die();
                }
                
                $ingreso_actual = time();

                $_SESSION['userid'] = session_id();
                $_SESSION['usuario'] = [
                    'cuenta' => $campo_cuenta,
                    'nombre' => $campo_nombre,
                    'apellidos' => $campo_apellidos,
                    'saldo' => $campo_saldo,
                    'ingreso_actual' => $ingreso_actual
                ];
                unset( $campo_cuenta, $campo_pin, $campo_nombre, $campo_apellidos, $campo_saldo );
                header( 'Location: ../gestion.php' );
                die();
            }
            fclose( $file );
            $_SESSION['errors']['no_cuenta'] = 'No existe la cuenta registrada';
            header( 'Location: ../index.php' );
            die();
        } else {
        header( 'Location: ../index.php' );
        die('Error leyendo el archivo');
        }
    } else {
        header( 'Location: ../index.php' );
        die('No se pudo acceder a la base de datos');
    }