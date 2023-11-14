<?php

require 'functions.php';
require 'Database.php';
// require 'router.php';

$config = require('config.php');

$db = new Database($config['database']);
dd($db->query("SELECT * FROM posts where id > 1")->fetch(PDO::FETCH_ASSOC));
