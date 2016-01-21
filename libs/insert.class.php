
<?php

  class InsertPlayer{

    public function insert($player, $reason, $date, $ID, $realID){

   if($ID == $realID){
     $writePlayer = fopen("players/$player.json", 'w');

     $infos[] = array(

       "name" => $player,
       "reason" => $reason,
       "date" => $date

     );

     $message[] = array( "message"=> "Player $player has been added");
     echo json_encode($message);
     fwrite($writePlayer, json_encode($infos));
     fclose($writePlayer);

   }else{
   $message[] = array( "error" => "Wrong ID");
     die(json_encode($message));
   }

  }
}

?>
