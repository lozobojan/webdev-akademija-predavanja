<?php 

    require './db_connect.php';
    require './auth_functions.php';
    
    checkAuth();

    // brisem vezanu sliku
    $sql_photo = "SELECT profile_photo FROM users WHERE id = ".$_GET['id'];
    $res_photo = mysqli_query($dbconn, $sql_photo);
    $profile_photo = mysqli_fetch_assoc($res_photo)['profile_photo'];

    if(!is_null($profile_photo) && $profile_photo != "default.png" ){
        unlink($profile_photo);
    }

    $delete_user_sql = "DELETE FROM users WHERE id = ".$_GET['id'];
    $res_delete = mysqli_query($dbconn, $delete_user_sql);

    if($res_delete){
        // redirect to index with message
        header("location:index.php?user_deleted=1");
    }else{
        header("location:index.php?user_deleted=0");
    }

    

?>