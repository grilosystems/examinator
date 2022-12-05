<?php

	session_name('user_examinado');
    session_start();
	$_SESSION["idExaminado"] = '';
    unset($_SESSION["idExaminado"]);
    session_unset();
    session_destroy();
    echo '<meta http-equiv="refresh" content="0;url=index.html" />';
    exit;
?>
