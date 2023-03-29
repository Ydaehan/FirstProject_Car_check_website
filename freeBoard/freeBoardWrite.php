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
      <form action="../db/write_ok.php" method="post">
        <div id="in_title">
          <textarea name="title" id="utitle" cols="55" rows="1" placeholder="제목" maxlength="100" required></textarea>
        </div>

        <div class="wi_line">
        <div id="in_content">
          <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
        </div>
        
        <div class="bt_se">
          <button type="submit">글 작성</button>
        </div>
      </form>
    </div>  
</body>
</html>