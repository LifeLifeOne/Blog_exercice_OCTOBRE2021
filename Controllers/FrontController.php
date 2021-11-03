<?php 
namespace App\Controllers;

use App\Core\ {Connect, Https};
use App\Models\Posts;

class FrontController 
{

    /**
     * FONCTION RENDER 
     */
    public function render(string $path, $array = []) {

        extract($array);
        $path = $path.".phtml";
        require '../Template/template.php';
    }

    /**
     * FONCTION QUI SECURISE LES ENTREES D'INPUTS / TEXTAREAS
     */
    public function validate($data) {

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        
        return $data;
    }

    /**
     * FONCTION 'DD' QUI REMPLACE LE VAR_DUMP
     */
    public function dd($data) {
        echo '<pre 
        style="color: maroon;
        font-size: 1.4rem;">';
        var_dump($data);
        echo '</pre>';
        die;
    }

    /**
     * HOME PAGE
     */
    public function home() {

        $req   = new Posts;
        $posts = $req->findAllPosts();// Récupération de tous les articles
        
        $title = "Blog - Page d'accueil";
        $this->render('home/home', [
            'title' => $title,
            'posts' => $posts
        ]);
    }

    /**
     * POST PAGE
     */
    public function post() {
        $message = [];
        $nickname = null;

        if (!ctype_digit($_GET['id']) || !array_key_exists('id', $_GET)) {
            Https::redirect('index.php');
        }

        $id             = intval($_GET['id']);
        $req            = new Posts;
        $post           = $req->findPostById($id);// Récupération des informations liées à l'article
        $comments       = $req->findAllComments($id);// Récupération des commentaires liés à l'article
        $total_comments = $req->findTotalComments($id);// Récupération du total de commentaires liés à l'article


        if($_POST) {

            $isValid = true; 
            $nickname = $this->validate($_POST['nickname']);
            $comment  = $this->validate($_POST['comment']);

            if(strlen($nickname) == 0) {
                $isValid = false;
                $message['error'] = "Veuillez renseigner un pseudo ...";
            }

            if(strlen($comment) == 0) {
                $isValid = false;
                $message['error'] = "Veuillez mettre un commentaire ...";
            }
            if($isValid) {
                $add = $req->addComment($id, $nickname, $comment);
                $message['success'] = "Commentaire envoyé !";
                Https::redirect('index.php?page=post&id='.$id);
            }
            
        }
        
        $title = "Article - ".$post['title'];
        $this->render('post/post', [
            'title'          => $title,
            'id'             => $id,
            'post'           => $post,
            'comments'       => $comments,
            'total_comments' => $total_comments,
            'message'        => $message,
            'nickname'       => $nickname
        ]);
    }

    /**
     * PAGE D'ADMINISTRATION
     */
    public function admin() {

        $req   = new Posts;
        $posts = $req->findAllPosts();
        $total = $req->findTotalPosts();
        // $this->dd($total);

        $title = "Panel d'administration";
        $this->render('admin/admin', [
            'title' => $title,
            'posts' => $posts,
            'total' => $total
        ]);

    }

    /**
     * PAGE DE SUPPRESSION D'ARTICLE
     */
    public function delete() {

        if (!ctype_digit($_GET['id']) || !array_key_exists('id', $_GET)) {
            Https::redirect('index.php');
        }

        $id     = intval($_GET['id']);
        $req    = new Posts;
        $action = $req->deletePost($id);

        Https::redirect('index.php?page=admin');

    }

    /**
     * PAGE D'EDITION D'ARTICLE
     */
    public function edit() {
        $message = [];

        if (!ctype_digit($_GET['id']) || !array_key_exists('id', $_GET)) {
            Https::redirect('index.php');
        }

        $id         = intval($_GET['id']);
        $req        = new Posts;
        $post       = $req->findPostById($id);// Récupération des informations liées à l'article
        $categories = $req->findAllPosts();// Récupération de tous les articles

        if($_POST) {
            $isValid = true;
            $author  = $this->validate($_POST['author']);
            $title   = $this->validate($_POST['title']);
            $content = $this->validate($_POST['content']);
            
            if(strlen($author) == 0) {
                $isValid = false;
                $message['error']['author'] = "Vous devez renseigner un auteur";
            }

            if(strlen($title) == 0) {
                $isValid = false;
                $message['error']['title'] = "Vous devez renseigner un titre d'article";
            }
            if(strlen($content) == 0) {
                $isValid = false;
                $message['error']['content'] = "Vous devez ecrire du contenu";
            }
            if(strlen($content) < 1 || strlen($content) > 10000) {
                $isValid = false;
                $message['error']['content'] = "L'article doit faire entre 100 et 10 000 caractères";
            }
            if($isValid){
                $message['success'] = "L'article à bien été modifié !";
                // UPDATE DE L'ARTICLE
            }
        }


        $title = "Modification article - ".$post['id'];
        $this->render('admin/edit', [
            'id'         => $id,
            'title'      => $title,
            'post'       => $post,
            'categories' => $categories,
            'message'    => $message
        ]);

    }

    /**
     * PAGE CREATION D'ARTICLE
     */
    public function create() {
        $message = [];

        $req        = new Posts;
        $authors    = $req->findAuthors(); // Récupération des auteurs
        $categories = $req->findCategories(); // Récupération des catégories
        
        if($_POST) {
            $isValid     = true;
            $title       = $this->validate($_POST['title']);
            $content     = $this->validate($_POST['content']);
            $category_id = $this->validate($_POST['category']);
            $author_id   = $this->validate($_POST['author']);
            
            if(strlen($title) == 0) {
                $isValid = false;
                $message['error']['title'] = "Vous devez renseigner un titre d'article";
            }
            if(strlen($content) == 0) {
                $isValid = false;
                $message['error']['content'] = "Vous devez ecrire du contenu";
            }
            if(strlen($content) < 1 || strlen($content) > 10000) {
                $isValid = false;
                $message['error']['content'] = "L'article doit faire entre 100 et 10 000 caractères";
            }
            if($isValid){
                $message['success'] = "L'article à bien été enregistré !";
                $action = $req->addPost($title, $content, $category_id, $author_id);
            }

        }

        $title = "Creér un article";
        $this->render('admin/create', [
            'title'      => $title,
            'authors'    => $authors,
            'categories' => $categories,
            'message'    => $message
        ]);

    }

} // Class end