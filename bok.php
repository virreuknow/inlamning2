<?php 
    if ($_SESSION[REQUEST_METHOD] == "POST") {
        
        $name = $_POST["name"];
        $message = $_POST["message"];

        $data = array();
        if (file_exists("data.json")) {
            $data = json_decode(file_get_contents('data.json'), true);
        }
    }