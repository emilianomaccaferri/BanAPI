<?php
set_error_handler( 'exceptions_error_handler' );
header( 'Content-Type: application/json' );
ini_set( 'display_errors', 1 );

///// LIBS /////
require 'libs/player-actions.class.php';
////////////////

$url        = $_SERVER[ 'REQUEST_URI' ];
$args       = explode( "/", $url );
$argsLength = sizeof( $args );

///// LOAD METHODS /////
$actions = new PlayerActions();
///////////////////////

function exceptions_error_handler( $severity, $message, $filename, $lineno )
{
    if ( error_reporting() == 0 )
    {
        return;
    }
    if ( error_reporting() & $severity )
    {
        throw new ErrorException( $message, 0, $severity, $filename, $lineno );
    }
}

try
{
    if ( !file_exists( "data/config.json" ) )
    {

        $key = md5( microtime() . rand() );

        $json[ ] = array(

             "id" => $key
        );

        $fp = fopen( "data/config.json", 'w' );
        fwrite( $fp, json_encode( $json ) );
        fclose( $fp );

        die( "ID registered in your config.json file. Refresh the page to get the API work." );

    }
    $getJson = file_get_contents( "data/config.json" );
    $data    = json_decode( $getJson, true );


    $realID = $data[ 0 ][ "id" ];
    $action = $args[ 1 ];

    switch ( $action )
    {

        case 'insert':

            $player = $args[ 2 ];
            $date   = $args[ 3 ];
            $reason = $args[ 4 ];
            $ID     = $args[ 5 ];

            $actions->insert( $player, $reason, $date, $ID, $realID );

            break;

        case 'remove':

            $player = $args[ 2 ];
            $ID     = $args[ 3 ];

            $actions->remove( $player, $ID, $realID );

            break;

        case 'readall':

            $ID = $args[ 2 ];

            $actions->read( $ID, $realID );

            break;

        case 'read':

            $player = $args[ 2 ];
            $ID     = $args[ 3 ];

            $actions->readPlayer( $player, $ID, $realID );

            break;

        default:

            $message[ ] = array(
                 "error" => "Invalid request: no action specified"
            );
            die( json_encode( $message ) );

            break;

    }

}
catch ( Exception $e )
{

    $errors[ ] = array(

         "error" => $e->getMessage()

    );

    echo json_encode( $errors, JSON_UNESCAPED_SLASHES );

}
?>
