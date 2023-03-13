<?php
/* 세션 시작 */
header("Content-Type:text/html;charset=utf-8"); 
session_start();
$edit_user = $_GET["user_id"];
if($_SESSION["md_id"] != $edit_user){
  $user_id = $edit_user;
  $same = FALSE;
}else{
  $user_id = $_SESSION["md_id"];
  $same = TRUE;
}


/* 이전 페이지에서 값 가져오기 */
$pw = $_POST["pw"];
$nickname = $_POST["nickname"];

// 값 확인
echo "비밀번호 : ".$pw."<br>";
echo "닉네임 : ".$nickname."<br>";

/* DB 접속 */
include "db.php";

/* 쿼리 작성 */
if(!$pw && $nickname){ // 닉네임이 공백이 아니고 pw 가 비워져 있을 때
  $sql = "update manage_user set nickname = '$nickname' where user_id = '$user_id';";
}else if(!$nickname && $pw){ // 닉네임이 비워져있고 pw 가 공백이 아닐 때
  $sql = "update manage_user set pw = '$pw' where user_id = '$user_id';";
}else if($pw && $nickname){
  // 닉네임 및 pw 가 둘 다 존재 혹은 둘 다 공백 일때의 조건 부여 필요
  $sql = "update manage_user set pw = '$pw', nickname = '$nickname' where user_id = '$user_id';";
}else {
  // 닉네임과 pw 가 둘 다 공백일때는 아무것도 안하고 정보수정 안되게 할수 없을까?
  echo "<script type=\"text/javascript\">
  alert(\"닉네임과 비밀번호가 비워져있습니다. 홈으로 돌아갑니다.\");
  location.href = \"index.php\";
  </script>";
}
echo $sql;


/* 데이터베이스에 쿼리 전송 */
mysqli_query($db,$sql);
$sql = "select nickname from manage_user where user_id = '$user_id'";
$result = mysqli_query($db, $sql);
$nickname = mysqli_fetch_array($result);

/* session에 값 변경 */
if($same){
  $_SESSION['user_nickname'] = $nickname["nickname"];
}

/* DB(연결) 종료 */
mysqli_close($db);

/* 리디렉션 */
echo "<script type=\"text/javascript\">
alert(\"정보가 수정되었습니다.\");
location.href = \"index.php\";
</script>";
?>