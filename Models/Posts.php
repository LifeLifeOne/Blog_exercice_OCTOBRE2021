<?php
namespace App\Models;

use App\Core\Connect;
use App\Traits\Notification;

class Posts extends Connect
{
    use Notification;
    private $db;

    public function __construct()
    {
        $this->db = new Connect;
    }

    /**
     * INFOS POSTS
     */
    public function findAllPosts() {

        $sql = 'SELECT
                posts.id, title,
                SUBSTRING(content, 1, 200) AS content, firstname, lastname, category,
                DATE_FORMAT(created_at, "%W %e %M %Y") AS created_at

                FROM posts
                INNER JOIN categories ON posts.category_id = categories.id
                INNER JOIN authors ON posts.author_id = authors.id
                ORDER BY created_at DESC
                LIMIT 10';
        
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(); 
    }

    /**
     * CHIFFRE TOTAL DES ARTICLES
     */
    public function findTotalPosts() {

        $sql = 'SELECT COUNT(*) AS total
                FROM posts';

        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    /**
     * SINGLE POST INFOS
     */
    public function findPostById($id) {

        $sql = 'SELECT posts.id, title, content, firstname, lastname, category, category_id, author_id,
                DATE_FORMAT(created_at, "%W %e %M %Y") AS created_at
                FROM posts
                INNER JOIN categories ON posts.category_id = categories.id
                INNER JOIN authors ON posts.author_id = authors.id
                WHERE posts.id = :id';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->fetch(); 
    }

    /** 
     * REQUETE ID AUTEURS
     */
    public function findAuthors() {

        $sql = 'SELECT id, firstname, lastname 
                FROM authors';
        
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
 
    }

    /** 
     * REQUETE CATEGORIES + NOM
     */
    public function findCategories() {

        $sql = 'SELECT id, category 
                FROM categories';
        
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
 
    }

    /**
     * AJOUT D'UN ARTICLE DANS LA BDD
     */
    public function addPost(String $title_post, String $content, int $category_id, int $author_id) {

        $sql = ' INSERT INTO posts 
                (title, content, category_id, author_id)
                VALUES (:title, :content, :category_id, :author_id)';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':title'      => $title_post,
            ':content'    => $content,
            ':category_id'=> $category_id,
            ':author_id'  => $author_id
        ]);
        
    }

    /**
     * UPDATE D'UN ARTICLE DANS LA BDD
     */
    public function updatePost(int $id, String $title_post, String $content, int $category_id, int $author_id) {

        $sql = 'UPDATE posts 
                SET 
                title       = :title,
                content     = :content,
                category_id = :category_id,
                author_id   = :author_id,
                created_at  = NOW() 
                WHERE id    = :id';

        $query = $this->db->prepare($sql);
        $query->execute([
            ':id'         => $id,
            ':title'      => $title_post,
            ':content'    => $content,
            ':category_id'=> $category_id,
            ':author_id'  => $author_id
        ]);
        
    }

    /** 
     * SUPRESSION D'UN ARTICLE DANS LA BDD
     */
    public function deletePost($id) {

        $sql = 'DELETE FROM posts 
                WHERE posts.id = :id';
        
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id'       => $id
        ]);
 
    }

}