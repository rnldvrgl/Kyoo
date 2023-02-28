<?php

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

$id = $validator->validate($_POST['id']);

// Query to Delete a note
$db->query('DELETE FROM departments WHERE dept_id = :dept_id', [
    'dept_id' => $id,
]);

$_SESSION['msg'] = "Department has been deleted successfully!";
$_SESSION['alert_type'] = "alert-danger";
redirect('/departments');
