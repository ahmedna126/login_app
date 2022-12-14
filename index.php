<?php

    if (!isset($_SESSION)){
        session_start();
    }
    include "db_conn.php";
    include "req/function.php";

    if (!function_exists("rememberme")){
        include "rememberme.php";
        rememberme($conn);
    }

        if (isset($_SESSION['username']) && isset($_SESSION['email'])){
            $user_data =getuserbyusername($_SESSION['username'] , $conn);

            if ($user_data == 0) {
                    header("location: logout.php");
                    exit;
                }

                

            ?>

<head>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>


<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class=" image d-flex flex-column justify-content-center align-items-center"> <button
                class="btn btn-secondary"> <img src="image/<?=$user_data['image'] ?>" height="100"
                    width="100" /></button>

            <span class="name mt-3"><?php echo $user_data['fname'] . ' ' . $user_data['lname'];  ?></span>
            <span class="idd">@<?=$user_data['username'] ?></span>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"><span>email: &nbsp;</span> <b>
                    <?=$user_data['email'] ?> </b> </div>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"><span>phone:&nbsp; </span> <b>
                    <?=$user_data['phone'] ?> </b> </div>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"><span>gender:&nbsp; </span> <b>
                    <?=$user_data['gender'] ?> </b> </div>
            <div class="d-flex flex-row justify-content-center align-items-center gap-2"><span>birthdate:&nbsp; </span>
                <b> <?=$user_data['birthdate'] ?> </b> </div>
           
            <div class=" d-flex mt-2"> <a href="edit_profile.php" ><button class="btn1 btn-dark" type="button">edit Profile</button></a> </div>
            <div class="text mt-3">


                <span> </span>
                <div class=" d-flex mt-2"><a href="logout.php"> <button class="btn1 btn-dark">
                        logout</button></a> </div>
            </div>

            <?php
                $date = date('Y-m-d' , strtotime($user_data['date_added']));

                        ?>
            <div class=" px-2 rounded mt-4 date "> <span class="join">Joined <?=$date ?></span> </div>
            
        </div>
    </div>
</div>


<?php




        }else{
            header("location: login.php");
            exit;
        }