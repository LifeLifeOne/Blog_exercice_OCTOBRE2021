<?php

namespace App\Services;

class ValidationManager
{
    private static $messages = [
        'required'        => 'Le champ est obligatoire',
        'email'           => 'L\'email n\'est pas valide',
        'password'        => 'Mot de passe incorrecte',
        'passwordConfirm' => 'Les mots de passe ne correspondent pas',
        'passwordVerify'  => 'Connexion refusée !',
        'minInput'        => 'Le champ doit contenir au moins 3 caractères',
        'maxInput'        => 'Le champ doit contenir au plus 30 caractères',
        'minTextarea'     => 'Le champ doit contenir au moins 5 caractères',
        'maxTextarea'     => 'Le champ doit contenir au plus 1000 caractères'
    ];
    
    public static function message(string $field, string $rule): string
    {
        return self::$messages[$rule];
    }
}