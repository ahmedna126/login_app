
    <?php

    setcookie('token_user' , '' , time()-1000 );

        session_start();
        session_unset();

        session_destroy();

        header("location: login.php");
        exit;