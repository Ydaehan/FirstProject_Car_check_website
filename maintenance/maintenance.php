<?php
  include '../db/db.php';
  session_start();
  $id = isset($_SESSION['md_id'])?$_SESSION['md_id']:"";
  if($id == ""){
    echo '<script>
    alert("로그인 후 이용 가능합니다.");
    location.href = "../index.php";
    </script>';
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../CSS/grid.css">
  <link rel="stylesheet" type="text/css" href="../CSS/text.css">
  <script src="../JS/selectedValue.js"></script>
  <title>Document</title>
</head>
<body>
  <div class="container">
    <!-- 타이틀 -->
    <div id="title">
      <h1><a href="../index.php">Title</a></h1>
    </div>

    <!-- 상단 메뉴 -->
    <div id="menu">
      <ul id="list">
        <li><a href="../MyCar/MyCar.php">나의 차량</a></li>
        <li><a href="./maintenance.php">점검 목록</a></li>
        <li><a href="../freeBoard/freeBoardIndex.php">자유게시판</a></li>
        <li><a href="4.html">menu4</a></li>
        <li><a href="5.html">menu5</a></li>
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
      <?php
        //26조0666
        // 현재 로그인 되어 있는 유저의 차 번호를 
        // 배열로 받아서 선택 할 수 있게 한 후
        // 밑에 메뉴들 다 접어두고
        // 차 번호가 선택 되면 밑의 메뉴들이 펼쳐지게
        $result = makeQuery("SELECT * FROM user_car WHERE user_id = '$id'");
      ?>

      <?php
        if(isset($_GET['value'])){
          $selectedCarNum = $_GET['value'];
        }else {
          $selectedCarNum = null; // default
        }
      ?>
      <!-- 차량 선택 --> 
      <select name="carNum" id="selectCarNum" onchange="getValue(this.value)">
        <option value="">--선택하세요--</option>
      <?php while ($array = getArray($result)){ ?>
      <option value="<?php echo $array['car_number']?>">
      <?php
        echo $array['car_number'];
      ?>
      </option>
      <?php } ?>
      </select>
      
      <?php
      if($selectedCarNum !== null){
        $sql = "SELECT driven_distance FROM user_car_data WHERE car_number = '$selectedCarNum'"; 
        $result = mysqli_query($db,$sql);
        $array = mysqli_fetch_array($result);

        
        $db_distance = isset($array['driven_distance'])?$array['driven_distance']:0;
      }
        mysqli_close($db);
      ?>
      <script>
        //다음 정비까지 남은 km를 구하는 함수
        function maintenance_mileage(driving_distance,cycle) {
        remaining_distance = driving_distance - cycle
        return remaining_distance;
        } 
        <?php
          echo "var db_distance = '$db_distance';";
        ?>
        var driving_distance1     = db_distance; //현재까지 주행 거리 @@주의@@(db로 받아야함)
        var cycleAirConFilter     = 5000;        //에어컨 필터
        var cycleEnginOil         = 15000;       //엔진오일 및 오일필터
        var cycleWiperBlade       = 8000;        //와이퍼 블레이드
        var cycleBlakeOil         = 45000;       //블레이크 오일
        var cycleAirCleanerFilter = 40000;       //에어클리너 필터
        var cycleEngineAntifreeze = 40000;       //엔진부동액
        var cycleDriveBelt        = 60000;       //구동벨트
        var cycleBattery          = 60000;       //배터리
        var cycleTire             = 60000;       //타이어
        var cyclePowerSteeringOil = 80000;       //파워스티어링 오일
        var cycleMissionOil       = 50000;       //미션 오일
        var cycleBrakePadsDiscs   = 40000;       //브레이크 패드, 디스크
        var cycleFuelFilter       = 30000;       //연료 필터     
        var cycleSparkPlug        = 40000;       //점화플러그
        var cycleTimingBelt       = 70000;       //타이밍 벨트
        var cycleTireLocation     = 10000;       //타이어 위치
      </script>

      <!-- 정비 주기를 알려주는 함수 -->
      <script>
        function checkMaintenanceCycle(argParts ,argDriving_distance1 ){
          if (maintenance_mileage(argParts, argDriving_distance1) < 0) {
            document.write("이미 정비할 주행 거리가 지나셨어요 빠른시일에 정비하러 가보세요!");
          } else if(maintenance_mileage(argParts, argDriving_distance1) < 200){
            document.write(maintenance_mileage(argParts, argDriving_distance1) + "km 남았어요. 정비예약을 하실려면 ~~~~");
          } else {
            document.write(maintenance_mileage(argParts, argDriving_distance1) + "km 남음");
          }
        }
      </script>

      <p>안녕하세요 정비 주기를 알려드릴게요ㅎㅎ</p>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleAirConFilter,driving_distance1);
        </script>
        <a href="Detail/aircon.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/900/900094.png"/></a>
        <p class="p">에어컨 필터</p>
      </div>
    
      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleEnginOil,driving_distance1);
        </script>
        <a href="Detail/enginOil.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/4633/4633013.png"/></a>
        <p>엔진오일 및 오일필터</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleWiperBlade,driving_distance1);
        </script>
        <a href="Detail/wiper.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/5999/5999420.png"/></a>
        <p>와이퍼 블레이드</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleBlakeOil,driving_distance1);
        </script>
        <a href="Detail/blakeOil.php">
        <img class = "imgIcon" src = "https://us.123rf.com/450wm/leshkasmok/leshkasmok1503/leshkasmok150300126/37976958-%EB%B8%8C%EB%A0%88%EC%9D%B4%ED%81%AC-%EC%95%A1%EC%97%90-%EB%AC%B8%EC%A0%9C%EA%B0%80-%EC%9E%88%EC%8A%B5%EB%8B%88%EB%8B%A4-%ED%9D%B0%EC%83%89-%EB%B0%B0%EA%B2%BD%EC%97%90-%EB%8B%A8%EC%9D%BC-%ED%8F%89%EB%A9%B4-%EC%95%84%EC%9D%B4%EC%BD%98.jpg?ver=6"/></a>
        <p>블레이크 오일</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleAirCleanerFilter,driving_distance1);
        </script>
        <a href="Detail/airCleaner.php">
        <img class = "imgIcon" src = "https://w7.pngwing.com/pngs/105/725/png-transparent-filter-heroicons-ui-icon.png"/></a>
        <p>에어클리너 필터</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleEngineAntifreeze,driving_distance1);
        </script>
        <a href="Detail/enginAntifreeze.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/95/95134.png?w=360"/></a>
        <p>엔진부동액</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleDriveBelt,driving_distance1);
        </script>
        <a href="Detail/DriveBelt.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/1894/1894556.png"/></a>
        <p>구동벨트</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleBattery,driving_distance1);
        </script>
        <a href="Detail/Battery.php">
        <img class = "imgIcon" src = "https://png.pngtree.com/png-vector/20190307/ourmid/pngtree-vector-full-battery-icon-png-image_762950.jpg"/></a>
        <p>배터리</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleTire,driving_distance1);
        </script>
        <a href="Detail/Tire.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/1078/1078598.png"/></a>
        <p>타이어</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cyclePowerSteeringOil,driving_distance1);
        </script>
        <a href="Detail/PowerSteeringOil.php">
        <img class = "imgIcon" src = "https://w7.pngwing.com/pngs/131/318/png-transparent-car-steering-wheel-computer-icons-steering-wheel-driving-logo-car.png"/></a>
        <p>파워스티어링 오일</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleMissionOil,driving_distance1);
        </script>
        <a href="Detail/MissionOil.php">
        <img class = "imgIcon" src = "https://mblogthumb-phinf.pstatic.net/MjAxOTA4MDdfMjQ5/MDAxNTY1MTU4OTY0MTU2.zdewr99-eiUh6n2oRrb0RNhEJEM1dop3Cgiaz2eRL70g.I4spz9knj5lAVVV4nKPaE6aYNfazqf6LJcIdVWlcQdUg.PNG.sungbin126/rftertgrfgtrfh.png?type=w800"/></a>
        <p>미션오일</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleBrakePadsDiscs,driving_distance1);
        </script>
        <a href="Detail/BrakePadsDiscs.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/938/938708.png"/></a>
        <p>브레이크 패드,디스크</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleFuelFilter,driving_distance1);
        </script>
        <a href="Detail/FuelFilter.php">
        <img class = "imgIcon" src = "https://media.istockphoto.com/id/1271577057/ko/%EB%B2%A1%ED%84%B0/%EC%97%B0%EB%A3%8C-%ED%95%84%ED%84%B0-%EA%B5%90%EC%B2%B4-%EA%B8%80%EB%A6%AC%ED%94%84-%EC%95%84%EC%9D%B4%EC%BD%98-%EB%B2%A1%ED%84%B0-%EA%B2%A9%EB%A6%AC-%EC%9D%BC%EB%9F%AC%EC%8A%A4%ED%8A%B8%EB%A0%88%EC%9D%B4%EC%85%98.jpg?s=612x612&w=0&k=20&c=OMfgF5IoOZRUcJEZ-_vQlxATFfX_f1Ui6pQeMyu3Spo="/></a>
        <p>연료필터</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleSparkPlug,driving_distance1);
        </script>
        <a href="Detail/SparkPlug.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/3593/3593524.png"/></a>
        <p>점화 플러그</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleTimingBelt,driving_distance1);
        </script>
        <a href="Detail/TimingBelt.php">
        <img class = "imgIcon" src = "https://cdn-icons-png.flaticon.com/512/3903/3903012.png"/></a>
        <p>타이밍 벨트</p>
      </div>

      <div class="menuBorder">
        <script>
          checkMaintenanceCycle(cycleTireLocation,driving_distance1);
        </script>
        <a href="Detail/TireLocation.php">
        <img class = "imgIcon" src = "https://d3jn14jkdoqvmm.cloudfront.net/wp/wp-content/uploads/2022/11/14161013/icon-tire-%E1%84%90%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%A5.png"/></a>
        <p>타이어 위치</p>
      </div>
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
            <?php
            if($admin == "admin"){?>
              <a href="manage_user.php">회원 정보 관리</a>
            <?php
            } ?>
          <?php
          } else {?>
            <!-- 로그인 창 -->
              <label>아이디</label>
              <input type="text" placeholder="아이디..." name="user_id">

              <label>비밀번호</label>
              <input type="password" placeholder="비밀번호..." name="user_pw">

              <button type="submit" name="login_btn">로그인</button>
              <a href="join.php" class="save">아직 회원이 아니신가요? -> 회원가입 하러가기</a>
            <!-- 로그인 창 -->
          <?php
          } ?>
    </div>
  </div>
</body>
<footer>
    <p>2023.02.27</p>
</footer>
</html>
 
