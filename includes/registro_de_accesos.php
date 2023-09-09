<?php

    function registro_de_accesos( $user, $time, $ip ){
        $hora = date( 'H:i', $time );
        $nombre_archivo = 'log'.date( 'dmy', $time ).'.log';
        $ruta = __DIR__.'/../log';
        
        $ruta_absoluta = crear_archivo( $ruta, $nombre_archivo );
        $registro = $user.', '.$hora.',['.$ip."]\r\n";

        escribir_registro( $registro, $ruta_absoluta );
    }
    

    function crear_archivo( $ruta, $nombre_archivo ){
        if( !is_dir( $ruta ) ){
            mkdir( $ruta );
        } 

        if( !file_exists( $ruta.'/'.$nombre_archivo ) ){
            $file = fopen( $ruta.'/'.$nombre_archivo, 'w' );
            fclose( $file );
        }
        return $ruta.'/'.$nombre_archivo;
    }

    function escribir_registro( $registro, $ruta_absoluta ){
        $file = fopen( $ruta_absoluta, 'a' );
        fwrite( $file, $registro );
        fclose( $file );
    }