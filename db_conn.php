<?php

        $h = "localhost";
        $u = "root";
        $p = "";
        $dbname= "test_login";

        try{
            $conn = new PDO("mysql:host=$h; dbname=$dbname" , $u ,$p);
                $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e ){
            echo "faided connection : " . $e ->getMessage();
        }