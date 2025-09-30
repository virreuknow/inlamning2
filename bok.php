<?php 
    if ($_SERVER[REQUEST_METHOD] == "POST") {
        
        $name = $_POST["name"];
        $message = $_POST["message"];

        $data = array();
        if (file_exists("data.json")) {
            $data = json_decode(file_get_contents('data.json'), true);
        }


    }

    $json = file_get_contents('data.json');
    $data = json_decode($json, true);

?>

<div class="entry">
    <h1>Gästbok</h1>
    <form action="" method="POST">
        <input class="box" type="text" name="name" placeholder="Namn"><br>
        <input class="button" type="button" placeholder="Skicka"><br>
    </form>
    <div>
        <h2>Comments</h2>
        <div id="comments">
            <?php
            if (!empty($data)) {
                foreach ($data as $item) {
                    echo '<div class="comment">';
                    echo '<p><strong>' . htmlspecialchars($item['name']) . '</strong>: ' . htmlspecialchars($item['message']) . '</p>';
                    if (!empty($item['rname']) || !empty($item['rmessage'])) {
                        echo '<div class="reply">';
                        echo '<p><strong>' . htmlspecialchars($item['rname']) . '</strong>: ' . htmlspecialchars($item['rmessage']) . '</p>';
                        echo '</div>';
                    }
                    echo '</div>';
                }
            } 