<?php

use Core\App;

use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);
$validator = App::resolve(Validator::class);

$id = $validator->validate($_POST['id']);

$dept_details = $db->query("SELECT * FROM departments WHERE dept_id = :dept_id", [
    'dept_id' => $id,
])->get();

foreach ($dept_details as $data) {
    $department_details[] = $data;
}

echo json_encode($department_details);
