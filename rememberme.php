<?php

    function rememberme ($conn){
        if (isset($_COOKIE['token_user'])){
            $token = $_COOKIE['token_user'];

            $sql = "SELECT * FROM rememberme WHERE token =?";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$token]);
            if ($stmt->rowCount() == 1){
                $user_data = $stmt->fetch();
                if (!isset($_SESSION)){
                    session_start();
                }

                $_SESSION['username']  = $user_data['username'];
                $_SESSION['id'] = $user_data['user_id']; 
                $_SESSION['email'] = $user_data['email']; 

            }

        }

    }