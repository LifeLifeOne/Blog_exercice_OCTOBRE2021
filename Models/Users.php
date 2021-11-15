<?php
namespace App\Models;

use App\Core\Connect;
use App\Traits\Notification;
class Users extends Connect
{
    use Notification;
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