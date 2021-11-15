<?php

namespace App\Traits;

trait ErrorNotification
{

    public function setErrorNotification(array $errors): void
    {
        $_SESSION['errors'] = $errors;
    }

    private function getErrorNotification(String $key): string
    {
        $message = $_SESSION['errors'][$key];
        unset($_SESSION['errors'][$key]);
        return $message;
    }

    public function checkErrorsNotification(String $key): bool
    {
        if (!empty($_SESSION['errors'][$key])) {
            return true;
        }
        return false;
    }

    public function getInvalidFeedback(String $key): string
    {
        $content = self::checkErrorsNotification($key) ? self::getErrorNotification($key) : '';
        return '<small class="text-danger">'.$content.'</small>';
    }
}