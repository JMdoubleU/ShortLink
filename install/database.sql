CREATE DATABASE IF NOT EXISTS shortlink; # Should match line 5 of config.php
USE shortlink; # Should match line 5 of config.php

CREATE TABLE IF NOT EXISTS links (
    id int UNSIGNED NOT NULL AUTO_INCREMENT,
    identifier char(6) NOT NULL,
    url varchar(1024) NOT NULL,
    PRIMARY KEY (id)
);