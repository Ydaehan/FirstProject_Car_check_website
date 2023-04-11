<?php
include ('./db/db.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>CAR</title>
    <link rel="stylesheet" type="text/css" href="./CSS/text.css">
    <link rel="stylesheet" type="text/css" href="./CSS/grid.css">
    <script src="./JS/sideBar.js"></script>
    <script src="./JS/textHide.js"></script>
  </head>
  <body>
    <div class="container">
      <div id="title">
        <h1><a href="index.php">Title</a></h1>
      </div>
      <!-- 상단 메뉴 -->
      <div id="menu">
        <ul id="list">
          <li><a href="MyCar/MyCar.php">나의 차량</a></li>
          <li><a href="./maintenance/maintenance.php">점검 목록</a></li>
          <li><a href="./freeBoard/freeBoardIndex.php">자유게시판</a></li>
          <li><a href="#">menu4</a></li>
          <li><a href="#">menu5</a></li>
        </ul>
      </div>
      <!-- 좌측 퀵메뉴 -->
      <ul id="sideBar">
        <li><a href="javascript:scroll('side1');">나의 차량</a></li>
        <li><a href="javascript:scroll('side2');">SIDE2</a></li>
        <li><a href="javascript:scroll('side3');">SIDE3</a></li>
        <li><a href="javascript:scroll('side4');">SIDE4</a></li>
        <li><a href="javascript:scroll('side5');">SIDE5</a></li>
      </ul>
      <!-- 중앙 페이지 본문 -->
      <div id="main">
        <h2>WELCOME!</h2>
        <p>...은 차량 관리 웹으로...</p>
        <br>
        <h3>나의 차량</h3>
        <input type="button" value="close" onclick="showHide(this,'side1')">
        <div id="side1">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("HELLO" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE2</h3>
        <input type="button" value="close" onclick="showHide(this,'side2')">
        <div id="side2">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("WORLD" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE3</h3>
        <input type="button" value="close" onclick="showHide(this,'side3')">
        <div id="side3">
          <script>
            for (let i = 0; i < 100; i++) {
              document.write("AGAIN" + "<br>");
            }
          </script>
        </div>
        <br>
        <h3>SIDE4</h3>
        <input type="button" value="close" onclick="showHide(this,'side4')">        
        <div id="side4">
            <script>
              for (let i = 0; i < 100; i++) {
                document.write("^_^" + "<br>");
              }
            </script>
        </div>
        <br>
        <h3>SIDE5</h3>
        <input type="button" value="close" onclick="showHide(this,'side5')">
        <div id="side5">
          <script>
                for (let i = 0; i < 100; i++) {
                  document.write("HAHA" + "<br>");
                }
          </script>
        </div> 
      </div>
      <!-- 로그인 메뉴 -->
      <div id="login">
        <form action="./login/login_server.php" method="POST">
          <!-- 이미 홈 화면 이므로 필요 없는 코드 -->
        <!-- <button type = "button" id="home_btn"><a href="index.php">Home</a></button> -->
        <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php
        // $_SESSION['md_id'] ==> login_server.php 에서 세션에 저장 
        if(isset($_SESSION['md_id'])){ ?>   
          <a class="text" href="./logout/logout.php">logout</a>
          <button id="UIMBtn" onclick="location.href='./manageUser/individual_manage.php=<?php echo $_SESSION['md_id']?>'">정보 수정</button>
          <h1><?php echo $_SESSION['user_nickname']?>님 반갑습니다</h1>
          <!-- admin 일 시에 회원 정보 관리 버튼 활성화 -->
          <?php
            $admin = $_SESSION['admin'];
          ?>
          <?php if($admin == "admin"){?>
            <a href="./manageUser/manage_user.php">회원 정보 관리</a>
          <?php } ?>
          <?php } else {?>
          <!-- 로그인 창 -->
            <label>아이디</label>
            <input type="text" placeholder="아이디..." name="user_id">

            <label>비밀번호</label>
            <input type="password" placeholder="비밀번호..." name="user_pw">

            <button type="submit" name="login_btn">로그인</button>
            <a href="./join/join.php" class="save">아직 회원이 아니신가요? -> 회원가입 하러가기</a>
          <!-- 로그인 창 -->
        <?php } ?>
      </div>
    </div>
    <footer>
      <p>2023.02.27</p>
    </footer>
  </body>
</html>
