<?php

namespace App\Models;

use App\Core\Connect;
use App\Traits\Notification;

class Comments extends Connect
{
    use Notification;
    private $db;

    public function __construct()
    {
        $this->db = new Connect;
    }

    /**
     * COMMENTAIRES INFOS
     */
    public function findAllComments($id) {

        $sql = 'SELECT nickname, content, DATE_FORMAT(created_at, "%W %e %M %Y") AS commented_at
                FROM comments
                WHERE post_id = :id
                ORDER BY created_at DESC';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->fetchAll();
 
    }

    /**
     * LE NOMBRE TOTAL DE COMMENTAIRES LIES A L'ARTICLE
     */
    public function findTotalComments($id) {

        $sql = 'SELECT COUNT(*) as total
                FROM comments
                INNER JOIN posts ON posts.id = comments.post_id
                WHERE posts.id = :id';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->fetch();
 
    }

    /**
     * AJOUT D'UN COMMENTAIRE DANS LA BDD
     */
    public function addComment($id, $nickname, $comment) {

        $sql = 'INSERT INTO comments
                (post_id, nickname, content)
                VALUES
                (:id, :nickname, :comment)';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id'       => $id,
            ':nickname' => $nickname,
            ':comment'  => $comment
        ]);
        
    }
}