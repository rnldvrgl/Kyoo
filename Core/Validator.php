<?php

namespace Core;

class Validator
{
    public static function validate($data)
    {
        $data = trim($data); // Strip spaces sa start at end ng string
        $data = stripslashes($data); // Tanggalin nya yung quotation marks if meron ang nainput na string
        $data = htmlspecialchars($data); // Gawin nya HTML entities mga nakainput

        return $data;
    }

    public static function email($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    // For Login 
    public static function loginPassword($data)
    {
        if (!empty($data)) {
            return $data;
        } else {
            // Password is empty
            $err = 'Password is required!';
            $_SESSION['err'] = $err;

            redirect('../pages/auth/login.php');
        }
    }

    // For Register User
    public static function password($data)
    {
        // code here ...
    }
}
