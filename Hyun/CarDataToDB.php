<?php
    session_start();
    // FORM으로 받은 값 변수
    $userID = $_SESSION['md_id'];
    $car_number = $_POST['car_number'];
    $driven_distance = $_POST['driven_distance'];
    $car_type = $_POST['car_type'];
    $date_of_last_service = $_POST['date_of_last_service'];
    $last_kilometer = $_POST['last_kilometer'];
    echo $userID;
    echo $car_number;
    echo $driven_distance;
    echo $car_type;
    echo $date_of_last_service;
    echo $last_kilometer;
    // db 접속 관련 변수
    $dbAddress = "172.21.2.130";
    $dbUserID = "hyun";
    $dbUserPW = "123";
    $dbName = "caruser_info";
    $db = mysqli_connect($dbAddress, $dbUserID, $dbUserPW, $dbName);

    // user_car에 입력
    $db_inputUserCar = "INSERT INTO user_car
    (user_id, car_number)
    VALUES
    ('$userID', '$car_number')";
    $db_UserCarQuery = mysqli_query($db, $db_inputUserCar);
    if($db_UserCarQuery === false) {
        echo mysqli_error($db);
    }

    // user_car_data에 입력
    $db_inputUserCarData = "INSERT INTO user_car_data
        (car_number, driven_distance, registration_date, car_type, date_of_last_service, last_kilometer)
    VALUE ('$car_number', '$driven_distance', NOW(), '$car_type', '$date_of_last_service', '$last_kilometer + 7000')";
    $db_UserCarDataQuery = mysqli_query($db, $db_inputUserCarData);
    if($db_UserCarDataQuery === false) {
        echo mysqli_error($db);
    }
?>
<a href="index.php">이동</a>