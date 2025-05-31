<?php require(dirname(__DIR__).'/header.php');?>
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <p class="card-text"><?=$comment->getText();?></p>
            <p class="card-subtitle mb-2 text-muted">Автор: <?=$comment->getAuthorId()->getNickname();?></p>
            <div class="btn-group" role="group">
                <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/edit" class="btn btn-primary">Редактировать</a>
                <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/delete" class="btn btn-danger">Удалить</a>
                <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$comment->getArticleId();?>" class="btn btn-secondary">Вернуться к статье</a>
            </div>
        </div>
    </div>
</div>
<?php require(dirname(__DIR__).'/footer.html');?>