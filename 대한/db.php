<?php
$dbAddress = "172.21.2.130";
$dbUserID = "test";
$dbUserPW = "123";
$dbName = "caruser_info";

$db = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName);
if(!$db){
  echo "DB접속 실패";
}

?>