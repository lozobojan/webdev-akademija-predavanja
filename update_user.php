<?php 

    include './db_connect.php';
    require './auth_functions.php';
    
    checkAuth();

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $update_user_sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', email = '$email' WHERE id = $id ";
        $res_update = mysqli_query($dbconn, $update_user_sql);
        
        $rows = mysqli_affected_rows($dbconn);

        // redirect to index with message
        header("location:index.php?user_updated=$rows");
    
    }

    

?>