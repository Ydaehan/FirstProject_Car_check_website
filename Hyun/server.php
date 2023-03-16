<?php
// 회원가입 시 확인하고 db 에 저장하는 코드

include('join.php'); //main
include('db.php');
$_POST;

$id = $_POST["user_id"];
$pw = $_POST["user_pw"];
$confirm_pw = $_POST["pw_confirm"]; // 원래 pw2
$nickname = $_POST["user_nickname"];

if(isset($_POST['user_id']) && isset($_POST['user_pw']) && isset($_POST['pw_confirm']) && isset($_POST['user_nickname']))
{
  //에러 체크
  if(empty($id))
  {
    header("location: join.php?error=아이디가 비어있어요"); //main
    exit();
  }
  else if(empty($pw))
  {
    header("location: join.php?error=비밀번호가 비어있어요");//main
    exit();
  }
  else if(empty($confirm_pw))
  {
    header("location: join.php?error=비밀번호가 비어있어요");
    exit();
  }
  else if($pw != $confirm_pw){
    header("location: join.php?error=비밀번호가 일치하지 않습니다");
    exit();
  }
  else if(empty($nickname))
  {
    header("location: join.php?error=닉네임이 비어있어요");
    exit();
  }

  //아이디 중복 체크
  else
  {
    $sql_same = "SELECT * FROM manage_user where user_id = '$id'";
    $sql_nick = "SELECT * FROM manage_user where nickname = '$nickname'";
    $order = mysqli_query($db, $sql_same);
    $nick_check = mysqli_query($db, $sql_nick);

    if(mysqli_num_rows($order) > 0){
      header("location: join.php?error=중복된 아이디 입니다");
      exit();
    }
    else if(mysqli_num_rows($nick_check) > 0){
      header("location: join.php?error=중복된 닉네임 입니다");
      exit();
    }


    //중복이 없으면 DB에 저장
    else{
      $con = mysqli_connect("172.21.4.117", "test", "123", "caruser_info");
  
      $sql = "insert into manage_user(user_id, pw, nickname)";
      $sql .= "values('$id', '$pw' , '$nickname')";
      
      $result = mysqli_query($con, $sql);
      mysqli_close($con);
      //저장 성공시,실패시 메세지 출력
      if($result){
        header("location: join.php?success=회원가입에 성공하셨습니다");
        exit();
      }
      else{
        header("location: join.php?error=회원가입에 실패하셨습니다");
        exit();
      }
      
    }
  }

  
  //데이터 베이스에 저장
  // $con = mysqli_connect("localhost", "root", "", "test");
  
  // $sql = "insert into member(md_id, md_pw)";
  // $sql .= "values('$id', '$pw')";
  
  // mysqli_query($con, $sql);
  // mysqli_close($con);

}

else{

}





?>