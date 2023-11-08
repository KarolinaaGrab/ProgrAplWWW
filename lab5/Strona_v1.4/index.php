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
            <li><a href="index.php?idp=glowna">Strona główna</a></li>
            <li><a href="index.php?idp=podstrona2">Historia i znaczenie Oscarów</a></li>
            <li><a href="index.php?idp=podstrona3">Oscarowe Filmy</a></li>
            <li><a href="index.php?idp=podstrona4">Bez Oskara</a></li>
            <li><a href="index.php?idp=podstrona5">Pamiętne słowa</a></li>
            <li><a href="index.php?idp=filmy">Filmy</a></li>
            <li><a href="index.php?idp=kontakt">Kontakt</a></li>
        </ul>
    </nav>

    <?php
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

include($strona);
   
    $nr_indeksu = '164380';
    $nrGrupy = '2 ISI';
    echo 'Autor: Karolina Grabowska ' . $nr_indeksu . ' grupa ' . $nrGrupy . '<br /><br />';
   ?>
</body>
</html>
