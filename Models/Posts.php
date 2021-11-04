<?php
namespace App\Models;

use App\Core\Connect;

class Posts extends Connect
{

    private $db;

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
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll(); 
    }

    /**
     * CHIFFRE TOTAL DES ARTICLES
     */
    public function findTotalPosts() {

        $sql = 'SELECT COUNT(*) AS total
                FROM posts';

        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetch();
    }

    /**
     * SINGLE POST INFOS
     */
    public function findPostById($id) {

        $sql = 'SELECT posts.id, title, content, firstname, lastname, category,
                DATE_FORMAT(created_at, "%W %e %M %Y") AS created_at
                FROM posts
                INNER JOIN categories ON posts.category_id = categories.id
                INNER JOIN authors ON posts.author_id = authors.id
                WHERE posts.id = :id';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->fetch(); 
    }

    /**
     * COMMENTAIRES INFOS
     */
    public function findAllComments($id) {

        $sql = 'SELECT nickname, content, DATE_FORMAT(created_at, "%W %e %M %Y") AS commented_at
                FROM comments
                WHERE post_id = :id
                ORDER BY created_at DESC';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);

        return $query->fetchAll();
 
    }

    /**
     * LE CHIFFRE TOTAL DES COMMENTAIRES LIES A L'ARTICLE
     */
    public function findTotalComments($id) {

        $sql = 'SELECT COUNT(*) as total
                FROM comments
                INNER JOIN posts ON posts.id = comments.post_id
                WHERE posts.id = :id';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
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
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':id'       => $id,
            ':nickname' => $nickname,
            ':comment'  => $comment
        ]);
        
    }

    /** 
     * REQUETE ID AUTEURS
     */
    public function findAuthors() {

        $sql = 'SELECT id, firstname, lastname 
                FROM authors';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
 
    }

    /** 
     * REQUETE CATEGORIES + NOM
     */
    public function findCategories() {

        $sql = 'SELECT id, category 
                FROM categories';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
 
    }

    /**
     * AJOUT D'UN ARTICLE DANS LA BDD
     */
    public function addPost($title, $content, $category_id, $author_id) {

        $sql = ' INSERT INTO posts 
                (title, content, category_id, author_id)
                VALUES (:title, :content, :category_id, :author_id)';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':title'      => $title,
            ':content'    => $content,
            ':category_id'=> $category_id,
            ':author_id'  => $author_id
        ]);
        
    }

    /** 
     * SUPRESSION D'UN ARTICLE DANS LA BDD
     */
    public function deletePost($id) {

        $sql = 'DELETE FROM `posts` 
                WHERE posts.id = :id';
        
        $db    = new Connect;
        $query = $db->prepare($sql);
        $query->execute([
            ':id'       => $id
        ]);
 
    }

}