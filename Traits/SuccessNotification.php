<?php

namespace App\Traits;

trait SuccessNotification
{

    public function setSuccessNotification(String $key, String $message): void
    {
        $_SESSION['success'][$key] = $message;
    }

    private function getSuccessNotification(String $key): string
    {
        $message = $_SESSION['success'][$key];
        unset($_SESSION['success'][$key]);
        return $message;
    }

    public function checkSuccessNotification(String $key): bool
    {
        if (!empty($_SESSION['success'][$key])) {
            return true;
        }
        return false;
    }

    public function getSuccessFeedback(String $key): string
    {
        $content = self::checkSuccessNotification($key) ? self::getSuccessNotification($key) : '';
        return '<small class="text-success">'.$content.'</small>';
    }
}