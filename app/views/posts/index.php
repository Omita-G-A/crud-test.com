<?php include_once APPROOT. '/views/includes/header.php'; ?>
<h1>Página de Posts</h1>
<?php echo $data['title']; ?>
<ul>
<?php foreach($data['posts'] as $post): ?>
    <li><?php echo $post->title?></li>
    <?php endforeach ?>
</ul>
<?php include_once APPROOT. '/views/includes/footer.php'; ?>