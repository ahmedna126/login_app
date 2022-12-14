<?php
function validateinput($data){
            $data = trim($data);  // to remove spaces
            $data = strip_tags($data); // to delete <>
            $data = htmlspecialchars($data);  // to encode html tags 
            $data = stripslashes($data);    // to remove \ back slash
                return $data;
        }

        // to check if input is empty
        function is_empty_input($input , $name , $file , $data=""){
            if (empty($input)){
                $er= "$name is required";
            header("location: ../$file.php?error=$er&$data");
            exit;
            }
        }


        // to check if input is exist
        function isset_function($file , ...$input  ){
                foreach ($input as $input){
                    if (!isset($_POST[$input])){
                        $er = "an error accouried";
                        header("location: ../$file.php?error=$er");
                        exit;
                    }else{
                        return 1;
                    }
                }
        }

        // username is unique
        function usernameisunique($username , $conn , $user_id=0){
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$username]);
            $row_count = $stmt->rowCount(); 
                if ($user_id == 0){
                    if ($row_count >= 1){
                        return 0;
                    }else{
                        return 1;
                    }

                }else{
                    if ($row_count >= 1){

                        $user_data = $stmt->fetch();
                        if ($user_data['id'] == $user_id){
                            
                            return 1; 
    
    
                        }else{
                            return 0;
                        }
                    }else{
                        return 1;
                    }
                    }
    
        }

        // email is unique
        function emailisunique($email , $conn , $user_id = 0){
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);
                $row_count = $stmt->rowCount(); 
                if ($user_id == 0){
                    if ($row_count >= 1){
                        return 0;
                    }else{
                        return 1;
                    }

                }else{
                    if ($row_count >= 1){

                    $user_data = $stmt->fetch();
                    if ($user_data['id'] == $user_id){
                        return 1; 
                    }else{
                        return 0;
                    }
                }else{
                    return 1;
                }
                }
        }
        

        // to upload image
        function uploadimage($image , $conn, $id= 0){
            $image_name = $_FILES[$image]['name'];
            $image_error = $_FILES[$image]['error'];
            $image_tmp = $_FILES[$image]['tmp_name'];
            $image_size = $_FILES[$image]['size'];
        
                if ($image_error == 0){
                   $extenstion_allow = array("jpg" , "png" , "jped");
                   $extenstion = pathinfo($image_name , PATHINFO_EXTENSION);
                   if(in_array($extenstion , $extenstion_allow)){
                        if ($image_size <= 2000000){
                                $new_image_name = uniqid("img-") . '.' . $extenstion;
                                $path = "../image/$new_image_name";
                                move_uploaded_file($image_tmp , $path);

                                // to delete old photo if id user is found
                                $id = filter_var($id , FILTER_SANITIZE_NUMBER_INT);
                                if ($id != 0 ){
                                    $sql = "SELECT * FROM users WHERE id = ?";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute([$id]);
                                    if ($stmt->rowCount() == 1){
                                        $data_user = $stmt->fetch();
                                        $old_name_image = $data_user['image'];
                                        $path_old_photo = "../image/$old_name_image";
                                        unlink($path_old_photo);
                
                                    }else{
                                        $data['status'] = "error";
                                        $data['er'] = "an error accouried";
                                    }
                                }
        
                                $data['status'] = "success";
                                $data['name'] = $new_image_name;
        
                        }else{
                            $data['status'] = "error";
                            $data['er'] = "size is very long";
                        }
        
                }else{
                    $data['status'] = "error";
                    $data['er'] = "extenstion is not allowed";
                }
                    
        
        
                }else{
                    $data['status'] = "error";
                    $data['er'] = "an error accouried";
                }

                return $data;
        
            }



        function getuserbyusername($username , $conn){
            $sql = "SELECT * FROM users WHERE username = ?";
            $stmt= $conn->prepare($sql);
            $stmt->execute([$_SESSION['username']]);

                if ($stmt->rowCount() == 1){
                    $user_data = $stmt->fetch();
                    return $user_data;
                }else{
                    return 0;
                }
        }