<?php

// Dołącza plik konfiguracyjny, np. do połączenia z bazą danych.
include '../cfg.php';

// Deklaruje globalną zmienną $link używaną do połączenia z bazą danych.
global $link;

// Funkcja generująca formularz logowania.
function FormularzLogowania(){ 
    // Zmienna $result przechowuje kod HTML formularza.
    $result = '
        <div class="logowanie">
            <h1 class="heading">Panel CMS:</h1>
            <div class="logowanie">
                <form method="POST" name="LoginForm" enctype="multipart/form-data" action="'.$_SERVER['REQUEST_URI'].'">
                    <table class="logowanie-2">
                        <tr><td class="log4_t"></td><td><input type="text" name="login_email" class="logowanie" placeholder="email"/></td></tr>
                        <tr><td class="log4_t"></td><td><input type="password" name="login_pass" class="logowanie" placeholder="password"/></td></tr>
                        <tr><td>&nbsp;</td><td><input type="submit" name="x1_submit" class="button" value="Zaloguj" /></td></tr>
                    </table>
                </form>
            </div>
        </div>
    ';
    return $result; // Zwraca kod HTML formularza.
}

// Funkcja wyświetlająca listę podstron z bazy danych.
function ListaPodstron($link){ 
    $query = "SELECT * FROM page_list"; // Zapytanie SQL do pobrania wszystkich podstron.
    $result = mysqli_query($link, $query); // Wykonanie zapytania.
    
    echo '<table>';
    echo '<tr>';
    echo '<th>id</th>';
    echo '<th>titile</th>';
    echo '</tr>';
    
    // Generowanie tabeli HTML z wynikami zapytania.
    while($row = mysqli_fetch_array($result)){
        // Kod HTML prezentujący dane każdej podstrony.
        echo '<tr>';
        echo '<td>'.$row['id'].'</td>';
        echo '<td>'.$row['page_title'].'</td>';
        echo '</tr>';
    }
    echo '</table>';
}

// Funkcja generująca formularz do edycji podstrony.
function EdytujPodstrone(){ 
    $result = '
        <div class="edit_sub_page">
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
            <h1>Edytuj podstrone: </h1>
                <input type="number" name="p_id" placeholder="ID strony">
                <input type="text" name="page_title" placeholder="Tytuł strony">
                <textarea name="page_content" rows="20" cols="70 "placeholder="Treść strony"></textarea>
                <label><input type="checkbox" name="p_status" class="checkbox">Aktywna?</label>
                <div>
                    <div><input type="submit" value="edytuj" class="edit" name="btn-edit"></div>
                </div>
            </form>
        </div>
        ';
    return $result;
}

// Funkcja generująca formularz do tworzenia nowej podstrony.
function StworzPodstrone(){
    $wynik = '
        <div class="createForm">
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
            <h1>Dodaj stronę: </h1>
                <input type="number" name="p_id" placeholder="ID strony">
                <input type="text" name="page_title" placeholder="Tytuł strony">
                <textarea name="page_content" rows="20" cols="70 "placeholder="Treść strony"></textarea>
                <label><input type="checkbox" name="p_status" class="checkbox">Aktywna?</label>
                <div>
                    <div><input type="submit" value="stworz" class="create" name="btn-create"></div>
                </div>
            </form>
        </div>
        ';
    return $wynik;
}

// Funkcja generująca formularz do usuwania podstrony.
function UsunPodstrone(){
    $wynik = '
        <div class="deleteForm">
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
            <h1>Usuń stronę: </h1>
                <input type="number" name="p_id" placeholder="ID strony">
                <div>
                    <div><input type="submit" value="usun" class="delete" name="btn-delete"></div>
                </div>
            </form>
        </div>
        ';
    return $wynik;
}

// Funkcja wyświetlająca kategorie produktów i ich produkty.
function PokazKategorie($link, $parent = 0, $indent = 0) { 
    // Zapytania SQL i generowanie listy HTML kategorii i produktów.
    $queryCategories = "SELECT * FROM categories WHERE parent = $parent";
    $resultCategories = mysqli_query($link, $queryCategories);
    
    if (!$resultCategories) {
        die("Błąd zapytania: " . mysqli_error($link));
    }

    echo '<ul>';
    while ($rowCategory = mysqli_fetch_assoc($resultCategories)) {
        echo '<li>';
        echo str_repeat('-', $indent);
        echo 'Category ID: ' . $rowCategory['id'] . ', Name: ' . $rowCategory['name'];

        PokazKategorie($link, $rowCategory['id'], $indent + 1);

        $queryProducts = "SELECT * FROM products WHERE category = " . $rowCategory['id'];
        $resultProducts = mysqli_query($link, $queryProducts);

        if ($resultProducts) {
            echo '<ul>';
            while ($rowProduct = mysqli_fetch_assoc($resultProducts)) {
                echo '<li>';
                echo 'Product ID: ' . $rowProduct['id'] . ', ';
                echo 'Title: ' . $rowProduct['title'] . ', ';
                echo 'Description: ' . $rowProduct['description'] . ', ';
                echo 'Creation Date: ' . $rowProduct['creation_date'] . ', ';
                echo 'Modify Date: ' . $rowProduct['modify_date'] . ', ';
                echo 'Expiration Date: ' . $rowProduct['expiration_date'] . ', ';
                echo 'Net Value: ' . $rowProduct['netto_value'] . ', ';
                echo 'VAT: ' . $rowProduct['vat'] . ', ';
                echo 'Amount: ' . $rowProduct['amount'] . ', ';
                echo 'Availability: ' . ($rowProduct['availability_status'] ? 'Available' : 'Not Available') . ', ';
                echo 'Category: ' . $rowProduct['category'] . ', ';
                echo 'Size: ' . $rowProduct['size'] . ', ';
                // Linia dla obrazów
                // echo 'Image: ' . '<img src="data:image/jpeg;base64,' . base64_encode($rowProduct['image']) . '"/>';
                echo '</li>';
            }
            
            echo '</ul>';
        }

        echo '</li>';
    }
    echo '</ul>';
}

// Funkcja generująca formularz do edycji kategorii.
function EdytujKategorieForm(){ 
    $form = '
        <div class="edit_category">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                <h1>Edytuj kategorię: </h1>
                <input type="number" name="category_id" placeholder="ID kategorii">
                <input type="text" name="category_name" placeholder="Nazwa kategorii">
                <div>
                    <input type="submit" value="Edytuj" class="edit" name="btn-edit-category">
                </div>
            </form>
        </div>
    ';
    return $form;
}

// Funkcja generująca formularz do dodawania kategorii.
function DodajKategorieForm(){ 
    $form = '
        <div class="create_category">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                <h1>Dodaj kategorię: </h1>
                <input type="text" name="new_category_name" placeholder="Nazwa nowej kategorii">
                <input type="number" name="parent_id" placeholder="Id matki">
                <div>
                    <input type="submit" value="Stwórz" class="create" name="btn-create-category">
                </div>
            </form>
        </div>
    ';
    return $form;
}

// Funkcja generująca formularz do usuwania kategorii.
function UsunKategorieForm(){ 
    $form = '
        <div class="delete_category">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                <h1>Usuń kategorię: </h1>
                <input type="number" name="delete_category_id" placeholder="ID kategorii do usunięcia">
                <div>
                    <input type="submit" value="Usuń" class="delete" name="btn-delete-category">
                </div>
            </form>
        </div>
    ';
    return $form;
}

// Funkcja generująca formularz do usuwania produktu.
function UsunProduktForm(){ 
    $form = '
        <div class="delete_category">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
                <h1>Usuń produkt: </h1>
                <input type="number" name="delete_product_id" placeholder="ID produktu do usunięcia">
                <div>
                    <input type="submit" value="Usuń" class="delete" name="btn-delete-product">
                </div>
            </form>
        </div>
    ';
    return $form;
}

// Funkcja generująca formularz do tworzenia nowego produktu.
function StworzProdukt() { 
    $form = '
        <style>
            .createForm input,
            .createForm textarea,
            .createForm label {
                display: block; /* Makes each input and label take up a full line */
                margin-bottom: 10px; /* Adds space between the elements */
            }
        </style>
        <div class="createForm">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST" enctype="multipart/form-data">
                <h1>Dodaj Produkt: </h1>
                
                <label for="product_title">Nadaj nazwę produktu:</label>
                <input type="text" name="product_title" placeholder="Nazwa">

                <label for="product_description">Opis produktu:</label>
                <textarea name="product_description" placeholder="Opis"></textarea>

                <label for="product_creation_date">Data utworzenia produktu:</label>
                <input type="date" name="product_creation_date" placeholder="Data utworzenia">

                <label for="product_modify_date">Data modyfikacji produktu:</label>
                <input type="date" name="product_modify_date" placeholder="Data modyfikacji">

                <label for="product_expiration_date">Data wygaśnięcia produktu:</label>
                <input type="date" name="product_expiration_date" placeholder="Data wygaśnięcia">

                <label for="product_netto_value">Cena netto produktu:</label>
                <input type="number" step="0.01" name="product_netto_value" placeholder="Cena netto">

                <label for="product_vat">VAT produktu:</label>
                <input type="number" step="0.01" name="product_vat" placeholder="Vat">

                <label for="product_amount">Ilość produktu:</label>
                <input type="number" name="product_amount" placeholder="Ilość">

                <label for="product_availability_status">Dostępność produktu:</label>
                <label>
                    <input type="checkbox" name="product_availability_status" class="checkbox">
                </label>

                <label for="product_category">Kategoria produktu:</label>
                <input type="number" name="product_category" placeholder="Kategoria">

                <label for="product_size">Gabaryt produktu:</label>
                <input type="text" name="product_size" placeholder="Gabaryt produktu">

                <label for="product_image">Zdjęcie produktu:</label>
                <input type="file" name="product_image" placeholder="Zdjęcie">

                <input type="submit" value="Stwórz" class="create" name="btn-create-p">
            </form>
        </div>
    ';
    return $form;
}

// Funkcja generująca formularz do edycji produktu.
function EdytujProduktForm() { 
    $form = '
        <style>
            .edit_product form label, .edit_product form input, .edit_product form textarea {
                display: block; /* Makes each input and label take up a full line */
                margin-bottom: 10px; /* Adds space between the elements */
            }
        </style>
        <div class="edit_product">
            <form action="'.$_SERVER['REQUEST_URI'].'" method="POST" enctype="multipart/form-data">
                <h1>Edytuj Produkt: </h1>

                <label for="product_id">ID produktu:</label>
                <input type="number" name="product_id" placeholder="ID produktu">

                <label for="product_title">Edytuj nazwę produktu:</label>
                <input type="text" name="product_title" placeholder="Nazwa produktu">

                <label for="product_description">Edytuj opis produktu:</label>
                <textarea name="product_description" placeholder="Opis produktu"></textarea>

                <label for="product_creation_date">Edytuj datę utworzenia produktu:</label>
                <input type="date" name="product_creation_date" placeholder="Data utworzenia produktu">

                <label for="product_modify_date">Edytuj datę modyfikacji produktu:</label>
                <input type="date" name="product_modify_date" placeholder="Data modyfikacji produktu">

                <label for="product_expiration_date">Edytuj datę wygaśnięcia produktu:</label>
                <input type="date" name="product_expiration_date" placeholder="Data wygaśnięcia produktu">

                <label for="product_netto_value">Edytuj cenę netto produktu:</label>
                <input type="number" step="0.01" name="product_netto_value" placeholder="Cena netto produktu">

                <label for="product_vat">Edytuj VAT produktu:</label>
                <input type="number" step="0.01" name="product_vat" placeholder="VAT produktu">

                <label for="product_amount">Edytuj ilość produktu:</label>
                <input type="number" name="product_amount" placeholder="Ilość produktu">

                <label for="product_availability_status">Edytuj dostępność produktu:</label>
                <input type="checkbox" name="product_availability_status" class="checkbox">

                <label for="product_category">Edytuj kategorię produktu:</label>
                <input type="number" name="product_category" placeholder="Kategoria produktu">

                <label for="product_size">Edytuj gabaryt produktu:</label>
                <input type="text" name="product_size" placeholder="Gabaryt produktu">

                <label for="product_image">Edytuj zdjęcie produktu:</label>
                <input type="file" name="product_image" placeholder="Zdjęcie produktu">

                <div>
                    <input type="submit" value="Edytuj" class="edit" name="btn-edit-product">
                </div>
            </form>
        </div>
    ';
    return $form;
}

?>