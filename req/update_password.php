<?php

if (!isset($_SESSION)){
    session_start();
}
include "../db_conn.php";
if (!function_exists("rememberme")){
    include "../rememberme.php";
    rememberme($conn);
}
    include "function.php";
    
    if (isset($_SESSION['username']) && isset($_SESSION['email'])){

        //to check csrf token
        if (isset($_POST['csrf_token'])){
            if ($_SESSION['csrf_token'] != $_POST['csrf_token']){
                $em = "an error accouried";
                header("location: ../edit_profile.php?perror=$em");
                exit;
            }
        }else{
            $em = "an error accouried";
            header("location: ../edit_profile.php?perror=$em");
            exit;
        }

        if(isset($_POST['update_password'])){
            if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password']) ){

               $current_password =  $_POST['current_password'];
               $new_password =  $_POST['new_password'];
               $confirm_password =  $_POST['confirm_password'];

               if (empty($current_password) || empty($new_password) || empty($confirm_password)){
                $er = "There is an empty input";
                header("location: ../edit_profile.php?perror=$er#update_passowrd");
                exit;
               }else{
                    $user = getuserbyusername($_SESSION['username'] , $conn);
                    if($user == 0){
                        header("location: ../logout.php");
                          exit;
                    }else{
                        if(password_verify($current_password , $user['password'])){
                            if ($confirm_password != $new_password){
                                $er = "password and confirm password are not the same&";
                                  header("location: ../edit_profile.php?perror=$er#update_passowrd");
                                exit;
                            }else{
                                $new_password_hash = password_hash($new_password , PASSWORD_DEFAULT);

                                    $sql2 = "UPDATE users SET password = ? WHERE id=? ";
                                    $stmt2 = $conn->prepare($sql2);
                                   $result = $stmt2->execute([ $new_password_hash ,$_SESSION['id']]);
                                if ($result){
                                $sm = "successfully update password";
                                header("location: ../edit_profile.php?psuccess=$sm#update_passowrd");
                                exit;
                                }else{
                                    $er = "an error accouried";
                                header("location: ../edit_profile.php?perror=$er#update_passowrd");
                                exit;
                                }


                            }
                            

                        }else{
                            $er ="current password is wrong";
                            header("location: ../edit_profile.php?perror=$er#update_passowrd");
                            exit;
                        }
                    }



               }




               

            }else{
                $er = "an error accouried";
                header("location: ../edit_profile.php?perror=$er#update_passowrd");
                exit;
            }





        }









    }else{
        header("location: ../login.php");
        exit;
    }