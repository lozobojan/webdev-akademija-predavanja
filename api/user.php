<?php 

    require '../db_connect.php';    

    $user_id = $_GET['id'];
    $get_user_sql = "SELECT * FROM users WHERE id = $user_id";
    $res_user = mysqli_query($dbconn, $get_user_sql);
    $user = mysqli_fetch_assoc($res_user);

    if($user){
        echo json_encode(["status" => true, "data" => $user]);
    }else{
        echo json_encode(["status" => false, "data" => null]);
    }

?>