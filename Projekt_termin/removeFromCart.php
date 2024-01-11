<?php
// Rozpoczęcie sesji
session_start();

// Sprawdzenie, czy identyfikator produktu (id) został przekazany za pomocą metody GET
if(isset($_GET['id'])){
    // Pobranie identyfikatora produktu z parametru GET
    $productId = $_GET['id'];

    // Sprawdzenie, czy w koszyku sesji istnieje produkt o podanym identyfikatorze
    if(isset($_SESSION['cart'][$productId])){
        // Zmniejszenie liczby produktów o podanym identyfikatorze w koszyku
        $_SESSION['cart'][$productId]--;

        // Sprawdzenie, czy po zmniejszeniu liczba sztuk tego produktu wynosi 0
        if($_SESSION['cart'][$productId] == 0){
            unset($_SESSION['cart'][$productId]);
        }
    }
}

header('Location: viewCart.php');
?>
