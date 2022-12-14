<?php

include "../db_conn.php";
include "function.php";
    if (isset($_POST['login'])){
        $isset = isset_function("login", "username" , "password");

        if ($isset == 1){
            $username = validateinput($_POST['username']);
            $password = $_POST['password'];

            $username_data = "username=$username";

            is_empty_input($username , "username" , "login" , "");
            is_empty_input($password , "password" , "login" , $username_data);

            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);
            if ($stmt->rowCount() == 1){
                $user = $stmt->fetch();
                
                if ($user['username'] == $username ){
                    if (password_verify($password , $user['password'])){
                        
                        if (!isset($_SESSION)){
                            session_start();
                        }

                        $_SESSION['username']  = $username;
                        $_SESSION['id'] = $user['id']; 
                        $_SESSION['email'] = $user['email']; 
                        
                        // to remember me
                        if (isset($_POST['remember'])){
                            if($_POST['remember'] == 1){
                                $token=  md5(bin2hex(random_bytes(40)));
                                setcookie("token_user" , $token , time()+1000 , '/');

                                $sql2 = "INSERT INTO rememberme (user_id  , username , token ,email) VALUES (? , ? ,?, ?) ";
                                $stmt2 = $conn->prepare($sql2);
                                $stmt2->execute([$user['id'] , $user['username'] , $token , $user['email']]);
                                
                                    $uniqid= uniqid();
                                    // to delete token from database after 2 days
                                    $sql3 = "CREATE EVENT delete_user_token_{$uniqid}_{$username} ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 2 DAY DO DELETE FROM `rememberme` WHERE `token` = ?";
                                    $stmt3 =$conn->prepare($sql3);
                                    $stmt3 ->execute([$token]);


                            }
                        }
                        
                        header("location: ../index.php");
                        exit;


                    }else{
                        $er = "password is wrong&$username_data";
                        header("location: ../login.php?error=$er");
                        exit;
                    }


                }else{
                $er = "username  is not found";
                header("location: ../login.php?error=$er");
                exit;
            }

            }else{
                $er = "username  is not found";
                header("location: ../login.php?error=$er");
                exit;
            }



        }else{
            $er = "an error accouried";
        header("location: ../login.php?error=$er");
        exit;
        }
        
    }else{
        $er = "an error accouried";
        header("location: ../login.php?error=$er");
        exit;
    }
