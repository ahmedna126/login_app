<?php

    include "../db_conn.php";
    include "function.php";
        
        if (isset($_POST['register'])){

           $isset = isset_function("register","fname" , "lname" , "email" , "username", "phone" , "password", "confirm", "gender" , "birthdate" );
            if ($isset == 1){
                $fname = validateinput($_POST['fname']);
                $lname = validateinput($_POST['lname']);
                $username = validateinput($_POST['username']);
                $phone = validateinput($_POST['phone']);
                $password = $_POST['password'];
                $confirm = $_POST['confirm'];
                $gender = validateinput($_POST['gender']);
                $email = filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL);
                $birthdate = date("Y-m-d" , strtotime($_POST['birthdate']));
                

                $all_data = "fname=$fname&lname=$lname&username=$username&email=$email&phone=$phone&gender=$gender"; 

                    is_empty_input($fname , "firstname" , "register" , $all_data);
                    is_empty_input($lname , "lastname" , "register" , $all_data);
                    is_empty_input($username , "username" , "register" , $all_data);
                    is_empty_input($email , "email" , "register" , $all_data);
                    is_empty_input($password , "password" , "register" , $all_data);
                    is_empty_input($confirm , "confirm password" , "register" , $all_data);
                    is_empty_input($phone , "phone" , "register" , $all_data);
                    is_empty_input($gender , "gender" , "register" , $all_data);
                    is_empty_input($birthdate , "birth date" , "register" , $all_data);

                    if ($password != $confirm){
                        $er = "password and confirm password are not the same&$all_data";
                        header("location: ../register.php?error=$er");
                        exit;
                    }
                    if(!usernameisunique($username , $conn)){
                        $er = "username is taken";
                        header("location: ../register.php?error=$er");
                        exit;
                    }
                    if(!emailisunique($email , $conn)){
                        $er ="email is taken";
                        header("location: ../register.php?error=$er");
                        exit;
                    }

                    if(!isset($_FILES['image'])){
                        $er = "image is required";
                        header("location: ../register.php?error=$er");
                        exit;
                    }else{
                        $image = uploadimage('image' , $conn);

                        
                        if ($image['status'] == 'error'){
                            $er = $image['er'];
                            header("location: ../register.php?error=$er&$all_data");
                            exit;
                        }else{
                            $image_name = $image['name'];
                            $password_hash= password_hash($password , PASSWORD_DEFAULT);

                            $sql = "INSERT INTO users (fname , lname , username, email , password , phone , gender , birthdate, image) VALUES (? , ? , ? ,? ,? ,? ,?,? , ?)";
                            $stmt = $conn->prepare($sql);
                          $r =  $stmt ->execute([$fname , $lname , $username , $email , $password_hash , $phone , $gender , $birthdate , $image_name]);

                          if ($r){
                            header("location: ../register.php?success=successfully create account");
                            exit;
                          }else{
                            $er = "an error accouried";
                            header("location: ../register.php?error=$er&$all_data");
                            exit;
                          }
                            
                        }
                    }


            }else{
                $em = "an error accouried";
                header("location: ../register.php?error=$em");
                exit;
            }
                    
        }else{
            $em = "an error accouried";
            header("location: ../register.php?error=$em");
            exit;
        }