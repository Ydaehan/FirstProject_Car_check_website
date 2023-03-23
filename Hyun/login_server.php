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
    // db 에서 $id에 사용자로 부터 입력받은 id 와 일치하는 id를 검색
    $sql = "select * from manage_user where user_id = '$id'";
    $result = mysqli_query($db, $sql);

    // 검색 결과 일치하는 id 가 존재하는 경우 다음 절차
    if(mysqli_num_rows($result) === 1){
      $row = mysqli_fetch_assoc($result);
      $hash = $row['pw'];

      // 사용자 입력 pw 와 db에 저장된 pw 가 같을 때 로그인
      if($pw == $hash){
        $_SESSION['md_id'] = $row['user_id']; 
        $_SESSION['user_nickname'] = $row['nickname'];
        $_SESSION['admin'] = $row['admin'];
        // $_SESSION['no'] = $row['no'];
        header("location: index.php?=로그인성공");
        exit();
      }
      else{
        header("location: index.php?error=로그인에 실패 했습니다");
        exit();
      }
    }
    else{
      header("location: index.php?error=아이디가 잘못됐습니다");
      exit();
    }
  }
}

else{
  header("location: index.php?error=알수없는 오류입니다");
  exit();
}





?>