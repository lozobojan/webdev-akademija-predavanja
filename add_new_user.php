<?php 

    // superglobals
    // $_REQUEST, $_POST, $_GET, $_SERVER, $_SESSION

    include './file_functions.php';

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $new_user = [ "first_name" => $first_name, "last_name" => $last_name, "email" => $email ];

        $users = getUsersFromFile(); // fetch from "DB"
        array_push($users, $new_user);
        writeToFile(json_encode($users));  // save to "DB"

        // redirect to index
        header("location:index.php");
    }

    

?>