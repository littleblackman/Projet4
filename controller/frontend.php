<?php
//session_start();
//var_dump(session_start());

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

//verify member
function checkLogin($nickname, $pass){
    $logManager = new LogManager();
    $check = $logManager->logIn($nickname, $pass);
    $checkPass = password_verify($_POST['pass'], $check['pass']);

    if (!$check){
        die("identifiant ou mot de passe incorrect");
    } 
    elseif ($checkPass) {
        $_SESSION['id'] = $check['id'];
        $_SESSION['nickname'] = $check['nickname'];
    } else {
        die("identifiant ou mot de passe incorrect");
    }
}

