
<?php
// Plik konfiguracyjny do połączenia z bazą danych

    // Parametry połączenia z bazą danych
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $database = 'moja_strona';

    // Nawiązywanie połączenia z bazą danych
    $link = mysqli_connect($dbhost, $dbuser, $dbpassword);
    if(!$link) {
        echo 'no connection';
    }
    
    // Dane logowania dla konta administracyjnego
    $login = "admin";
    $pass = "admin";

    // Wybór bazy danych, obsługa błędu wyboru bazy
    if(!mysqli_select_db($link, $database)) {
        echo "no database";
    }
?>
