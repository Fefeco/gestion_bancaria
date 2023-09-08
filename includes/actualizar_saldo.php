<?php

    session_start();
    if( !isset( $_SESSION['userid'] ) ){
        header( 'Location: index.php' );
        die();
    }

    $archivo = '../datos.dat';

    if( file_exists( $archivo ) ){
        $file = fopen( $archivo, 'r' );
        if( $file ){
            $array_datos = array();

            while( !feof( $file ) ){
                
                $linea = fgets( $file );

                if( empty( $linea ) ) continue;

                list( 
                    $array_linea['cuenta'], 
                    $array_linea['pin'], 
                    $array_linea['nombre'], 
                    $array_linea['apellidos'], 
                    $array_linea['saldo'] 
                    ) = explode( ',', $linea );

                if( $_SESSION['usuario']['cuenta'] === $array_linea['cuenta'] ){
                    $array_linea['saldo'] = " ".$_SESSION['usuario']['saldo']."\r\n";
                }
                array_push( $array_datos, $array_linea );
            }
            fclose( $file );

        } else {
        header( 'Location: ../index.php' );
        die('Error leyendo el archivo');
        }
    } else {
        header( 'Location: ../index.php' );
        die('No se pudo acceder a la base de datos');
    }

    if( file_exists( $archivo ) ){
        @$file = fopen( $archivo, 'w' );
        if( $file ){
            foreach( $array_datos as $array_linea ){
                $linea = implode( ',',$array_linea );
                fwrite( $file, $linea );
            }
            fclose( $file );
            $_SESSION['success']['ingreso'] = 'El monto se ah ingresado con éxito';
            header( 'Location: ../gestion.php' );
            die();
        } else {
            header( 'Location: ../index.php' );
            die('Error de escritura');
        }
    } else {
        header( 'Location: ../index.php' );
        die('No se pudo acceder a la base de datos');
    }