<?php

namespace App\Services;

class ValidationManager
{
    private static $messages = [
        'required' => ' est obligatoire',
        'email'    => ' n\'est pas un email valide',
        'password' => ' doit contenir au moins un chiffre et une majuscule',
        'min'      => ' doit contenir au moins 3 caractères',
        'max'      => ' doit contenir au plus 30 caractères'
    ];
    
    public static function message(string $field, string $rule): string
    {
        return $field.self::$messages[$rule];
    }
}