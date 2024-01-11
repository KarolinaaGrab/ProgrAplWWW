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
    <title>Manage Subpages</title>
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
            echo ListaPodstron($link);

            echo EdytujPodstrone();
             
            if(isset($_POST['btn-edit'])){
                $page_id = $_POST['p_id'];
                $title = $_POST['page_title']; 
                $content = $_POST['page_content']; 
                if(isset($_POST['p_status'])) { 
                    $status = $_POST['p_status']; 
                } else {
                    $status = 0; 
                }
            
                $query = "SELECT * FROM page_list WHERE id='$page_id'"; 
                $result = mysqli_query($link, $query);
            
                if(mysqli_num_rows($result) == 1) {
                    $row = mysqli_fetch_array($result); 
                    $existing_title = $row['page_title']; 
                    $existing_content = $row['page_content']; 
                    if ($existing_title == $title && $existing_content == $content) { 
                        echo "Podstrona o podanym tytule i zawartości już istnieje.";
                    } elseif ($existing_title == $title) { 
                        $query = "UPDATE page_list SET page_content='$content', status='$status' WHERE id='$page_id'";
                        $result = mysqli_query($link, $query);
                        echo "Zawartość strony została zmieniona.";
                    } elseif ($existing_content == $content) { 
                        $query = "UPDATE page_list SET page_title='$title', status='$status' WHERE id='$page_id'";
                        $result = mysqli_query($link, $query);
                        echo "Tytuł strony został zmieniony.";
                    } else { 
                        $query = "UPDATE page_list SET page_title='$title', page_content='$content', status='$status' WHERE id='$page_id'";
                        $result = mysqli_query($link, $query);
                    }
                }
    
                header("Location: manage_subpages.php");
                exit(); 
            }
    
    
            echo StworzPodstrone();
    
            if(isset($_POST['btn-create'])){
                $page_title = $_POST['page_title'];
                $page_content = $_POST['page_content'];
                $status = $_POST['p_status'];
                if ($status) 
                    $active_status = 1;
                else 
                    $active_status = 0;
    
                $query = "INSERT INTO page_list (page_title, page_content, status) VALUES ('".$page_title."', '".$page_content."', '".$active_status."')"; 
                mysqli_query($link, $query); 
    
                header("Location: manage_subpages.php"); 
                exit(); 
            }
    
            echo UsunPodstrone(); 
    
            if(isset($_POST['btn-delete'])){ 
                $page_id = $_POST['p_id']; 
                $query = "DELETE FROM page_list WHERE id = '".$page_id."'"; 
                mysqli_query($link, $query);
    
                header("Location: manage_subpages.php");
                exit(); 
            }
    
    ?>
</body>
</html>
