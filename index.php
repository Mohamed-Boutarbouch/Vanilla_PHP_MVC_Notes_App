<?php

require "functions.php";
require "Database.php";
// require "router.php";

$db = new Database();
dd($db->query("SELECT * FROM posts where id > 1")->fetch(PDO::FETCH_ASSOC));
