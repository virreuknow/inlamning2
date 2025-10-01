<?php 
// Läs in de som redan finns 
$data = [];
if (file_exists("data.json")) {
    $data = json_decode(file_get_contents("data.json"), true);
}

// Hantera formulärinlägg
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $message = $_POST["message"]; //ska kanske senare ta bort utrymme(whitespace) i början och slutet, "    något.   " blir "något."

    if ($name !== "" && $message !== "") {
        // Lägg till nytt inlägg
        $data[] = [
            "name" => $name,
            "message" => $message
        ];

        // Spara tillbaka till filen
        file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT)); //fick inte det att funka utan JSON_PRETTY_PRINT, AI fick hjälpa lite där tyvärr
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <title>Gästbok</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        input, textarea { width: 300px; margin-bottom: 10px; padding: 5px; }
        textarea { height: 80px; }
        .comment { border-bottom: 1px solid #ccc; padding: 5px 0; }
    </style>
</head>
<body>
    <h1>Gästbok</h1>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Namn" required><br>
        <textarea name="message" placeholder="Meddelande" required></textarea><br>
        <input type="submit" value="Skicka">
    </form>

    <h2>Kommentarer</h2>
    <div id="comments">
        <?php
        if (!empty($data)) {
            // Visa nyaste kommentarer överst
            $comments = array_reverse($data);
            foreach ($comments as $item) {
                echo '<div class="comment">';
                echo "<p><strong>" . htmlspecialchars($item['name']) . ":</strong> " . htmlspecialchars($item['message']) . "</p>";
                echo '</div>';
            }
        } else {
            echo "<p>Inga kommentarer ännu.</p>";
        }
        ?>
    </div>
</body>
</html>
