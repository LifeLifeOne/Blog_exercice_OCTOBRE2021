<?php

namespace App\Services;

use App\Services\ValidationRules;
use App\Services\ValidationManager;
use App\Traits\Notification;

class FormValidator
{

    public static $errors = [];

    public static function isValid($data, $rules)
    {
        $valid = true;
        foreach ($rules as $field => $rule) {
            $rule = explode('|', $rule);
            foreach ($rule as $r) {
                if (!ValidationRules::$r($data[$field])) {
                    self::$errors[$field] = ValidationManager::message($field, $r);
                    $valid = false;
                }
            }
        }
        if ($valid === false) {
            return self::$errors;
        }
        return true;
    }

    public static function secure($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}