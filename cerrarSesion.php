<?php

	session_name('user_sesion');
    session_start();
    unset($_SESSION["usr_ses"]); 
    unset($_SESSION['tipo_usr']);
    session_unset();
    session_destroy();
    echo '<meta http-equiv="refresh" content="0;url=index.html" />';
    //header("Location: index.html");
    exit;
?>