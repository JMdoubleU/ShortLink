<?php
require_once("database.php");
require_once("config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['url'])) {
        $url = $_POST['url'];
        
        header('Content-Type: application/json');

        if (!validateURL($url)) {
            die(json_encode(array("status" => "0", "message" => $config['lang']['ERR_CREATE_BAD_URL'])));
        }

        //check if already exists in DB
        $result = query(sprintf("SELECT * FROM links WHERE url='%s'", clean($url)));
        if (mysql_num_rows($result) !== 0) {
            $row = mysql_fetch_assoc($result);
            die($row['identifier']);
        }
        
        $identifier = generateIdentifier();
        insert("links", array("identifier" => $identifier, "url" => $url));

        die(json_encode(array("status" => "1", "message" => $identifier)));
    } else {
        die($config['lang']['ERR_CREATE_NO_URL']);
    }
} else {
    header("Location: index.php");
    die();
}

function generateIdentifier() {
    $identifier = "";
    $charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    for ($i = 0; $i < 6; $i++) {
        $identifier .= $charset[rand(0, strlen($charset)-1)];
    }
    return $identifier;
}

function validateURL($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

?>