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
                header("location: ../edit_profile.php?error=$em");
                exit;
            }
        }else{
            $em = "an error accouried";
            header("location: ../edit_profile.php?error=$em");
            exit;
        }
        

        // to update account data
        if (isset($_POST['update_profile'])){

           $isset = isset_function("edit_profile","fname" , "lname" , "email" , "username", "phone" ,   "gender" , "birthdate" );
            if ($isset == 1){
                $fname = validateinput($_POST['fname']);
                $lname = validateinput($_POST['lname']);
                $username = validateinput($_POST['username']);
                $phone = validateinput($_POST['phone']);
                $gender = validateinput($_POST['gender']);
                $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
                $birthdate = date("Y-m-d" , strtotime($_POST['birthdate']));
                


                    is_empty_input($fname , "firstname" , "register" );
                    is_empty_input($lname , "lastname" , "register" );
                    is_empty_input($username , "username" , "register" );
                    is_empty_input($email , "email" , "register" );
                    is_empty_input($phone , "phone" , "register" );
                    is_empty_input($gender , "gender" , "register" );
                    is_empty_input($birthdate , "birth date" , "register" );

                    
                    if(!usernameisunique($username , $conn , $_SESSION['id'] )){
                        header("location: ../edit_profile.php?error=username is taken");
                        exit;
                    }
                    if(!emailisunique($email , $conn , $_SESSION['id'])){
                        header("location: ../edit_profile.php?error=email is taken");
                        exit;
                    }

                    

                            $sql = "UPDATE users SET fname = ? , lname = ? , username = ?, email = ?  , phone = ? , gender=? , birthdate =? WHERE id = ?";
                            $stmt = $conn->prepare($sql);
                          $r =  $stmt ->execute([$fname , $lname , $username , $email  , $phone , $gender , $birthdate , $_SESSION['id'] ]);

                          if ($r){
                            $_SESSION['username']= $username;
                            $_SESSION['email'] = $email;
                            header("location: ../edit_profile.php?success=successfully UPDATE profile");
                            exit;
                          }else{
                            $er = "an error accouried";
                            header("location: ../edit_profile.php?error=$er");
                            exit;
                          }
                            
                        
            }else{
                $em = "an error accouried";
                header("location: ../edit_profile.php?error=$em");
                exit;
            }
                    // update user photo profile
            } else if(isset($_FILES['image'])){          
                $image = uploadimage('image' , $conn , $_SESSION['id']);

                if ($image['status'] == 'error'){
                    $er = $image['er'];
                    header("location: ../edit_profile.php?error=$er");
                    exit;
                }else{
                    $image_name = $image['name'];
                    $sql2 = "UPDATE users SET image = ? WHERE id = ?";
                    $sql2 = $conn ->prepare($sql2);
                    $sql2->execute([$image_name , $_SESSION['id'] ]);

                    header("location: ../edit_profile.php?success=successfully update photo");
                    exit;

                }      
    }else{
        header("location: edit_profile.php");
        exit;
    }



}else{
    header("location: ../login.php");
    exit;
}