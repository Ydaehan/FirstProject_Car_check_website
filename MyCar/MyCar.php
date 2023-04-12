<?php
include ('../db/db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>CAR</title>
<link rel="stylesheet" type="text/css" href="../CSS/text.css">
<link rel="stylesheet" type="text/css" href="../CSS/grid.css">
<script src="../JS/sideBar.js"></script>
<script src="../JS/textHide.js"></script>
</head>
<body>
<div class="container">
<div id="title">
  <h1><a href="../index.php">Title</a></h1>
</div>
<!-- 상단 메뉴 -->
<div id="menu">
  <ul id="list">
    <li><a href="MyCar.php">나의 차량</a></li>
    <li><a href="../maintenance/maintenance.php">점검 목록</a></li>
    <li><a href="../freeBoard/freeBoardIndex.php">자유게시판</a></li>
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
<div>
  <h2>나의 차량</h2>
  <h4><a href="InsertCar.php">차량 등록하러 가기</a></h4>
  <?php
    // 세션에 저장된 현재 아이디 값
    $id = isset($_SESSION['md_id'])?$_SESSION['md_id']:" ";
    if($id == " ") {
      echo
      '<script>
        alert("로그인 후 이용 가능합니다.");
        location.href = "../index.php";
      </script>';
    }
    // DB에 $id와 같은 아이디를 가진 데이터를 선택
    $idSearch = "SELECT * FROM user_car WHERE user_id = '$id';";
    $idSearchQuery = mysqli_query($db, $idSearch);
    // fetch_array는 호출될 때 마다 새로운 행을 가져옴
    $idRow = mysqli_fetch_array($idSearchQuery);
    // 첫 번째 행에서 idRow의 'user_id' 값을 변수에 저장
    $getFromDBID = $idRow['user_id'];
    // 호출될 때마다 새로운 행을 가져오기에 후에 모든 행을 출력하기 위해 0번째 데이터로 초기화 함
    mysqli_data_seek($idSearchQuery, 0);
    $search = "SELECT * FROM user_car_data WHERE car_number = '$idRow[car_number]';";
    // db에서 가져온 아이디 값과 현재 로그인 중인 회원의 id값이 같으면 출력
    if($getFromDBID == $id) {
      // mysqli_fetch_array는 값이 없어서 null을 반환할 때까지 차량 번호를 불러온다.
      while($idRow = mysqli_fetch_array($idSearchQuery)) {
        $searchQuery = mysqli_query($db, $search);
        // 불러온 차량 번호에 해당하는 정보를 변수에 넣고 출력한다.
        while($row = mysqli_fetch_array($searchQuery)) {
          $carNumber = $row['car_number'];
          $drivenDistance = $row['driven_distance'];
          $carType = $row['car_type'];
          $dateOfLastService = $row['date_of_last_service'];
          $lastKilometer = $row['last_kilometer'];
          echo "차량번호 :".$carNumber.
          "<br>누적주행거리 : ".$drivenDistance.
          "<br>유종 : ".$carType.
          "<br>마지막 점검일 : ".$dateOfLastService.
          "<br>마지막 점검 시 주행거리 : ".$lastKilometer."<br>".
          "<a href = './EditCar.php'><b>수정</b></a><br>";
        }
      }
    }
      
  ?>

</div>
<!-- 로그인 메뉴 -->
<div id="login">
  <form action="../login/login_server.php" method="POST">
  <button type = "button" id="home_btn"><a href="../index.php">Home</a></button>
  <?php if(isset($_GET['error'])) { ?>
  <p class="error"><?php echo $_GET['error']; ?></p>
  <?php } ?>

  <?php
  // $_SESSION['md_id'] ==> login_server.php 에서 세션에 저장 
  if(isset($_SESSION['md_id'])){ ?>   
    <a class="text" href="../logout/logout.php">logout</a>
    <h1><?php echo $_SESSION['user_nickname']?>님 반갑습니다</h1>
    <!-- admin 일 시에 회원 정보 관리 버튼 활성화 -->
    <?php
      $admin = $_SESSION['admin'];
    ?>
    <?php if($admin == "admin"){?>
      <a href="../manageUser/manage_user.php">회원 정보 관리</a>
    <?php } ?>
    <?php } else {?>
    <!-- 로그인 창 -->
      <label>아이디</label>
      <input type="text" placeholder="아이디..." name="user_id">

      <label>비밀번호</label>
      <input type="password" placeholder="비밀번호..." name="user_pw">

      <button type="submit" name="login_btn">로그인</button>
      <a href="../join/join.php" class="save">아직 회원이 아니신가요? -> 회원가입 하러가기</a>
    <!-- 로그인 창 -->
  <?php } ?>
</div>
</div>
<footer>
<p>2023.02.27</p>
</footer>
</body>
</html>

