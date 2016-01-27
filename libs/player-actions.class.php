<?php

class PlayerActions
{

    public function read( $ID, $realID )
    {

        if ( $ID == $realID )
        {

            function pregJson( $data )
            {

                return preg_replace( "/%20/", " ", json_encode( $data ) );

            }

            $files  = glob( "players/*" );
            $nFiles = count( $files );

            $jsonarray[ ] = array( );

            foreach ( $files as $file )
            {

                $data   = json_decode( file_get_contents( $file ), true );
                $name   = $data[ 0 ][ "name" ];
                $reason = $data[ 0 ][ "reason" ];
                $date   = $data[ 0 ][ "date" ];

                $jsonArray[ ] = array(

                     "name" => $name,
                    "reason" => $reason,
                    "date" => $date

                );


            }

            echo pregJson( $jsonArray );


        }
        else
        {
            $message[ ] = array(
                 "error" => "Wrong ID"
            );
            die( json_encode( $message ) );
        }

    }

    public function insert( $player, $reason, $date, $ID, $realID )
    {

        if ( $ID == $realID )
        {
            $writePlayer = fopen( "players/$player.json", 'w' );

            $infos[ ] = array(

                 "name" => $player,
                "reason" => $reason,
                "date" => $date

            );

            $message[ ] = array(
                 "message" => "Player $player has been added"
            );
            echo json_encode( $message );
            fwrite( $writePlayer, json_encode( $infos ) );
            fclose( $writePlayer );

        }
        else
        {
            $message[ ] = array(
                 "error" => "Wrong ID"
            );
            die( json_encode( $message ) );
        }

    }

    public function remove( $player, $ID, $realID )
    {

        if ( $ID == $realID )
        {

            if ( !file_exists( "players/$player.json" ) )
            {

                $message[ ] = array(
                     "error" => "Player $player not found"
                );
                die( json_encode( $message ) );

            }

            unlink( "players/$player.json" );

            $message[ ] = array(
                 "message" => "Player $player has been deleted"
            );
            echo json_encode( $message );

        }
        else
        {
            $message[ ] = array(
                 "error" => "Wrong ID"
            );
            die( json_encode( $message ) );
        }
    }

    public function readPlayer( $name, $ID, $realID )
    {

        if ( $ID == $realID )
        {

            function pregJson( $data )
            {

                return preg_replace( "/%20/", " ", json_encode( $data ) );

            }

            $path     = "players/$name.json";
            $data     = json_decode( file_get_contents( $path ), true );
            $reason   = $data[ 0 ][ "reason" ];
            $date     = $data[ 0 ][ "date" ];
            $infos[ ] = array(

                 'name' => $name,
                'reason' => $reason,
                'date' => $date

            );

            echo pregJson( $infos );

        }
        else
        {

            $message[ ] = array(
                 'error' => 'ID not found'
            );
            echo json_encode( $message );

        }

    }

}

?>
