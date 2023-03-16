<?php
include ('db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>CAR</title>
    <link rel="stylesheet" type="text/css" href="text.css">
    <link rel="stylesheet" type="text/css" href="grid.css">
    <script src="sideBar.js"></script>
    <script src="textHide.js"></script>
  </head>
  <body>
    <div class="container">
      <div id="title">
        <h1><a href="index.php">Title</a></h1>
      </div>
      <!-- 상단 메뉴 -->
      <div id="menu">
        <ul id="list">
          <li><a href="Car_manage.php">나의 차량</a></li>
          <li><a href="2.html">점검 목록</a></li>
          <li><a href="3.html">menu3</a></li>
          <li><a href="4.html">menu4</a></li>
          <li><a href="5.html">menu5</a></li>
        </ul>
      </div>
      <!-- 좌측 퀵메뉴 -->
      <ul id="sideBar">
        <li><a href="javascript:scroll('side1');">SIDE1</a></li>
        <li><a href="javascript:scroll('side2');">SIDE2</a></li>
        <li><a href="javascript:scroll('side3');">SIDE3</a></li>
        <li><a href="javascript:scroll('side4');">SIDE4</a></li>
        <li><a href="javascript:scroll('side5');">SIDE5</a></li>
      </ul>
      <!-- 중앙 페이지 본문 -->
      <div id="carDataForm">
        <h2>차량 등록</h2>
        <p>먼저, 차량을 등록해보세요.</p>
        <br>
        <form action="CarDataToDB.php" method="POST">
          <p>차량번호를 입력해주세요.</p>
          <input type="text" name="car_number" placeholder="차량번호">
          <br>
          <p>주행거리를 입력해주세요.</p>
          <input type="text" name="driven_distance" placeholder="주행거리">
          <br>
          <p>차량 유종을 선택하세요.</p>
          <select name="car_type" id="selectFuel">
            <option value="Gasoline">선택</option>
            <option value="Gasoline">휘발유</option>
            <option value="Diesel">경유</option>
            <option value="Electric">전기</option>
          </select>
          <br>
          <p>마지막 정비일을 입력해주세요.</p>
          <input type="date" name="date_of_last_service">
          <p>최근 정비일 당시, 누적 주행거리를 입력해주세요.</p>
          <input type="text" name="last_kilometer" placeholder="주행거리 (최근 정비 전)">
          <br>
          <input type="submit" value="차량 등록!">
      </form>
      </div>
      <!-- 로그인 메뉴 -->
      <div id="login">
        <form action="login_server.php" method="POST">
        <button type = "button" id="home_btn"><a href="index.php">Home</a></button>
        <?php if(isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php
        // $_SESSION['md_id'] ==> login_server.php 에서 세션에 저장 
        if(isset($_SESSION['md_id'])){ ?>   
          <a class="text" href="./logout.php">logout</a>
          <h1><?php echo $_SESSION['user_nickname']?>님 반갑습니다</h1>
          <!-- admin 일 시에 회원 정보 관리 버튼 활성화 -->
          <?php
            $admin = $_SESSION['admin'];
          ?>
          <?php if($admin == "admin"){?>
            <a href="manage_user.php">회원 정보 관리</a>
          <?php } ?>
          <?php } else {?>
          <!-- 로그인 창 -->
            <label>아이디</label>
            <input type="text" placeholder="아이디..." name="user_id">

            <label>비밀번호</label>
            <input type="password" placeholder="비밀번호..." name="user_pw">

            <button type="submit" name="login_btn">로그인</button>
            <a href="join.php" class="save">아직 회원이 아니신가요? -> 회원가입 하러가기</a>
          <!-- 로그인 창 -->
        <?php } ?>
      </div>
    </div>
    <footer>
      <p>2023.02.27</p>
    </footer>
  </body>
</html>

