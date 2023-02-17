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
        return self::validate($data);
    }

    // Format the user's initial password 
    // ? SYNTAX: initialpassword('Ronald Vergel Dela Cruz');
    // ?  Output: ronald_vergel_dela_cruz (This will be the user's initial password and can be changed by the user themselves on My Profile page once they logged in)
    public static function initialpassword($fullname)
    {
        // Use self to call a static method within the same class
        $fullname = self::validate($fullname);

        $name = strtolower($fullname); // lowercase the string
        $name = str_replace('.', '', $name); // remove period for middle initials (if exists)
        $name = str_replace(' ', '_', $name); // replaced whitespace with underscores

        return $name;
    }
}
