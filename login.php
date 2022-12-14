<?php


    if (isset($_GET['username'])){
        $username= $_GET['username'];
    }else{
        $username = "";
    }



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
        <form method="POST" action="req/login.php">

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
                <input type="text" class="form-control item" id="username" placeholder="Username" name="username" value="<?=$username ?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" id="password" placeholder="Password" name="password" >
            </div>
            
                    <label>remember me</label>
                    <input name="remember" value="1" type="checkbox">

            <div class="form-group">
            <input  name="login" type="submit" value="login">   <br>
        </div>
        <a href="register.php">register account</a>

        </form>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js">
    </script>
    <script src="assets/js/script.js"></script>
</body>

</html>
