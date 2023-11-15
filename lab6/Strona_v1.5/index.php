<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="pl" />
    <meta name="Author" content="Karolina Grab" />
    <link rel="stylesheet" href="css/styles.css">
    <title>Filmy oscarowe</title>

    <script src="js/timedate.js" type="text/javascript"></script>
    <script src="js/kolorujtlo.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <nav>
        <ul class="menu">
            <!-- Ładowanie stron z bazy danych -->
            <li><a href="index.php?idp=1">Strona główna</a></li>
            <li><a href="index.php?idp=2">Historia i znaczenie Oscarów</a></li>
            <li><a href="index.php?idp=3">Oscarowe Filmy</a></li>
            <li><a href="index.php?idp=4">Bez Oskara</a></li>
            <li><a href="index.php?idp=5">Pamiętne słowa</a></li>
            <li><a href="index.php?idp=6">Kontakt</a></li>

            <!-- Ładowanie lokalnie 
            <li><a href="index.php?idp=glowna">Strona główna</a></li>
            <li><a href="index.php?idp=podstrona2">Historia i znaczenie Oscarów</a></li>
            <li><a href="index.php?idp=podstrona3">Oscarowe Filmy</a></li>
            <li><a href="index.php?idp=podstrona4">Bez Oskara</a></li>
            <li><a href="index.php?idp=podstrona5">Pamiętne słowa</a></li>
            <li><a href="index.php?idp=kontakt">Kontakt</a></li>
            -->
        </ul>
    </nav>

    <?php

    //Ładowanie stron z bazy danych
    include 'showpage.php';

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    if (isset($_GET['idp'])) {
        echo(showSubPage((int)$_GET['idp']));
    }
    else{
        echo(showSubPage(1));
    }

    /* Ładowanie stron lokalnie
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

    $strona = 'html/glowna.html';

    if (isset($_GET['idp'])) {
        $requestedContentFile = 'html/' . $_GET['idp'] . '.html';

    if (file_exists($requestedContentFile)) {
        $strona = $requestedContentFile;
    } else {
        echo '<script>alert("Podana podstrona nie istnieje")</script>'; 
        }
    }

    include($strona); */

    $nr_indeksu = '1234567';
    $nrGrupy = 'X';
    echo 'Autor: Karolina Grabowksa ' . $nr_indeksu . ' grupa ' . $nrGrupy . '<br /><br />';
   ?>
</body>
</html>
