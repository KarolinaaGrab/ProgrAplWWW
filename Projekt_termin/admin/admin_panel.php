<link rel="stylesheet" href="../css/cms.css">

<?php 
    require_once('../contact.php');

    session_start(); # rozpoczęcie sesji
    if (!isset($_SESSION['admin_logged_in'])){   # jeśli sesja nie jest ustawiona na zalogowanego użytkownika, użytkownik jest przekierowywany na stronę logowania
        header('Location: log_in.php'); # adres strony logowania
        exit();
    }
    require_once('admin.php');
    require_once('../cfg.php'); # import pliku konfiguracyjnego

    global $link;

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
    <link rel="stylesheet" href="../css/admin.css"> 
</head>
<body>
    <div class="admin-panel">
        <h1>Admin Panel</h1>
        <button><a href="log_out.php">Wyloguj się</a></button>
        <button><a href="../contact_page.php">Wyślij wiadomosc</a></button>
        <button><a href="manage_subpages.php">Zarządzaj Podstronami</a></button>
        <button><a href="manage_categories_products.php">Zarządzaj Kategoriami i Produktami</a></button>
    </div>
</body>
</html>