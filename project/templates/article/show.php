<?php require(dirname(__DIR__).'/header.php');?>
<div class="container">
  <div class="card mt-3">
    <div class="card-body">
      <h5 class="card-title"><?=$article->getTitle();?></h5>
      <h6 class="card-subtitle mb-2 text-muted"><?=$article->getAuthorId()->getNickname();?></h6>
      <p class="card-text"><?=$article->getText();?></p>
      <div class="btn-group" role="group">
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/edit" class="btn btn-primary">Редактировать статью</a>
        <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/article/<?=$article->getId();?>/delete" class="btn btn-danger">Удалить статью</a>
      </div>
    </div>
  </div>

  <!-- Секция комментариев -->
  <div class="mt-4">
    <h4>Комментарии</h4>
    <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/create/<?=$article->getId();?>" class="btn btn-success mb-3">Добавить комментарий</a>
    
    <?php if(isset($comments) && !empty($comments)): ?>
      <?php foreach($comments as $comment): ?>
        <div class="card mb-2">
          <div class="card-body">
            <p class="card-text"><?=$comment->getText();?></p>
            <p class="card-subtitle text-muted">Автор: <?=$comment->getAuthorId()->getNickname();?></p>
            <div class="btn-group mt-2" role="group">
              <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/edit" class="btn btn-sm btn-primary">Редактировать</a>
              <a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>/comment/<?=$comment->getId();?>/delete" class="btn btn-sm btn-danger">Удалить</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-muted">Комментариев пока нет</p>
    <?php endif; ?>
  </div>
</div>
<?php require(dirname(__DIR__).'/footer.html');?>