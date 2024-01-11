<?php
session_start();
include 'cfg.php';

$totalItems = 0;
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta viewport="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="css/shop.css">
</head>
<body>
    <div class="container">
        <div class="product">
            <h2>Products</h2>
            <?php
            $result = mysqli_query($link, "SELECT * FROM products");
            while ($row = mysqli_fetch_assoc($result)) {
                $finalPrice = $row['netto_value'] + ($row['netto_value'] * $row['vat'] / 100);
                echo "<div>";
                echo "<h3>".$row['title']." - Netto: $".$row['netto_value']." - VAT: ".$row['vat']."% - Final: $".$finalPrice."</h3>";
                echo "<p>".$row['description']."</p>";
                echo "<a href='addToCart.php?id=".$row['id']."'>Add to Cart</a>";
                echo "</div>";
            }
            ?>
        </div>

        <div class="cart">
            <h2>Your Cart</h2>
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $productId => $quantity) {
                    $productQuery = mysqli_query($link, "SELECT title, netto_value, vat, amount FROM products WHERE id = $productId");
                    $productData = mysqli_fetch_assoc($productQuery);

                    $finalPrice = $productData['netto_value'] + ($productData['netto_value'] * $productData['vat'] / 100);
                    $totalItemPrice = $quantity * $finalPrice;
                    $totalPrice += $totalItemPrice;
                    $totalItems += $quantity;

                    echo "<div class='cart-item'>";
                    echo "<p>".$productData['title']." - Quantity: ".$quantity." - Price per item: $".$productData['netto_value']." - VAT: ".$productData['vat']."% - Total: $".$totalItemPrice."</p>";
                    echo "<form action='updateCart.php' method='post'>";
                    echo "<input type='number' name='quantity' value='".$quantity."' min='0' max='".$productData['amount']."' required>";
                    echo "<input type='hidden' name='productId' value='".$productId."'>";
                    echo "<button type='submit'>Update</button>";
                    echo "</form>";
                    echo "</div>";
                }
                echo "<p>Total Items: ".$totalItems."</p>";
                echo "<p>Total Price: $".$totalPrice."</p>";
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.cart form').forEach(function(form) {
                form.onsubmit = function() {
                    var quantity = parseInt(this.quantity.value);
                    var max = parseInt(this.quantity.max);

                    if (quantity < 0) {
                        alert('Quantity cannot be negative');
                        return false;
                    } else if (quantity > max) {
                        alert('Cannot exceed available quantity');
                        return false;
                    }

                    return true;
                };
            });
        });
    </script>
</body>
</html>
