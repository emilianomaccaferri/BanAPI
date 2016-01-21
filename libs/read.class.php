<?php

  class Read{

    public function readPlayer($name, $ID, $realID){

      if($ID == $realID){

        function pregJson($data){

          return preg_replace("/%20/", " ", json_encode($data));

        }

        $path = "players/$name.json";
        $data = json_decode(file_get_contents($path), true);
        $reason = $data[0]["reason"];
        $date = $data[0]["date"];
        $infos[] = array(

          'name' => $name,
          'reason' => $reason,
          'date' => $date

        );

        echo pregJson($infos);

      }else{

        $message[] =  array('error' => 'ID not found' );
        echo json_encode($message);

      }

    }

  }

?>
