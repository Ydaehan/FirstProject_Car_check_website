<?php
header("Content-Type: text/html; charset=UTF-8"); // alert 한글깨짐 해결법
session_start();
session_destroy();
?>

<script>
    alert("로그아웃 되었습니다.");
    location.href='./index.php';
</script>