<?php

namespace src\Controllers;

use src\Models\Comments\Comment;
use src\View\View;

class CommentController{
    private $view;

    public function __construct(){
        $this->view = new View();
    }

    public function store()
    {
        $comment = new Comment();
        $comment->setText($_POST['text']);
        $comment->setArticleId($_POST['article_id']);
        $comment->setAuthorId(1);
        $comment->save();
        return header('Location:http://127.0.0.1/php-sivova/project/www/article/' . $_POST['article_id']);
    }

    public function show($id){
        $comment = Comment::getById($id);
        if ($comment == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('comment/show', ['comment'=>$comment]);
    }

    public function create($articleId){
        $this->view->renderHtml('comment/create', ['articleId' => $articleId]);
    }

    public function edit($id){
        $comment = Comment::getById($id);
        if ($comment == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $this->view->renderHtml('comment/edit', ['comment' => $comment]);
    }

    public function update($id)
    {
        $comment = Comment::getById($id);
        if ($comment == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $comment->setText($_POST['text']);
        $comment->save();
        return header('Location:http://127.0.0.1/php-sivova/project/www/article/' . $comment->getArticleId());
    }

    public function delete($id)
    {
        $comment = Comment::getById($id);
        if ($comment == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        $articleId = $comment->getArticleId();
        $comment->delete();
        return header('Location:http://127.0.0.1/php-sivova/project/www/article/' . $articleId);
    }
}