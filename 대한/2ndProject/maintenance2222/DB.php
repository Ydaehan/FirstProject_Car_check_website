<?php
//db연결 정보

$dbAddress = "172.21.2.130";
$dbUserID = "test";
$dbUserPW = "123";
$dbName = "caruser_info";

//mysqli 객체 생성
$connect = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName) or die("fail");

//연결 확인
if($connect -> connect_error){
  die("Connection failed: " . $connect->connect_error);
}

?>