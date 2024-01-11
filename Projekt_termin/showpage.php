<?php

//Główny plik funkcji - odpowiedzialny za wyświetlanie podstron

// Włączenie pliku konfiguracyjnego
include 'cfg.php'; 

function showSubPage($id)
{
    // Użycie globalnego połączenia do bazy danych
    global $link; 

    // Oczyszczanie danych wejściowych, aby zapobiec atakom iniekcji SQL
    $id_clear = htmlspecialchars($id);

    // Zapytanie SQL z ograniczeniem do jednego rekordu
    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    // Sprawdzanie, czy wynik zapytania jest pusty
    if (empty($row['id'])) {
        $web = '[no page found]';
    } else {
        $web = $row['page_content'];
    }

    return $web;
} 
?>
