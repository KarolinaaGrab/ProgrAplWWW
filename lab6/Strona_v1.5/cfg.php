<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $database = 'moja_strona';

    $link = mysqli_connect($dbhost, $dbuser, $dbpassword);
    if(!$link) {
        echo 'no connection';
    }
    
    if(!mysqli_select_db($link, $database)) {
        echo "no database";
    }
?>
