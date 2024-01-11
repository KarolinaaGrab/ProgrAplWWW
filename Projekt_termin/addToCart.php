<?php
// Rozpoczęcie sesji, aby śledzić dane użytkownika
session_start();

// Dołączenie pliku konfiguracyjnego, połączenie z bazą danych
include 'cfg.php';

// Sprawdzenie, czy w sesji istnieje tablica 'cart' (koszyk). Jeśli nie, zostaje ona utworzona.
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

// Sprawdzenie, czy do strony przekazano identyfikator produktu (id) przez metodę GET
if(isset($_GET['id'])){
    // Pobranie identyfikatora produktu z parametru GET
    $productId = $_GET['id'];

    // Wykonanie zapytania do bazy danych, aby pobrać dostępną ilość produktu o podanym id
    $productQuery = mysqli_query($link, "SELECT amount FROM products WHERE id = $productId");
    $productData = mysqli_fetch_assoc($productQuery);

    // Sprawdzenie, czy produkt istnieje w bazie danych
    if($productData){
        // Pobranie ilości produktu z koszyka sesji lub ustawienie na 0, jeśli produkt nie jest jeszcze w koszyku
        $currentCartAmount = isset($_SESSION['cart'][$productId]) ? $_SESSION['cart'][$productId] : 0;
        if($productData['amount'] > $currentCartAmount){
            if(isset($_SESSION['cart'][$productId])){
                $_SESSION['cart'][$productId]++;
            } else {
                $_SESSION['cart'][$productId] = 1;
            }
            // Przekierowanie użytkownika do strony koszyka
            header('Location: viewCart.php');
        } else {
            // Wyświetlenie alertu, jeśli nie ma więcej dostępnych sztuk produktu i przekierowanie do koszyka
            echo "<script>alert('No more available items'); window.location.href='viewCart.php';</script>";
        }
    } else {
        // Wyświetlenie komunikatu, gdy produkt nie istnieje w bazie danych
        echo "Product not found.";
    }
} else {
    // Wyświetlenie komunikatu, gdy nie przekazano identyfikatora produktu
    echo "Product not found.";
}
?>
