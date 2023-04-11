<?php
    session_start();
    // FORM으로 받은 값 변수
    $userID = $_SESSION['md_id']; // 세션에서 현재 사용자 아이디를 받아 옴
    $car_number = $_POST['car_number']; // 차량번호
    $driven_distance = $_POST['driven_distance']; // 주행거리
    $car_type = $_POST['car_type']; // 유종
    $date_of_last_service = $_POST['date_of_last_service']; // 마지막 정비일
    $last_kilometer = $_POST['last_kilometer']; // 마지막 정비일 당시 km
    // 마지막 정비일로 부터 + 10개월
    $maintenance_date = date('y-m-d', strtotime('+10 Months')); // 

    // 예외 잡아내기
    if(empty($userID) || empty($car_number) || empty($driven_distance) || 
    $car_type == "select" || empty($date_of_last_service) || empty($last_kilometer)) {
        echo "다시 입력하세요";
        echo("<script>alert('공백이나 빈 칸이 있습니다.');
        location.href = 'car_manage.php';</script>");
    }

    // db 접속 관련 변수
    $dbAddress = "172.21.2.130";
    $dbUserID = "hyun";
    $dbUserPW = "123";
    $dbName = "caruser_info";
    $db = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName);

    // user_car에 입력
    $db_inputUserCar = "INSERT INTO user_car(user_id, car_number)
    VALUES ('$userID', '$car_number')";
    $db_UserCarQuery = mysqli_query($db, $db_inputUserCar);
    
    // mysqli_query 함수는 실패 시 false를 리턴,
    if($db_UserCarQuery === false) {
    echo mysqli_error($db);
    }
    
    // user_car_data에 입력
    $db_inputUserCarData = "INSERT INTO user_car_data
        (car_number, driven_distance, registration_date, car_type, date_of_last_service, last_kilometer, maintenance_date)
    VALUE ('$car_number', '$driven_distance', NOW(), '$car_type', '$date_of_last_service', '$last_kilometer', '$maintenance_date')";
    $db_UserCarDataQuery = mysqli_query($db, $db_inputUserCarData);

    // 상기한 에러 처리 if문과 동일
    if($db_UserCarDataQuery === false) {
        echo mysqli_error($db);
    }
?>
<script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
alert("차량 등록이 정상적으로 완료되었습니다.");
location.href = "../index.php";
</script>