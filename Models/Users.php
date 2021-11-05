<?php
namespace App\Models;

use App\Core\Connect;

class Users extends Connect
{
    private $db;

    public function connectionAdmin($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':email' => $email
        ]);
        return $query->fetch();
    }
}