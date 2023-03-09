<?php
/* 세션 시작 */
session_start();
$user_id = $_SESSION["md_id"];

/* 이전 페이지에서 값 가져오기 */
$pw = $_POST["pw"];
$nickname = $_POST["nickname"];

// 값 확인
echo "비밀번호 : ".$pw."<br>";
echo "닉네임 : ".$nickname."<br>";

/* DB 접속 */
include "db.php";

/* 쿼리 작성 */
if(!$pw){
  $sql = "update manage_user set nickname = '$nickname' where user_id = $user_id;";
}else {
  $sql = "update manage_user set pw = '$pw' where user_id = $user_id;";
}
echo $sql;

/* 데이터베이스에 쿼리 전송 */
mysqli_query($db,$sql);

/* DB(연결) 종료 */
mysqli_close($db);

/* 리디렉션 */
echo "
  <script type=\"text/javascript\">
    alert(\"정보가 수정되었습니다.\");
    location.href = \"edit.php\";
  </script>
";
?>