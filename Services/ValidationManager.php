<?php

namespace App\Services;

class ValidationManager
{
    private static $messages = [
        'required'    => ' est obligatoire',
        'email'       => ' n\'est pas un email valide',
        'password'    => ' incorrecte',
        'minInput'    => ' doit contenir au moins 3 caractères',
        'maxInput'    => ' doit contenir au plus 30 caractères',
        'minTextarea' => ' doit contenir au moins 5 caractères',
        'maxTextarea' => ' doit contenir au plus 1000 caractères'
    ];
    
    public static function message(string $field, string $rule): string
    {
        return $field.self::$messages[$rule];
    }
}