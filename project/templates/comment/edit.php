<?php require(dirname(__DIR__).'/header.php');?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <h2>Редактировать комментарий</h2>
    <form action="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/update" method="post">
        <div class="mb-3">
            <label for="text" class="form-label">Текст комментария</label>
            <textarea class="form-control" id="text" name="text" rows="3" required><?=$comment->getText();?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить</button>
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$comment->getArticleId();?>" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<?php require(dirname(__DIR__).'/footer.html');?> 