<?php 

    // superglobals
    // $_REQUEST, $_POST, $_GET, $_SERVER, $_SESSION

    include './db_connect.php';
    include './users_functions.php';
    require './auth_functions.php';
    require './functions.php';
    
    checkAuth();
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $country_id = isset($_POST['country_id']) && $_POST['country_id'] ? $_POST['country_id'] : "null";
        $city_id = isset($_POST['city_id']) && $_POST['city_id'] ? $_POST['city_id'] : "null";

        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
        if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0 ){

            $newFilePath = uploadFile($_FILES['profile_photo'], $allowed_types);
            if(!$newFilePath){
                header("location:index.php?user_saved=0&msg=wrong_file_format");
            }

        }else{
            $newFilePath = "null";
        }

        $insert_user_sql = "INSERT INTO users (first_name, last_name, email, `password`, city_id, country_id, profile_photo) 
                            VALUES ('$first_name', '$last_name', '$email', '$password', $city_id, $country_id, $newFilePath)";

        $saved = mysqli_query($dbconn, $insert_user_sql);

        if($saved){
            // redirect to index with message
            header("location:index.php?user_saved=1");
        }else{
            header("location:index.php?user_saved=0");
        }
        
    }

?>