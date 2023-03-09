<?php 
session_start();
$user_id = $_SESSION["md_id"];

/* DB 접속 */
include "db.php";

/* 쿼리 작성 */
$sql = "delete from manage_user where user_id = $user_id";

/* 데이터 베이스에 쿼리 전송 */
mysqli_query($db,$sql);

/* 세션 삭제 */
unset($_SESSION["md_id"]);
unset($_SESSION["user_nickname"]);
unset($_SESSION["admin"]);

/* DB(연결) 종료 */
mysqli_close($db);

/* 리디렉션 */
echo "
  <script type=\"text/javascript\">
    alert(\"정상처리 되었습니다.\");
    location.href = \"index.php\";  
  </script> 
";
?>