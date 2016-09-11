<?php
    require_once("../database.php");

    $data = file_get_contents("database.sql");

    header("Content-Type: text/plain");

    $sql = "";
    foreach (explode("\n", $data) as $line) {
        $sql .= $line;
        if (strpos($sql, ";") !== false) {
            query($sql);
            $sql = "";
        }
    }
    die("Database created.");
?>