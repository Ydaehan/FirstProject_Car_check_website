<?php
include ('./db/db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="kr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<div class="logo">
  <strong>자동차 정비 웹 프로젝트</strong>
</div>
<body style="overflow: hidden;">
<form action="./login/login_server.php" method="POST">
    <h2>로그인</h2>

    <button type = "button" id="home_btn"><a href="index.php">Home</a></button>

    <?php if(isset($_GET['error'])) { ?>
    <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php
      // $_SESSION['md_id'] ==> login_server.php 에서 세션에 저장 
      if(isset($_SESSION['md_id'])){ ?>   
        <a href="./manageUser/individual_manage.php?user_id=<?php echo $_SESSION['md_id']?>">회원 관리</a>
        <a class="text" href="../logout/logout.php">logout</a>
        <h1><?php echo $_SESSION['user_nickname']?>님 반갑습니다</h1>

        <!-- admin 일 시에 회원 정보 관리 버튼 활성화 -->
        <?php
          $admin = $_SESSION['admin'];
        ?>
        <?php if($admin == "admin"){?>
          <a href="./manageUser/manage_user.php">회원 정보 관리</a>
        <?php } ?>
      <?php } else {?>
        <!-- 비회원인 상태 < 로그인이 안된 상태 > -->
         <!-- 로그인 창 -->
          <label>아이디</label>
          <input type="text" placeholder="아이디..." name="user_id">

          <label>비밀번호</label>
          <input type="password" placeholder="비밀번호..." name="user_pw">

          <button type="submit" name="login_btn">로그인</button>
          <a href="./join/join.php" class="save">아직 회원이 아니신가요? -> 회원가입 하러가기</a>
        <!-- 로그인 창 -->
      <?php } ?>
      <br><a href="./freeBoard/freeBoardIndex.php" class="go_free_board">자유게시판</a>
</form>
    </div>  
  </div>
</body>
</html>

