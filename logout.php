
    <?php

    setcookie('token_user' , '' , time()-(3600*24*2) );

        session_start();
        session_unset();

        session_destroy();

        header("location: login.php");
        exit;
