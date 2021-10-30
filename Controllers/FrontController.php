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

        $req = new Posts;

        // Récupération de tous les articles
        $posts = $req->findAllPosts();
        
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

        if (!ctype_digit($_GET['id']) or !array_key_exists('id', $_GET)) {
            header('Location: index.php');
            exit();
        }

        $id = intval($_GET['id']);
        $req = new Posts;
        $message = [];
        
        // Récupération des informations liées à l'article
        $post = $req->findPostById($id);
        
        // Récupération des commentaires liés à l'article
        $comments = $req->findAllComments($id);

        // Récupération du total de commentaires liés à l'article
        $total_comments = $req->findTotalComments($id);

        $nickname = null;

        if($_POST) {

            if(empty($_POST['input_comment']) || empty($_POST['input_nickname'])) {
                $message['error'] = "Veuillez remplir les champs ...";
            }
            if(!empty($_POST['input_nickname']) && !empty($_POST['input_comment'])) {

                $nickname = $this->validate($_POST['input_nickname']);
                $comment = $this->validate($_POST['input_comment']);

                $message['success'] = "Commentaire envoyé !";

                $add = $req->addComment($id, $nickname, $comment);
                header('Location: index.php?page=post&id='.$id);
                exit;

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

        $req = new Posts;
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

} // Class end