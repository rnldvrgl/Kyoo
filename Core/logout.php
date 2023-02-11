<?php
session_start();
session_unset();
session_destroy();

require 'functions.php';

redirect('../pages/auth/login.php');
