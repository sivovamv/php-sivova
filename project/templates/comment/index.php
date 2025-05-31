{% comment %} index.php {% endcomment %}
<?php require(dirname(__DIR__).'/header.php');?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Text</th>
      <th scope="col">Author</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($comment as $comment):?> 
    <tr>
      <th scope="row">1</th>
      <td><?=$comment->getCreatedAt();?></td>
      <td><a href="<?=dirname($_SERVER['REQUEST_URI'])?>/comment/<?=$comment->getId();?>"><?=$comment->getText();?></a></td>
      <td><?=$comment->getText();?></td>
      <td><?=$comment->getAuthorId()->getNickname();?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>
