<?php 

    include '../db_connect.php';

    $country_id = $_GET['country_id'];
    $cities_sql = "SELECT * FROM cities WHERE country_id = $country_id";
    $cities_res = mysqli_query($dbconn, $cities_sql);

    $cities = [];
    while($city = mysqli_fetch_assoc($cities_res)){
        $cities[] = $city;
    }

    echo json_encode($cities);

?>