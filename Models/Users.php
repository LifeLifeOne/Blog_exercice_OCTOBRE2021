<?php
namespace App\Models;

use App\Core\Connect;

class Users extends Connect
{
    private $db;

    public function __construct()
    {
        $this->db = new Connect;
    }

    public function connectionAdmin($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";

        $query = $this->db->prepare($sql);
        $query->execute([
            ':email' => $email
        ]);
        return $query->fetch();
    }
}