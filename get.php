<?php
require_once("database.php");
require_once("config.php");

if (isset($_GET['identifier'])) {
    $identifier = $_GET['identifier'];
    $result = query(sprintf("SELECT * FROM links WHERE identifier='%s'", clean($identifier)));
    if (mysql_num_rows($result) !== 1) {
        die($config['lang']['ERR_GET_NOT_FOUND']);
    }
    $row = mysql_fetch_assoc($result);
    header("Location: " . $row['url']);
    die();
} else {
    die($config['lang']['ERR_GET_NO_IDENTIFIER']);
}
?>