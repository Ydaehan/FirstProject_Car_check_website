<?php
    include('db.php');
    session_start();

    $car_number = $_POST['car_number'];
    $driven_distance = $_POST['driven_distance'];
    $car_type = $_POST['car_type'];
    $date_of_last_service = $_POST['date_of_last_service'];
    $last_kilometer = $_POST['last_kilometer'];
    $maintenance_date = $_POST['maintenance_date'];

    $db_inputCar = "INSERT INTO user_car_data"

    $db_carQuery = mysqli_query();

?>