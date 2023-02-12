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

if (isset($_POST['save-changes'])) {
    $id = Validator::validate($_POST['user_id']);
    $name = Validator::validate($_POST['name']);
    $address = Validator::validate($_POST['address']);
    $phone = Validator::validate($_POST['phone']);
    $about = Validator::validate($_POST['about']);

    // !! CONCERN: If nagpalit sya ng info, di agad magrereflect sa My Profile since nakaSet sa Session Variable yung data na kinuha natin para mag-Display dito sa page na to, magrereflect lang kapag nagLogin sya ulit ng bagong session para maFetch nanaman ng bagong data ang maSet sa new Session Variable
    // ?? POSSIBLE FIX: MAG-QUERY NALANG ULIT
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
    $id = Validator::validate($_POST['user_id']);
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
} else {
    redirect('../pages/departments/user-profile.php');
}
