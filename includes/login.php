<?php

    if( $_SERVER['REQUEST_METHOD'] !== 'POST' ){
        header( 'Location: ../index.php' );
        die();
    }

    session_start();
    include_once 'registro_de_accesos.php';

    // Control de errores
    if( empty( $_POST['cuenta'] ) ){
        $_SESSION['errors']['cuenta'] = 'Debe intoducir el número de cuenta';
    } else {
        $cuenta = htmlspecialchars( $_POST['cuenta'] );
        $_SESSION['cuenta'] = $cuenta;
    }
    
    if( empty( $_POST['pin'] ) ){
        $_SESSION['errors']['pin'] = 'Debe introducir el PIN';
    } else {
        if( mb_strlen( $_POST['pin'] ) !== 4 ){
            $_SESSION['errors']['pin'] = ( mb_strlen( $_POST['pin'] ) > 4 ) ? 'El PIN debe tener un máximo 4 dígitos' : 'El PIN debe ser de 4 dígitos' ;
        }
        if( !is_numeric( $_POST['pin'] ) ){
            $_SESSION['errors']['pin'] = 'El PIN debe ser numérico';
        }
        $pin = filter_input( INPUT_POST, 'pin', FILTER_SANITIZE_SPECIAL_CHARS );
    }

    if( isset( $_SESSION['errors'] ) && !empty( $_SESSION['errors'] ) ){
        header( 'Location: ../index.php' );
        die();
    }
    // Fin control de errores

    $archivo = '../datos.dat';
    if( file_exists( $archivo ) ){
        $file = fopen( $archivo, 'r' );
        if( $file ){
            while( !feof( $file ) ){
                $linea = fgets( $file );
                if( empty( $linea ) ) continue;
                
                list( $campo_cuenta,
                    $campo_pin, 
                    $campo_nombre, 
                    $campo_apellidos, 
                    $campo_saldo 
                ) = explode( ',', $linea );

                if( trim( $campo_cuenta ) !== $cuenta ) continue;
                
                if( trim( $campo_pin ) !== $pin  ){
                    $_SESSION['errors']['pin'] = 'PIN incorrecto';
                    fclose( $file );
                    header( '../index.php' );
                    die();
                }
                fclose( $file );
                
                $ingreso_actual = time();

                $_SESSION['userid'] = session_id();
                $_SESSION['usuario'] = [
                    'cuenta' => trim( $campo_cuenta ),
                    'nombre' => trim( $campo_nombre ),
                    'apellidos' => trim( $campo_apellidos ),
                    'saldo' => trim( $campo_saldo ),
                    'ingreso_actual' => $ingreso_actual
                ];

                registro_de_accesos( $_SESSION['usuario']['nombre'], $ingreso_actual, $_SERVER['REMOTE_ADDR'] );

                unset( $campo_cuenta, $campo_pin, $campo_nombre, $campo_apellidos, $campo_saldo, $ingreso_actual );
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