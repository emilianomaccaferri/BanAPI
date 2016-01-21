<<<<<<< HEAD
<?php
set_error_handler('exceptions_error_handler');
header('Content-Type: application/json');
ini_set('display_errors', 1);
require "libs/insert.class.php";
require "libs/readall.class.php";
require "libs/remove.class.php";
require "libs/read.class.php";

$url = $_SERVER['REQUEST_URI'];
$args = explode("/", $url);
$argsLength = sizeof($args);

///// CLASSES /////
$insertPlayer = new InsertPlayer();
$removePlayer = new RemovePlayer();
$readAll = new ReadAll();
$readSingle = new Read();
//////////////////

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}

try{
if(!file_exists("data/config.json")){

$key = md5(microtime().rand());

  $json[] = array(

    "id" => $key);

  $fp = fopen("data/config.json", 'w');
  fwrite($fp, json_encode($json));
  fclose($fp);

  die("Your generated ID is $key. Refresh the page to get the API work.");

}
$getJson = file_get_contents("data/config.json");
$data = json_decode($getJson, true);


$realID = $data[0]["id"];
$action = $args[1];

 switch($action){

   case 'insert':

   $player = $args[2];
   $date = $args[3];
   $reason = $args[4];
   $ID = $args[5];

   $insertPlayer->insert($player, $reason, $date, $ID, $realID);

  break;

  case 'remove':

  $player = $args[2];
  $ID = $args[3];

  $removePlayer->remove($player, $ID, $realID);

    break;

  case 'readall':

  $ID = $args[2];

  $readAll->read($ID, $realID);

  break;

  case 'read':

  $player = $args[2];
  $ID = $args[3];

  $readSingle->readPlayer($player, $ID, $realID);

  break;

  default:

  $message[] = array( "error" => "Invalid request: no action specified");
    die(json_encode($message));

  break;

  }
}catch (Exception $e){

  $errors[] = array(

    "error" => $e->getMessage()

  );

  echo json_encode($errors, JSON_UNESCAPED_SLASHES);

}
?>
=======
<?php
set_error_handler('exceptions_error_handler');
header('Content-Type: application/json');
ini_set('display_errors', 1);
require "libs/insert.class.php";
require "libs/readall.class.php";
require "libs/remove.class.php";

$url = $_SERVER['REQUEST_URI'];
$args = explode("/", $url);
$argsLength = sizeof($args);

///// CLASSES /////
$insertPlayer = new InsertPlayer();
$removePlayer = new RemovePlayer();
$readAll = new ReadAll();
//////////////////

function exceptions_error_handler($severity, $message, $filename, $lineno) {
  if (error_reporting() == 0) {
    return;
  }
  if (error_reporting() & $severity) {
    throw new ErrorException($message, 0, $severity, $filename, $lineno);
  }
}

try{
if(!file_exists("data/config.json")){

$key = md5(microtime().rand());

  $json[] = array(

    "id" => $key);

  $fp = fopen("data/config.json", 'w');
  fwrite($fp, json_encode($json));
  fclose($fp);

  die("Your generated ID is $key. Refresh the page to get the API work.");

}
$getJson = file_get_contents("data/config.json");
$data = json_decode($getJson, true);


$realID = $data[0]["id"];
$action = $args[1];

 switch($action){

   case 'insert':

   $player = $args[2];
   $date = $args[3];
   $reason = $args[4];
   $ID = $args[5];

   $insertPlayer->insert($player, $reason, $date, $ID, $realID);

  break;

  case 'remove':

  $player = $args[2];
  $ID = $args[3];

  $removePlayer->remove($player, $ID, $realID);

    break;

  case 'readall':

  $ID = $args[2];

  $readAll->read($ID, $realID);

  break;

  default:

  $message[] = array( "error" => "Invalid request: no action specified");
    die(json_encode($message));

  break;

  }
}catch (Exception $e){

  $errors[] = array(

    "error" => $e->getMessage()

  );

  echo json_encode($errors);

}
?>
>>>>>>> 544b710d4deb82e329430be54366bbcbe1152bde
