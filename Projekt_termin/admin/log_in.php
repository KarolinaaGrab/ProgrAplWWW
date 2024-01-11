<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <title>Oscary</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="#">
    <title>CMS</title>
</head>

<body>
<?php
    // Strona logowania do panelu CMS

    session_start(); 
    require_once("../cfg.php");
    require_once("admin.php"); 
    echo FormularzLogowania(); 

    if(isset($_POST['x1_submit'])) { 
        $user = mysqli_real_escape_string($link, $_POST['login_email']); // Oczyszczenie danych wejściowych
        $password = mysqli_real_escape_string($link, $_POST['login_pass']);
        
        // Weryfikacja danych logowania
        if($user == $login && $password == $pass) { 
            $_SESSION['user'] = $user;
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin_panel.php"); // Przekierowanie do panelu administracyjnego
        } 
        else { 
            echo "Błędne dane. Proszę spróbować ponownie.";
        }
    } 

    // Przekierowanie do panelu administracyjnego, jeśli użytkownik jest już zalogowany
    if ((isset($_SESSION['admin_logged_in'])) && ($_SESSION['admin_logged_in']==true)){
        header('Location: admin_panel.php'); 
        exit();
    }
?>

</body>
</html>