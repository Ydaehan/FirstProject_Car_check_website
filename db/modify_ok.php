<?php
  header("Content-Type:text/html;charset=utf-8");
  include "../db/db.php";
  $board_id = $_GET['board_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];

  $update_sql = makeQuery("update free_board set title='".$title."',contents='".$content."'where id='".$board_id."'");
  echo "<script type='text/javascript'>alert('수정되었습니다.');</script>";
?>

<meta http-equiv="refresh" content="0 url=../freeBoard/freeBoardView.php?id=<?php echo $board_id;?>">;
