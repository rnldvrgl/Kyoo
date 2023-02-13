<?php
session_start();
session_unset();
session_destroy();

require 'functions.php';
$_SESSION['msg'] = "Logged out successfully!";

redirect('../pages/auth/login.php');
