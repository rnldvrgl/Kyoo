<?php

namespace Core;

class Validator
{
    // For General Validation
    public static function validate($data)
    {
        $data = strip_tags($data); // Remove HTML/php tags
        $data = stripslashes($data); // Removes slashes
        $data = preg_replace('~^[\'"]?(.*?)[\'"]?$~', '$1', $data); // Replace double quotes
        $data = trim($data); // Strip spaces at the start and end of the string
        $data = htmlspecialchars($data); // Gawin nya HTML entities mga nakainput

        return $data;
    }

    // For Email Validation
    public static function email($data)
    {
        return filter_var($data, FILTER_VALIDATE_EMAIL);
    }

    // For Login 
    public static function loginPassword($data)
    {
        if (!empty($data)) {
            // Use self to call a static method
            return self::validate($data);
        } else {
            // Password is empty
            $err = 'Password is required!';
            $_SESSION['err'] = $err;

            redirect('../pages/auth/login.php');
        }
    }

    // For CRUD Users
    public static function password($data)
    {
        // Use self to call a static method
        $data = self::validate($data);
    }
}
