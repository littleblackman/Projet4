<?php
require_once('model\PostManager.php');
require_once('model\CommentManager.php');
require_once('model\LogManager.php');

function listPosts(){
    $postManager = new PostManager();
    $posts = $postManager->getPosts();
   
    require('view\frontend\view.php');
}

function post(){
    $postManager = new PostManager();
    $commentManager = new CommentManager();
    
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view\frontend\postView.php');
}

function addComment($postId, $author, $comment){
    $commentManager = new CommentManager();
    $addComment = $commentManager->postComment($postId, $author, $comment);

    if ($addComment === false){
        die("Erreur d'ajout du commentaire");
    } else{
        header("Location: index.php?action=post&id=" . $postId);
    }
}

// pour ajouter un post
function addPost($title, $content){
    $postManager = new PostManager();
    $addPost = $postManager->newPost($title, $content);

    if ($addPost === false){
        die("Erreur d'ajout du billet");
    } else{
        header("Location: index.php");
    }
 }


// login
function checkLog($nickname){
    $logManager = new LogManager();
    $checkLog = $logManager->logIn($nickname);
    
    $checkPass = password_verify($_POST['pass'], $checkLog['pass']);

    if(!$checkLog){
        echo "identifiant ou mot de passe incorrect";
    } else {
        if($checkPass){
            session_start();
            $_SESSION['id'] = $checkLog['id'];
            $_SESSION['nickname'] = $checkLog['nickname'];
            echo "bien!";
            header("Location: index.php");
        } else {
            echo "tu y arrivera, mais c'est pas ça !";
        }
    }
 }
