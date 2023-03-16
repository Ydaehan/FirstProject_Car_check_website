<?php
$dbAddress = "172.21.2.130";
$dbUserID = "hyun";
$dbUserPW = "123";
$dbName = "caruser_info";

$db = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName);
if(!$db){
  die(mysqli_connect_error());
}
?>