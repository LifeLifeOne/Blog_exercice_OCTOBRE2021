<?php

namespace App\Services;

class ValidationRules
{
    
    public static function required(string $field): bool
    {
        return trim($field) == '' ? false : true;
    }

    public static function email(string $field): bool
    {
        return filter_var($field, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    public static function password(string $field): bool
    {
        $field = preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $field);
        return $field ? true : false;
    }

    public static function passwordConfirm(string $field, string $field2): bool
    {
        return $field == $field2 ? true : false;
    }

    public static function passwordVerify(string $field, string $field2): bool
    {
        return password_verify($field, $field2) ? true : false;
    }

    public static function phone(string $field): bool
    {
        return preg_match("/^[0-9]{10}$/", $field) ? true : false;
    }

    public static function minInput(string $field): bool
    {
        return strlen($field) < 3 ? false : true;
    }

    public static function maxInput(string $field): bool
    {
        return strlen($field) > 30 ? false : true;
    }

    public static function minTextarea(string $field): bool
    {
        return strlen($field) < 5 ? false : true;
    }

    public static function maxTextarea(string $field): bool
    {
        return strlen($field) > 1000 ? false : true;
    }
}