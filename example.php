<?php
ini_set('display_errors', 1);
$url = "http://yourdomain.com/readall/id";
$content = file_get_contents($url);
$data = json_decode($content, true);
  if(array_key_exists("error", $data[0])){
    die($data[0]["error"]);
  }
  echo var_dump($content);
   echo json_encode($data[0]["name"]);
?>
