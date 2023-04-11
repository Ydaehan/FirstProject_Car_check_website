<?php
include ('../db/db.php');
session_start();
?>

<?php
    $id = $_SESSION['md_id'];
    $idSearch = "SELECT * FROM user_car WHERE user_id = '$id';";
    $idSearchQuery = mysqli_query($db, $idSearch);
    while($idRow = mysqli_fetch_array($idSearchQuery)) {
        echo $idRow['car_number'];
        $search = "SELECT * FROM user_car_data WHERE car_number = '$idRow[car_number]';";
        $searchQuery = mysqli_query($db, $search);
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
            "<br>마지막 점검 시 주행거리 : ".$lastKilometer."<br>";
        }
    }

?>