<?php

if (empty($_POST['ee'])){
echo "bad";
}else{
    echo $_POST['ee'];

}

exit;
    function uploadimage($image){
    $image_name = $_FILES[$image]['name'];
    $image_error = $_FILES[$image]['error'];
    $image_tmp = $_FILES[$image]['tmp_name'];
    $image_size = $_FILES[$image]['size'];

        if ($image_error == 0){
           $extenstion_allow = array("jpg" , "png" , "jped");
           $extenstion = pathinfo($image_name , PATHINFO_EXTENSION);
           if(in_array($extenstion , $extenstion)){
                if ($image_size <= 2000000){
                        $new_image_name = uniqid("img-") . '.' . $extenstion;
                        $path = "../image/$new_image_name";
                        move_uploaded_file($image_tmp , $path);

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

    }

