<?php

    session_start();
    if( isset( $_COOKIE[session_name()] ) ){
        setcookie( session_name(), '', -1 );
    }
    unset( $_SESSION );
    session_destroy();
    header( 'Location: ../index.php' );
    die();