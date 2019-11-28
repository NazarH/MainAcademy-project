<?php
require "libs/rb.php";
R::setup( 'mysql:host=127.0.0.1; port=3306;dbname=pcnews',
        'root');

session_start();
?>