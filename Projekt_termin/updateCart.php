<?php
// Rozpoczęcie sesji
session_start();

include 'cfg.php';

// Sprawdza, czy z formularza przesłano identyfikator produktu i jego ilość za pomocą metody POST
if(isset($_POST['productId']) && isset($_POST['quantity'])) {
    // Pobiera identyfikator produktu z danych formularza
    $productId = $_POST['productId'];
    // Konwertuje ilość produktu z danych formularza na liczbę całkowitą
    $quantity = (int) $_POST['quantity'];

    // Sprawdza, czy ilość produktu wynosi 0
    if($quantity == 0) {
        // Usuwa produkt z koszyka, jeśli jego ilość wynosi 0
        unset($_SESSION['cart'][$productId]);
    } else {
        // Aktualizuje ilość produktu w koszyku w sesji
        $_SESSION['cart'][$productId] = $quantity;
    }
}

header('Location: viewCart.php');
?>
