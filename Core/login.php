<?php
// * For Login Process

session_start();

use Core\Validator;
use Core\Database;

require 'functions.php';

// Validator Class
require 'Validator.php';

// Database Class
require 'Database.php';

// require connection to the database
$config = require '../config/connection.php';

// instantiate the database
$db = new Database($config['database']);

if (isset($_POST['submit'])) {

    $email = Validator::email($_POST['email']);
    $password = Validator::validate($_POST['password']);
    $escapedPassword = Validator::loginPassword($password);

    // dd($escapedPassword);

    if (!empty($email) && !empty($escapedPassword)) {

        // Get the login_id 
        $account_login = $db->query('SELECT * FROM account_login WHERE email = :email', [
            'email' => $email,
        ])->get();

        $count = count($account_login);

        if ($count !== 0) {
            foreach ($account_login as $data) {
                $login_id = $data['login_id'];
                $passwordCheck = password_verify($escapedPassword, $data['password']);
            }

            // Get the user's account_id from accounts table
            $accounts = $db->query('SELECT * FROM accounts WHERE login_id = :login_id', [
                'login_id' => $login_id,
            ])->get();

            foreach ($accounts as $account) {
                $user_id = $account['user_id'];
                $role_id = $account['role_id'];
                $dept_id = $account['dept_id'];
            }

            // Get the user's details
            $account_details = $db->query('SELECT * FROM account_details WHERE user_id = :user_id', [
                'user_id' => $user_id,
            ])->get();

            // Get the user's role
            $account_role = $db->query('SELECT * FROM account_role WHERE role_id = :role_id', [
                'role_id' => $role_id,
            ])->get();

            // Get the user's department
            $department = $db->query('SELECT * FROM departments WHERE dept_id = :dept_id', [
                'dept_id' => $dept_id,
            ])->get();

            // Store all of the user related information into an array
            $info = array(
                'account_login' => $account_login,
                'accounts' => $accounts,
                'account_details' => $account_details,
                'account_role' => $account_role,
                'department' => $department,
            );

            // dd($info);

            if ($passwordCheck !== FALSE) {
                $_SESSION['sid'] = session_id();
                $_SESSION['user_info'] = $info;
                redirect('secure-page.php');
            } else {
                $_SESSION['err'] = 'Op op op op yung Mali nanaman!';
                redirect('../pages/auth/login.php');
            }
        } else {
            // If no email address found, redirect to login page
            $_SESSION['err'] = 'Mali yan!';
            redirect('../pages/auth/login.php');
        }
    } else {
        redirect('../pages/auth/login.php');
    }
}
