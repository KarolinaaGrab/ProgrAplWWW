<?php
    // Skrypt wylogowujący użytkownika z panelu CMS
    session_start();
    session_unset();
    header('Location: log_in.php'); 
?>