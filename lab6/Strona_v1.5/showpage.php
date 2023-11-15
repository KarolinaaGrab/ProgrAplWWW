<?php

include 'cfg.php';

function showSubPage($id)
{
    global $link; 

    $id_clear = htmlspecialchars($id);

    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    if (empty($row['id'])) {
        $web = '[no page found]';
    } else {
        $web = $row['page_content'];
    }

    return $web;
} 
?>
