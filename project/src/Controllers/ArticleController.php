<?php

namespace src\Controllers;
use src\View\View;
use src\Models\Articles\Article;

class ArticleController
{
    private $view;
    private $db;
    public function __construct()
    {
        $this->view = new View;  
    }

    public function index(){
        $articles = Article::findAll();
        $this->view->renderHtml('article/index', ['articles'=>$articles]);
    }

    public function show($id){
        $article = Article::getById($id);
        if ($article == []) 
        {
            $this->view->renderHtml('error/404', [], 404);
            return;
        }
        
        // Получаем комментарии для статьи
        $comments = \src\Models\Comments\Comment::findByArticleId($id);
        
        $this->view->renderHtml('article/show', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function edit($id){
        $article = Article::getById($id);
        $this->view->renderHtml('article/edit', ['article'=>$article]);
    }

    public function update($id){
        $article = Article::getById($id);
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->save();
        return header('Location:http://127.0.0.1/php-sivova/project/www/index.php');
    }

    public function create(){
        $this->view->renderHtml('article/create');
    }

    public function store(){
        $article = new Article;
        $article->title = $_POST['title'];
        $article->text = $_POST['text'];
        $article->authorId = 1;
        $article->save();
        return header('Location:http://127.0.0.1/php-sivova/project/www/index.php');
    }

    public function delete(int $id){
        $article = Article::getById($id);
        $article->delete();
        return header('Location:http://127.0.0.1/php-sivova/project/www/index.php');
    }
}
