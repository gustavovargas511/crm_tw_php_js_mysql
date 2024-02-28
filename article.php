<?php

require 'includes/init.php';
Auth::requireLogin();

$connection = require 'includes/db.php';


if (isset($_GET['id'])) {


  $id = $_GET['id'];

  $article = Article::getArticleByID($connection, $id);
} else {

  $article = null;
}

?>

<?php require 'includes/header.php'; ?>

<?php if ($article) : ?>
  <div>
    <h2><?= htmlspecialchars($article->title); ?></h2>
    <?php if ($article->image_file) : ?>
      <img src="../uploads/<?= $article->image_file; ?>">
    <?php endif; ?>
    <p><?= htmlspecialchars($article->content); ?></p>
    <p>Published at: <?= htmlspecialchars($article->published_at); ?></p>
    <?php if (!empty($article->updated_at)) : ?>
      <p>Updated at: <?= htmlspecialchars($article->updated_at); ?></p>
    <?php endif; ?>
  </div>
<?php else : ?>
  <p>Article not found</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>