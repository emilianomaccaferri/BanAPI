
<?php

  class RemovePlayer{

    public function remove($player, $ID, $realID){

    if($ID == $realID){

      if(!file_exists("players/$player.json")){

        $message[] = array( "error" => "Player $player not found");
        die(json_encode($message));

      }

      unlink("players/$player.json");

      $message[] = array( "message" => "Player $player has been deleted");
      echo json_encode($message);

    }
    else{
    $message[] = array( "error" => "Wrong ID");
      die(json_encode($message));
    }


  }
}
?>
