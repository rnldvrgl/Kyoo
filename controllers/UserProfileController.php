<?php
// * For Login Process

session_start();

use Core\Validator;
use Core\Database;

require '../Core/functions.php';

// Validator Class
require base_path('Core/Validator.php');

// Database Class
require base_path('Core/Database.php');

// require connection to the database
$config = require base_path('config/connection.php');

// instantiate the database
$db = new Database($config['database']);

// TODO: SEE UPDATE FEATURE ON DepartmentsController.php

if (isset($_POST['save-changes'])) {
    $id = Validator::validate($_POST['user_id']);
    $name = Validator::validate($_POST['name']);
    $address = Validator::validate($_POST['address']);
    $phone = Validator::validate($_POST['phone']);
    $about = Validator::validate($_POST['about']);

    if (empty($name) || empty($address) || empty($about) || empty($phone)) {
        $_SESSION['profile_msg'] = "Fields are empty!";
        $_SESSION['alert_type'] = "alert-warning";
        redirect('../pages/departments/user-profile.php');
    } else {
        // Update a user data on account_details table
        $db->query('UPDATE account_details SET name = :name, address = :address, phone = :phone, about = :about WHERE user_id = :id', [
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'about' => $about,
            'id' => $id
        ]);

        $_SESSION['profile_msg'] = "Profile updated successfully!";
        $_SESSION['alert_type'] = "alert-success";
        redirect('../pages/departments/user-profile.php');
    }
} else if (isset($_POST['change-password'])) {
    $id = Validator::validate($_POST['login_id']);
    $password = Validator::validate($_POST['password']);
    $newpassword = Validator::validate($_POST['newpassword']);
    $renewpassword = Validator::validate($_POST['renewpassword']);

    // Fetch current password in account_login table to compare with the entered password
    $current_password = $db->query('SELECT password FROM account_login WHERE login_id = :id', [
        'id' => $id,
    ])->get();

    foreach ($current_password as $cp) {
        $current_password = $cp['password'];
    }

    // Verify if the entered password matches the current password stored in account_login table
    $passwordCheck = password_verify($password, $current_password);

    // Verification == TRUE
    if ($passwordCheck !== FALSE) {
        // Check if the New Password and Re-enter New Password fields match
        if ($newpassword == $renewpassword) {
            // If they are the same, hash the new password
            $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

            // Update the user's password on account_login table
            $db->query('UPDATE account_login SET password = :password WHERE login_id = :id', [
                'password' => $hashed_password,
                'id' => $id
            ]);

            // Message and redirect
            $_SESSION['profile_msg'] = 'Set New Password successfully!';
            $_SESSION['alert_type'] = "alert-success";
            redirect('/../Kyoo/pages/departments/user-profile.php');
        } else {
            // If New Password and Re-enter New Password fields do not match
            $_SESSION['profile_msg'] = 'New Password and Re-Enter New Password fields do not match!';
            $_SESSION['alert_type'] = "alert-danger";
            redirect('/../Kyoo/pages/departments/user-profile.php');
        }
    }
    // Verification == FALSE
    else {
        $_SESSION['profile_msg'] = 'Current Password does not match the password in the Database!';
        $_SESSION['alert_type'] = "alert-danger";
        redirect('/../Kyoo/pages/departments/user-profile.php');
    }
} else if (isset($_POST['add-account'])) {
    // Sanitize and Validate Inputs
    $full_name = Validator::validate($_POST['full_name']);
    $email = Validator::email($_POST['email']);
    $dept_id = Validator::validate($_POST['department']);
    $role_id = Validator::validate($_POST['role']);

    // Fetch Department Name based on dept_id
    $department = $db->query('SELECT * FROM departments WHERE dept_id = :dept_id', [
        'dept_id' => $dept_id,
    ])->get();

    foreach ($department as $dept) {
        $dept_name = $dept['dept_name']; // This is used for the user's initial password
    }

    // Set Initial values for other fields
    $password = Validator::initialpassword($full_name); // See Validator.php initialpassword() method for the details on how this is handled
    $address = Validator::validate('Enter your own address here.');
    $phone = Validator::validate('09123456789');
    $about = Validator::validate('Welcome to Kyoo! Feel free to change your information. Always remember your email address and password. Do not forget to change your password. Your initial password will be the first word of your first name in lowercase, an underscore, and your department in lowercase (e.g. ronald_registrar) so better change your password.');

    // Check if fullname and email fields are not empty
    if (!empty($full_name) || !empty($email)) {
        // Fetch email address to check if email address is already in database
        $account_login = $db->query('SELECT * FROM account_login WHERE email = :email', [
            'email' => $email,
        ])->get();

        // Count the number of rows returned by the database query
        $count = count($account_login);

        if ($count > 0) {
            $_SESSION['msg'] = "Email Address already taken!";
            $_SESSION['alert_type'] = "alert-danger";
            redirect('../pages/departments/main-admin/accounts.php');
        } else {
            // Insert Query to account_details table
            $db->query('INSERT INTO account_details(name, address, phone, about) VALUES (:name, :address, :phone, :about)', [
                'name' => $full_name,
                'address' => $address,
                'phone' => $phone,
                'about' => $about,
            ]);

            // Fetch the last id inserted into account_details table
            $account_details_last_inserted_id = $db->lastInsertedID();

            // Encrypt password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert Query to account_login table
            $db->query('INSERT INTO account_login(email, password) VALUES (:email, :password)', [
                'email' => $email,
                'password' => $hashed_password
            ]);

            $account_login_last_inserted_id = $db->lastInsertedID();

            // Insert to accounts table (role_id, user_id, login_id, dept_id)
            $db->query('INSERT INTO accounts(role_id, user_id, login_id, dept_id) VALUES (:role_id, :user_id, :login_id, :dept_id)', [
                'role_id' => $role_id,
                'user_id' => $account_details_last_inserted_id,
                'login_id' => $account_login_last_inserted_id,
                'dept_id' => $dept_id,
            ]);

            $_SESSION['msg'] = "Account added successfully!";
            $_SESSION['alert_type'] = "alert-success";
            redirect('../pages/departments/main-admin/accounts.php');
        }
    } else {
        // If fields are empty, redirect to accounts page
        $_SESSION['msg'] = "There are missing required fields!";
        $_SESSION['alert_type'] = "alert-danger";
        redirect('../pages/departments/main-admin/accounts.php');
    }
} else if ($_POST['action'] == "Fetch") {
    // For Fetching Account data
    $account_id = Validator::validate($_POST['id']);

    // Query to fetch all user-related information from the database
    $account_details = $db->query("SELECT * FROM accounts as acc JOIN account_details as ad ON acc.user_id = ad.user_id JOIN account_login as al ON acc.login_id = al.login_id JOIN account_role as ar ON acc.role_id = ar.role_id JOIN departments as d ON acc.dept_id = d.dept_id WHERE account_id = :account_id", [
        'account_id' => $account_id,
    ])->get();

    // Loop through all user-related information and store them in an arr
    foreach ($account_details as $data) {
        $accountArr[] = $data;
    }

    // Make it into a JSON string
    echo json_encode($accountArr);
} else if ($_POST['action'] == "Update") {
    // * Get the formData string from $_POST
    $formData = $_POST['formData'];

    // * Parse the formData string into an associative array
    $data = array();
    parse_str($formData, $data);

    // * Data from the formData array
    $account_id = Validator::validate($data['id']);
    $full_name = Validator::validate($data['full_name']);
    $email = Validator::email($data['email']);
    $dept = Validator::validate($data['department']);
    $role = Validator::validate($data['role']);

    // * Fetch all IDs on accounts table
    $ids = $db->query("SELECT * FROM accounts WHERE account_id = :account_id", [
        'account_id' => $account_id,
    ])->get();

    foreach ($ids as $id) {
        $user_id = $id['user_id'];
        $login_id = $id['login_id'];
        $role_id = $id['role_id'];
        $dept_id = $id['dept_id'];
    }

    // * Update Query for account_details table
    $db->query('UPDATE account_details SET name = :name WHERE user_id = :user_id', [
        'name' => $full_name,
        'user_id' => $user_id
    ]);

    // * Update Query for account_login table
    $db->query('UPDATE account_login SET email = :email WHERE login_id = :login_id', [
        'email' => $email,
        'login_id' => $login_id
    ]);

    // * Update Query for accounts table
    $db->query('UPDATE accounts SET role_id = :role_id, dept_id = :dept_id WHERE account_id = :account_id', [
        'role_id' => $role,
        'dept_id' => $dept,
        'account_id' => $account_id
    ]);

    // Message
    $_SESSION['msg'] = "Account updated successfully!";
    $_SESSION['alert_type'] = 'alert-success';

    // No redirect since AJAX request i2 hehe
} else if ($_GET['action'] == 'Delete') {
    // account_id on accounts table
    $id = Validator::validate($_GET['id']);

    // Fetch all ids in accounts table
    $ids = $db->query('SELECT * FROM accounts WHERE account_id = :account_id', [
        'account_id' => $id
    ])->get();

    // Loop though ids take user_id and login_id
    foreach ($ids as $id) {
        $user_id = $id['user_id'];
        $login_id = $id['login_id'];
    }

    // Delete from account_details table
    $db->query('DELETE FROM account_details WHERE user_id = :user_id', [
        'user_id' => $user_id,
    ]);

    // Delete from account_login table
    $db->query('DELETE FROM account_login WHERE login_id = :login_id', [
        'login_id' => $login_id,
    ]);

    // Delete from accounts table
    $db->query('DELETE FROM accounts WHERE account_id = :account_id', [
        'account_id' => $id,
    ]);

    // Message
    $_SESSION['msg'] = "User has been deleted successfully!";
    $_SESSION['alert_type'] = "alert-danger";

    // Redirect
    redirect('../pages/departments/main-admin/accounts.php');
} else {
    redirect('../pages/departments/user-profile.php');
}
