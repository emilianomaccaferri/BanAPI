<?php
class PlayerActions
    {

        public static function pregJson($data)
            {

                return preg_replace("/%20/", " ", json_encode($data));
            }

        public function read($ID, $realID)
            {
                if($ID == $realID)
                    {

                        $files       = glob("players/*");
                        $jsonarray[] = array();
                        foreach($files as $file)
                            {
                                $data        = json_decode(file_get_contents($file), true);
                                $name        = $data[0]["name"];
                                $reason      = $data[0]["reason"];
                                $date        = $data[0]["date"];
                                $uuid        = $data[0]["uuid"];

                                $jsonarray[] = array(
                                        "name" => $name,
                                        "reason" => $reason,
                                        "date" => $date,
                                        "uuid" => $uuid
                                );
                              }

                              echo $this->pregJson($jsonarray);

                              }

                              else
                                  {
                                      $message[] = array(
                                              "error" => "Wrong ID"
                                      );
                                      die(json_encode($message));
                                  }
                          }

        public function insert($player, $reason, $date, $ID, $realID, $uuid)
            {
                if($ID == $realID)
                    {

                        $writePlayer = fopen("players/$player.json", 'w');
                        $infos[]     = array(
                                "name" => $player,
                                "reason" => $reason,
                                "date" => $date,
                                "uuid" => $uuid

                        );
                        $message[]   = array(
                                "message" => "Player $player has been added"
                        );
                        echo json_encode($message);
                        fwrite($writePlayer, json_encode($infos));
                        fclose($writePlayer);
                    }
                else
                    {
                        $message[] = array(
                                "error" => "Wrong ID"
                        );
                        die(json_encode($message));
                    }
            }
        public function remove($player, $ID, $realID)
            {
                if($ID == $realID)
                    {

                        if(!file_exists("players/$player.json"))
                            {
                                $message[] = array(
                                        "error" => "Player $player not found"
                                );
                                die(json_encode($message));
                            }

                        die(json_encode(unlink("players/$player.json")));
                    }
                else
                    {
                        $message[] = array(
                                "error" => "Wrong ID"
                        );
                        die(json_encode($message));
                    }
            }
        public function readPlayer($name, $ID, $realID)
            {
                if($ID == $realID)
                    {

                        $path    = "players/$name.json";
                        $data    = json_decode(file_get_contents($path), true);
                        echo $this->pregJson($data);

                    }
                else
                    {
                        $message[] = array(
                                'error' => 'ID not found'
                        );
                        echo json_encode($message);
                    }
            }
    }
?>
