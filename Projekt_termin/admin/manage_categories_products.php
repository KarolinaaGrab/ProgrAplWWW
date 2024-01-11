<?php 
require_once('admin.php'); // Include the admin.php to use its functions
require_once('../cfg.php'); // Import the configuration file

session_start(); // Start the session
if (!isset($_SESSION['admin_logged_in'])) { // Check if the admin is logged in
    header('Location: log_in.php'); // Redirect to login page if not logged in
    exit();
}

global $link; // Ensure the database connection is available
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories and Products</title>
    <link rel="stylesheet" href="../css/cms.css"> <!-- Link to your CSS file -->
</head>
<body>
    <table>
        <tr>
            <td><button><a href="admin_panel.php">Powrót do panelu admina</a></button></td>
        </tr>
        <tr>
            <td><button><a href="log_out.php">Wyloguj się</a></button></td>
        </tr>
    </table>

    <?php
    ob_start();
    
    // Wywołania funkcji do obsługi kategorii
    PokazKategorie($link);

    echo EdytujKategorieForm();

    if(isset($_POST['btn-edit-category'])){
        $category_id = $_POST['category_id'];
        $category_name = $_POST['category_name']; 
     
        $query = "SELECT * FROM categories WHERE id='$category_id'"; 
        $result = mysqli_query($link, $query);
    
        if(mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result); 
            $existing_category = $row['name']; 
            if ($existing_category == $category_name) { 
                echo "Kategoria o takim tytule juz istnieje";
            } else { 
                $query = "UPDATE categories SET name='$category_name' WHERE id='$category_id'";
                $result = mysqli_query($link, $query);
            }
        }

        header("Location: manage_categories_products.php");
        exit(); 
    }

    echo DodajKategorieForm();

    if(isset($_POST['btn-create-category'])){
        $new_category_name = $_POST['new_category_name'];
        $parent_id = $_POST['parent_id'];
        $query = "INSERT INTO categories (name, parent) VALUES ( '".$new_category_name."', '".$parent_id."')"; 
        mysqli_query($link, $query); 

        header("Location: manage_categories_products.php"); 
        exit(); 
    }

    
    echo UsunKategorieForm();

    if(isset($_POST['btn-delete-category'])){ 
        $category_id = $_POST['delete_category_id']; 
        $query = "DELETE FROM categories WHERE id = '".$category_id."'"; 
        mysqli_query($link, $query);

        header("Location: manage_categories_products.php");
        exit(); 
    }

    

    if(isset($_POST['btn-delete-product'])){ 
        $product_id = $_POST['delete_product_id']; 
        $query = "DELETE FROM products WHERE id = '".$product_id."'"; 
        mysqli_query($link, $query);

        header("Location: manage_categories_products.php");
        exit(); 
    }
    echo UsunProduktForm();
    echo StworzProdukt();

    if(isset($_POST['btn-create-p'])){
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_creation_date = $_POST['product_creation_date'];
        $product_modify_date = $_POST['product_modify_date'];
        $product_expiration_date = $_POST['product_expiration_date'];
        $product_netto_value = $_POST['product_netto_value'];
        $product_vat = $_POST['product_vat'];
        $product_amount = $_POST['product_amount'];
        $product_availability_status = isset($_POST['product_availability_status']) ? 1 : 0;
        $product_category = $_POST['product_category'];
        $product_size = $_POST['product_size'];

        if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0){
            $target_dir = "../img/"; 
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)){
                $product_image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
                $product_image = null;
            }
        } else {
            $product_image = null;
        }

        $query = "INSERT INTO products (title, description, creation_date, modify_date, expiration_date, netto_value, vat, amount, availability_status, category, size, image) VALUES ('".$product_title."', '".$product_description."', '".$product_creation_date."', '".$product_modify_date."', '".$product_expiration_date."', '".$product_netto_value."', '".$product_vat."', '".$product_amount."', '".$product_availability_status."', '".$product_category."', '".$product_size."', '".$product_image."')"; 
        mysqli_query($link, $query); 

        header("Location: manage_categories_products.php"); 
        exit(); 
    }

    echo EdytujProduktForm();

    if(isset($_POST['btn-edit-product'])){
        $product_id = $_POST['product_id'];
        $product_title = $_POST['product_title'];
        $product_description = $_POST['product_description'];
        $product_creation_date = $_POST['product_creation_date'];
        $product_modify_date = $_POST['product_modify_date'];
        $product_expiration_date = $_POST['product_expiration_date'];
        $product_netto_value = $_POST['product_netto_value'];
        $product_vat = $_POST['product_vat'];
        $product_amount = $_POST['product_amount'];
        $product_availability_status = isset($_POST['product_availability_status']) ? 1 : 0;
        $product_category = $_POST['product_category'];
        $product_size = $_POST['product_size'];
        $product_image = null;
    
        if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0){
            $target_dir = "../img/";
            $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
            if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)){
                $product_image = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    
        $query = "UPDATE products SET title='$product_title', description='$product_description', creation_date='$product_creation_date', modify_date='$product_modify_date', expiration_date='$product_expiration_date', netto_value='$product_netto_value', vat='$product_vat', amount='$product_amount', availability_status='$product_availability_status', category='$product_category', size='$product_size'";
    
        if ($product_image !== null) {
            $query .= ", image='$product_image'";
        }
    
        $query .= " WHERE id='$product_id'";
    
        $result = mysqli_query($link, $query);
    
        if($result) {
            header("Location: manage_categories_products.php");
            exit();
        } else {
            echo "Error updating product: " . mysqli_error($link);
        }

         header("Location: manage_categories_products.php"); 
         exit();
    }
    ob_end_flush();
    ?>
</body>
</html>
