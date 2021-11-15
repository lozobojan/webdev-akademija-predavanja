<?php 

    require './db_connect.php';
    require './auth_functions.php';
    
    checkAuth();

    $delete_user_sql = "DELETE FROM users WHERE id = ".$_GET['id'];
    $res_delete = mysqli_query($dbconn, $delete_user_sql);

    if($res_delete){
        // redirect to index with message
        header("location:index.php?user_deleted=1");
    }else{
        header("location:index.php?user_deleted=0");
    }

    

?>