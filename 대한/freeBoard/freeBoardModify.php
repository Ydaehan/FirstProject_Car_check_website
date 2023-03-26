<!-- 게시글 수정 페이지 -->
<?php
  include "../db/db.php";
  session_start();

  $board_id = $_GET['board_id'];
  $select_sql = makeQuery("select * from free_board where id = '$board_id';");
  $board = getArray($select_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>자유게시판</title>
</head>
<body>
    <div id="board_write">
      <h1>글을 수정합니다.</h1>
      <form action="../db/modify_ok.php?board_id=<?php echo $board_id;?>" method="post">
        <div id="in_title">
          <textarea name="title" id="utitle" cols="55" rows="1" placeholder="제목" maxlength="100" required><?php echo $board['title']; ?></textarea>
        </div>

        <div class="wi_line">
        <div id="in_content">
          <!-- 주의 ! <textarea>여기 공간을 띄우거나 /br처리를 하면 내용또한 그만큼 띄워져서 나옴</textarea> -->
          <textarea name="content" id="ucontent" placeholder="내용" required><?php echo $board['contents']; ?></textarea>
        </div>
        <div class="hi_back">
          <button type="button" onclick="history.back()">돌아가기</button>
        </div>  
        <div class="bt_se">
          <button type="submit">글 작성</button>
        </div>
      
      </form>
    </div>  
</body>
</html>