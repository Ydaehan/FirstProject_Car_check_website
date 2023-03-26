<?php
$dbAddress = "172.21.2.130";
$dbUserID = "test";
$dbUserPW = "123";
$dbName = "caruser_info";

$db = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName);

if(!function_exists('makeQuery')){
  function makeQuery($argQuery){
    global $db;
    $result = mysqli_query($db, $argQuery);
    return $result;
  }
}

if(!function_exists('getArray')){
  function getArray($argResult){
    global $db;
    $array = mysqli_fetch_array($argResult);
    return $array;
  }
}


if (!$db){
  echo "DB접속 실패";
}
?>