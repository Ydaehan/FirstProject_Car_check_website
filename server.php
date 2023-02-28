<?php


include('join.php'); //main
include('db.php');
$_POST;

$id = $_POST["user_id"];
$pw = $_POST["user_pw"];
$pw2 = $_POST["user_pw2"];

if(isset($_POST['user_id']) && isset($_POST['user_pw']) && isset($_POST['user_pw2']))
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
  else if(empty($pw2))
  {
    header("location: join.php?error=비밀번호가 비어있어요");
    exit();
  }

  //아이디 중복 체크
  else
  {
    $sql_same = "SELECT * FROM member where md_id = '$id'";
    $order = mysqli_query($db, $sql_same);

    if(mysqli_num_rows($order) > 0){
      header("location: join.php?error=아이디가 이미 있어요");
      exit();
    }
    //중복이 없으면 DB에 저장
    else{
      $con = mysqli_connect("localhost", "root", "", "test");
  
      $sql = "insert into member(md_id, md_pw)";
      $sql .= "values('$id', '$pw')";
      
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
