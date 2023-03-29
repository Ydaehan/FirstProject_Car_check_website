<?php
  include "../db.php";
  session_start();
  header("Content-Type:text/html;charset=utf-8");
  $user_id = $_SESSION['md_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  if($user_id && $title && $content){
    $sql = makeQuery("insert into free_Board(user_id,title,contents) values('$user_id','$title','$content');");
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='../freeBoard/freeBoardIndex.php';</script>";
  }
  else{
    echo "<script>
    alert('글쓰기에 실패했습니다.');
    history.back();</script>";
  }
?>