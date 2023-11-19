<?php

use Core\Database;
use Core\Validator;

$config = require basePath('config.php');
$db = new Database($config['database']);

$errors = [];


if (!Validator::string($_POST['body'], 1, 1_000)) {
  $errors['body'] = 'A body of no more than 1,000 characters is required.';
}

if (!empty($errors)) {
  return view('notes/create.view.php', [
    'heading' => 'Create Note',
    'errors' => $errors
  ]);
}

$db->query('INSERT INTO notes(body, user_id) VALUES (:body, :user_id)', [
  'body' => $_POST['body'],
  'user_id' => 1
]);

header('location: /notes');
die();
