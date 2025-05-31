<?php require(dirname(__DIR__).'/header.php');?>
<div class="container mt-4">
    <h2>Добавить комментарий</h2>
    <form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/store" method="post">
        <input type="hidden" name="article_id" value="<?=$articleId?>">
        <div class="mb-3">
            <label for="text" class="form-label">Текст комментария</label>
            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$articleId?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>
<?php require(dirname(__DIR__).'/footer.html');?>