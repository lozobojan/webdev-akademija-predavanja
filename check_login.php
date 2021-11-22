<?php 

    require './db_connect.php';
    session_start();
    

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_user = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password') ";
        $res_user = mysqli_query($dbconn, $sql_user);

        if(mysqli_num_rows($res_user) > 0){
            $_SESSION['login'] = true;
            $_SESSION['user'] = mysqli_fetch_assoc($res_user);
            header("location:index.php?logged_in=1");
        }else{
            header("location:login.php?wrong_credentials=1");
        }
    }

?>