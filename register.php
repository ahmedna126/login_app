<?php

    function isset_get($name){
        if (isset($_GET[$name])){
            return $_GET[$name];
        }else{
            return "";
        }
    }

        $fname = isset_get("fname");
        $lname = isset_get("lname");
        $email = isset_get("email");
        $phone = isset_get("phone");
        $username = isset_get("username");
        $gender = isset_get("gender");



?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/style.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Easiest Way to Add Input Masks to Your Forms</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
</head>

<body>



    <div class="registration-form">
        <form method="POST" action="req/register.php" enctype="multipart/form-data">

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>

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

            <div class="form-group">
                <input type="text" class="form-control item" id="username" placeholder="first name" name="fname" value="<?=$fname ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="username" placeholder="last name" name="lname" value="<?=$lname ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="username" placeholder="Username" name="username" value="<?=$username ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" placeholder="Password" name="password" >
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" placeholder="confirm Password"
                    name="confirm">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email" placeholder="Email" name="email" value="<?=$email ?>">
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" id="email" placeholder="Phone Number" name="phone" value="<?=$phone ?>">
            </div>

            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="gender">
                <option >gender</option>
                <option value="male" <?php if($gender == "male")echo "selected"; ?>>male</option>
                <option value="female" <?php if($gender == "female")echo "selected"; ?>>female</option>
            </select>

            <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                <label for="example">birth date</label>

                <input placeholder="Select date" type="date" id="example" class="form-control" name="birthdate">
                <i class="fas fa-calendar input-prefix"></i>
            </div>
            <label class="form-label" for="customFile">your image</label>
        <input type="file" class="form-control" id="customFile" name="image"/><br>
            <div class="form-group">
            <input  name="register" type="submit" value="register Account">   <br>
                <br>
            <a href="login.php">login account</a>
        </div>
        
        </form>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
    </script>
    <script src="assets/js/script.js"></script>
</body>

</html>