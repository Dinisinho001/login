<?php

    $servidor='localhost';
    $username='root';
    $password='';
    $bdname="MixMusic";
    $conn=new mysqli($servidor,$username,$password,$bdname);

    if($conn->connect_error){
        die('ERRO:'.$conn->connect_error);
    }
    $conn->set_charset("utf8mb4");

    ?>