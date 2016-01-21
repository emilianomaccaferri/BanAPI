<?php

  class ReadAll{

    public function read($ID, $realID){

      if($ID == $realID){

        function pregJson($data){

          return preg_replace("/%20/", " ", json_encode($data));

        }

        $files = glob("players/*");
        $nFiles = count($files);

        $jsonarray[] = array();

        foreach($files as $file){

          $data = json_decode(file_get_contents($file), true);
          $name = $data[0]["name"];
          $reason = $data[0]["reason"];
          $date = $data[0]["date"];

          $jsonArray[] = array(

            "name" => $name,
            "reason" => $reason,
            "date" => $date

          );


        }

        echo pregJson($jsonArray);


    }else{
    $message[] = array( "error" => "Wrong ID");
      die(json_encode($message));
    }

    }

  }

?>
