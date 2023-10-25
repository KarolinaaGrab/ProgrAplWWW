<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lab_04</title>
</head>
<body>

    <?php
        // zadanie_1
        $nr_indeksu = '164380';
        $nrGrupy = '2';

        echo "zadanie_1<br/>";
        echo 'Karolina Grabowska '.$nr_indeksu.' grupa '.$nrGrupy .'<br/><br/>';

        // zadanie_2
            
        // a.) include(), require_once()

        include 'ts_albums.php';
        //require_once('ts_albums.php');

        echo "zadanie_2_a<br/>";
        echo "The best ts album $best_one, the most iconic $iconic_one <br/><br/>";

        // b.) if, else, elseif, switch
        echo "zadanie_2_b<br/>";

        $a = 5;
        $b = 2;
        if ($a > $b) {
            echo "a is bigger than b";
        } elseif ($a == $b) {
            echo "a is equal to b";
        } else {
            echo "a is smaller than b";
        }

        echo "<br/>";

        switch ($b) {
            case 0:
                echo "b equals 0";
                break;
            case 1:
                echo "b equals 1";
                break;
            case 2:
                echo "b equals 2";
                break;
        }
        
        echo "<br/><br/>";
        
        // c) while() i for() 
        echo "zadanie_2_c<br/>";

        $i = 1;
        while ($i <= 10) 
                echo $i++ . " ";  
    
        echo "<br/>";
        
        for ($i = 1; $i <= 10; $i++) {
            echo $i . " ";
        }

        echo "<br/><br/>";

         // d) $_GET, $_POST, $_SESSION    //https://www.tutorialspoint.com/php/php_get_post.htm
        echo "zadanie_2_d<br/>";

        

         //GET
         if( isset($_GET["name"]) || isset($_GET["age"]) ) { 
            echo "Welcome ". $_GET['name']. "<br />";
            echo "You are ". $_GET['age']. " years old.";
         }

         //POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            if (empty($name)) {
              echo "Nie podano imienia";
            } else {
              echo $name;
            }
          }

         
        //SESSION
        session_start();

        $_SESSION["favartist"] = "Taylor Swift";
        $_SESSION["favanimal"] = "cat";
        echo "Session variables are set.<br/>";
        echo "Notice that session variables are not passed individually to each new page, 
        instead they are retrieved from the session we open at the beginning of each page 
        (session_start()).<br/><br/>";
        
        
    ?>
        <!--Do GET-->
        <form action = "<?php $_PHP_SELF ?>" method = "GET">
            Name: <input type = "text" name = "name">
            Age: <input type = "text" name = "age">
            <input type = "submit" value="Metoda GET">
        </form>

        <!--Do POST-->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            Name: <input type="text" name="name">
            <input type="submit" value = "Metoda POST">
        </form>
</body>
</html>