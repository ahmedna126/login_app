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

        // to protect from csrf
        $csrf_token = md5(uniqid());
        $_SESSION['csrf_token'] = $csrf_token;

    if (isset($_SESSION['username']) && isset($_SESSION['email'])){
        $user_data =getuserbyusername($_SESSION['username'] , $conn);

        if ($user_data == 0) {
                header("location: logout.php");
                exit;
            }

            

        ?>


<html>

<head>
    <style>
    body {
        margin-top: 20px;
    }

    .avatar {
        width: 200px;
        height: 200px;
    }
    </style>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>



<div class="container bootstrap snippets bootdey">
    <h1 class="text-primary">Edit Profile</h1>
    <a href="index.php" ><button >go to index</button> </a>
    <hr>
    <div class="row">
        <!-- left column -->
        <div class="col-md-3">
            <div class="text-center">
                <img src="image/<?=$user_data['image'] ?>" class="avatar img-circle img-thumbnail"
                    alt="avatar">
                    <h6>@<?=$user_data['username'] ?></h6>
                    <h6>Upload photo...</h6>

                    <form enctype="multipart/form-data" method="POST" action="req/edit_profile.php">
                <input type="file" class="form-control" name="image"><br>
                <input hidden name="csrf_token" value="<?=$csrf_token ?>">
                    <button type="submit">update photo</button>
                </form>
            </div>
        </div>

        <!-- edit form column -->
        <div class="col-md-9 personal-info">

            <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger" role="alert">
                <?=htmlspecialchars($_GET['error']); ?>
            </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-success" role="alert">
                <?=htmlspecialchars($_GET['success']); ?>
            </div>
            <?php } ?>

            <h3>Personal info</h3>

            <form class="form-horizontal" role="form" method="POST" action="req/edit_profile.php">
            <input hidden name="csrf_token" value="<?=$csrf_token ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">First name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?=$user_data['fname'] ?>" name="fname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Last name:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?=$user_data['lname'] ?>" name="lname">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">username:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?=$user_data['username'] ?>" name="username" >
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">phone:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?=$user_data['phone'] ?>" name="phone">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" value="<?=$user_data['email'] ?>" name="email">
                    </div>
                </div>
                <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                <label for="example">birth date</label>

                <input placeholder="Select date" type="date" id="example" class="form-control" name="birthdate" value="<?=$user_data['birthdate'] ?>">
                <i class="fas fa-calendar input-prefix"></i>
            </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">gender:</label>
                    <div class="col-lg-8">
                        <div class="ui-select">
                            <select id="user_time_zone" class="form-control" name="gender">
                                <option value="male" <?php if (strcasecmp($user_data['gender'] , 'male'))echo "selected";  ?> >male</option>
                                <option value="female" <?php if (strcasecmp($user_data['gender'] , 'male'))echo "selected";  ?>>female</option>
                                
                            </select>
                            
                <br>
                <input type="submit" name="update_profile" value="update profile">
                        </div>
                    </div>
                </div>
            </form>

                <hr>
                <br>
                <h4 id="update_passowrd">update password</h4>

            <form class="form-horizontal" role="form" method="POST" action="req/update_password.php">
            <?php if (isset($_GET['perror'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['perror']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['psuccess'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['psuccess']); ?>
		  </div>
		<?php } ?>
            <input hidden name="csrf_token" value="<?=$csrf_token ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label">current password:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="current_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">new password:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="new_password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">confirm new password:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="confirm_password">
                    </div>
                </div>
                <br>
                <button type="submit" name="update_password">update password</button>
            </form>
        </div>
    </div>
</div>
<hr>

</html>


<?php




        }else{
            header("location: login.php");
            exit;
        }