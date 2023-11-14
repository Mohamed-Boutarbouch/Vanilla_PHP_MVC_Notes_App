<?php

require 'functions.php';
require 'Database.php';
// require 'router.php';

$config = require('config.php');

$db = new Database($config['database']);

$id = $_GET['id'];
$query = "SELECT * FROM posts where id = ?";


dd($db->query($query, [$id])->fetch(PDO::FETCH_ASSOC));
