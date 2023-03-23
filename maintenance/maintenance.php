
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<link rel="stylesheet" type="text/css" href="./maintenance.css">
<?php
include 'DB.php';

session_start();


//26조0666
$_SESSION['car_number'] = "63조3333";

$car_number = $_SESSION['car_number'];
$sql = "SELECT driven_distance FROM user_car_data WHERE car_number = '$car_number'" ; 
$result = mysqli_query($connect,$sql);


$array = mysqli_fetch_array($result);
$db_distance = $array['driven_distance'];


mysqli_close($connect);
echo "db확인" . $db_distance;
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
    var driving_distance1 = db_distance; //현재까지 주행 거리 @@주의@@(db로 받아야함)

    var cycleAirConFilter = 5000;         //에어컨 필터
    var cycleEnginOil = 15000;            //엔진오일 및 오일필터
    var cycleWiperBlade = 8000;           //와이퍼 블레이드
    var cycleBlakeOil = 45000;            //블레이크 오일
    var cycleAirCleanerFilter = 40000;    //에어클리너 필터
    var cycleEngineAntifreeze = 40000;    //엔진부동액
    var cycleDriveBelt = 60000;           //구동벨트
    var cycleBattery = 60000;             //배터리
    var cycleTire = 60000;                //타이어
    var cyclePowerSteeringOil = 80000;    //파워스티어링 오일
    var cycleMissionOil = 50000;          //미션 오일
    var cycleBrakePadsDiscs = 40000;      //브레이크 패드, 디스크
    var cycleFuelFilter = 30000;          //연료 필터     
    var cycleSparkPlug = 40000;           //점화플러그
    var cycleTimingBelt = 70000;          //타이밍 벨트
    var cycleTireLocation = 10000;        //타이어 위치
  </script>

  <!-- 정비 주기를 알려주는 함수 -->
  <script>
    function checkMaintenanceCycle(argParts ,argDriving_distance1 ){
      if (maintenance_mileage(argParts, argDriving_distance1) < 0) {
        document.write("이미 정비할 주행 거리가 지나셨어요 빠른시일에 정비하러 가보세요!");
      }else if(maintenance_mileage(argParts, argDriving_distance1) < 200){
        document.write(maintenance_mileage(argParts, argDriving_distance1) + "km 남았어요. 정비예약을 하실려면 ~~~~");
  } 
    else {
      document.write(maintenance_mileage(argParts, argDriving_distance1) + "km 남음");
  }
    }
  </script>


<body >

  <p>안녕하세요 정비 주기를 알려드릴게요ㅎㅎ</p>
  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleAirConFilter,driving_distance1);
</script>
  <a href="Detail/aircon.php"><img src = "https://cdn-icons-png.flaticon.com/512/900/900094.png"     class = "imgIcon" /></a>
  <p class="p">에어컨 필터</p>
  </div>
  
  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleEnginOil,driving_distance1);
</script>
  <a href="Detail/enginOil.php"><img src = "https://cdn-icons-png.flaticon.com/512/4633/4633013.png"     class = "imgIcon" /></a>
  <p>엔진오일 및 오일필터</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleWiperBlade,driving_distance1);
</script>
  <a href="Detail/wiper.php"><img src = "https://cdn-icons-png.flaticon.com/512/5999/5999420.png" class = "imgIcon" /></a>
  <p>와이퍼 블레이드</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleBlakeOil,driving_distance1);
</script>
  <a href="Detail/blakeOil.php"><img src = "https://us.123rf.com/450wm/leshkasmok/leshkasmok1503/leshkasmok150300126/37976958-%EB%B8%8C%EB%A0%88%EC%9D%B4%ED%81%AC-%EC%95%A1%EC%97%90-%EB%AC%B8%EC%A0%9C%EA%B0%80-%EC%9E%88%EC%8A%B5%EB%8B%88%EB%8B%A4-%ED%9D%B0%EC%83%89-%EB%B0%B0%EA%B2%BD%EC%97%90-%EB%8B%A8%EC%9D%BC-%ED%8F%89%EB%A9%B4-%EC%95%84%EC%9D%B4%EC%BD%98.jpg?ver=6" class = "imgIcon" /></a>
  <p>블레이크 오일</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleAirCleanerFilter,driving_distance1);
</script>
  <a href="Detail/airCleaner.php"><img src = "https://w7.pngwing.com/pngs/105/725/png-transparent-filter-heroicons-ui-icon.png"     class = "imgIcon" /></a>
  <p>에어클리너 필터</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleEngineAntifreeze,driving_distance1);
</script>
  <a href="Detail/enginAntifreeze.php"><img src = "https://cdn-icons-png.flaticon.com/512/95/95134.png?w=360"     class = "imgIcon" /></a>
  <p>엔진부동액</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleDriveBelt,driving_distance1);
</script>
  <a href="Detail/DriveBelt.php"><img src = "https://cdn-icons-png.flaticon.com/512/1894/1894556.png"     class = "imgIcon" /></a>
  <p>구동벨트</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleBattery,driving_distance1);
</script>
  <a href="Detail/Battery.php"><img src = "https://png.pngtree.com/png-vector/20190307/ourmid/pngtree-vector-full-battery-icon-png-image_762950.jpg"     class = "imgIcon" /></a>
  <p>배터리</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleTire,driving_distance1);
</script>
  <a href="Detail/Tire.php"><img src = "https://cdn-icons-png.flaticon.com/512/1078/1078598.png"     class = "imgIcon" /></a>
  <p>타이어</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cyclePowerSteeringOil,driving_distance1);
</script>
  <a href="Detail/PowerSteeringOil.php"><img src = "https://w7.pngwing.com/pngs/131/318/png-transparent-car-steering-wheel-computer-icons-steering-wheel-driving-logo-car.png"     class = "imgIcon"/></a>
  <p>파워스티어링 오일</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleMissionOil,driving_distance1);
</script>
  <a href="Detail/MissionOil.php"><img src = "https://mblogthumb-phinf.pstatic.net/MjAxOTA4MDdfMjQ5/MDAxNTY1MTU4OTY0MTU2.zdewr99-eiUh6n2oRrb0RNhEJEM1dop3Cgiaz2eRL70g.I4spz9knj5lAVVV4nKPaE6aYNfazqf6LJcIdVWlcQdUg.PNG.sungbin126/rftertgrfgtrfh.png?type=w800"     class = "imgIcon" /></a>
  <p>미션오일</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleBrakePadsDiscs,driving_distance1);
</script>
  <a href="Detail/BrakePadsDiscs.php"><img src = "https://cdn-icons-png.flaticon.com/512/938/938708.png"     class = "imgIcon" /></a>
  <p>브레이크 패드,디스크</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleFuelFilter,driving_distance1);
</script>
  <a href="Detail/FuelFilter.php"><img src = "https://media.istockphoto.com/id/1271577057/ko/%EB%B2%A1%ED%84%B0/%EC%97%B0%EB%A3%8C-%ED%95%84%ED%84%B0-%EA%B5%90%EC%B2%B4-%EA%B8%80%EB%A6%AC%ED%94%84-%EC%95%84%EC%9D%B4%EC%BD%98-%EB%B2%A1%ED%84%B0-%EA%B2%A9%EB%A6%AC-%EC%9D%BC%EB%9F%AC%EC%8A%A4%ED%8A%B8%EB%A0%88%EC%9D%B4%EC%85%98.jpg?s=612x612&w=0&k=20&c=OMfgF5IoOZRUcJEZ-_vQlxATFfX_f1Ui6pQeMyu3Spo="     class = "imgIcon" /></a>
  <p>연료필터</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleSparkPlug,driving_distance1);
</script>
  <a href="Detail/SparkPlug.php"><img src = "https://cdn-icons-png.flaticon.com/512/3593/3593524.png"     class = "imgIcon" /></a>
  <p>점화 플러그</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleTimingBelt,driving_distance1);
</script>
  <a href="Detail/TimingBelt.php"><img src = "https://cdn-icons-png.flaticon.com/512/3903/3903012.png"     class = "imgIcon" /></a>
  <p>타이밍 벨트</p>
  </div>

  <div class="menuBorder">
  <script>
  checkMaintenanceCycle(cycleTireLocation,driving_distance1);
</script>
  <a href="Detail/TireLocation.php"><img src = "https://d3jn14jkdoqvmm.cloudfront.net/wp/wp-content/uploads/2022/11/14161013/icon-tire-%E1%84%90%E1%85%A1%E1%84%8B%E1%85%B5%E1%84%8B%E1%85%A5.png"     class = "imgIcon" /></a>
  <p>타이어 위치</p>
  </div>
  

  

  <style>

</style>


</body>
</html>
 
