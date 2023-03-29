<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
$login_status = isset($_SESSION['md_id'])?true:false;
if($login_status){
  echo "<script>location.href='../freeBoard/freeBoardWrite.php';</script>";
}else{
  echo "<script>alert('로그인 후 이용해 주십시오');
    location.href='../index.php';</script>";
}
?>