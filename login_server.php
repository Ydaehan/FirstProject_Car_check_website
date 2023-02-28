<?php
session_start();

include('index.php');
include('db.php');
$_POST;

$id = $_POST["user_id"];
$pw = $_POST["user_pw"];


if(isset($_POST['user_id']) && isset($_POST['user_pw']) )
{
  //에러 체크
  if(empty($id))
  {
    header("location: index.php?error=아이디가 비어있어요");
    exit();
  }

  else if(empty($pw))
  {
    header("location: index.php?error=비밀번호가 비어있어요");
    exit();
  }


  else{
    $sql = "select * from member where md_id = '$id'";
    $result = mysqli_query($db, $sql);

    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      $hash = $row['md_pw'];

      if($pw == $hash){
        $_SESSION['md_id'] = $row['md_id'];
        $_SESSION['md_num'] = $row['md_num'];
        $_SESSION['no'] = $row['no'];
        header("location: index.php?=로그인성공");
        exit();
      }
      else{
        header("location: index.php?error=로그인에 실패 했습니다");
        exit();
      }
    }
    else{
      header("location: index.php?error=아이디가 잘못됬습니다");
      exit();
    }
  }
}

else{
  header("location: index.php?error=알수없는 오류입니다");
  exit();
}





?>
