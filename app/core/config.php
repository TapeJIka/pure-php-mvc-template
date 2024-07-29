<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('ROOT', 'http://localhost/constituency-treeMVC/public');
    // database config
    define('DBNAME', 'dynamic_tree');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
}
/*If true show errors*/
define('DEBUG', true);
