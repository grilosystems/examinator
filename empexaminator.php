<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_empexaminator = "localhost";
$database_empexaminator = "examinator";
$username_empexaminator = "root";
$password_empexaminator = "patachin83";
$empexaminator = mysql_pconnect($hostname_empexaminator, $username_empexaminator, $password_empexaminator) or trigger_error(mysql_error(),E_USER_ERROR); 
?>