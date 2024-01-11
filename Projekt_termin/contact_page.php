<?php 
// Strona z formularzem kontaktowym

    // Włączenie plików z funkcjami kontaktowymi i konfiguracyjnymi
    require_once('contact.php');
    require_once('cfg.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <title>Oskary</title>
    <meta name="Author" content="Karolina Grabowska" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="#">
    <title>CMS</title>
</head>

<body>
    <?php
    // Wyświetlanie formularza kontaktowego
    echo PokazKontakt();

    // Obsługa wysyłania formularza
    if (isset($_POST['send'])) {
        WyslijMainKontankt("kontoprojekt9@gmail.com");
    }

    // Przekierowanie do panelu administracyjnego po kliknięciu przycisku
    if (isset($_POST['back'])) {
        header('Location: admin/admin_panel.php');
    }

    echo PrzypomnijHaslo();
    WyslijPrzypomnienieHasla();
    ?>

</body>
</html>