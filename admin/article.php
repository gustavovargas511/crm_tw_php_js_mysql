<?php

require '../includes/init.php';

Auth::requireLogin();

$connection = require '../includes/db.php';


if (isset($_GET['id'])) {


  $id = $_GET['id'];

  $article = Article::getArticleByID($connection, $id);
} else {

  $article = null;
}

?>

<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>
  <div>
    <h2><?= htmlspecialchars($article->title); ?></h2>
    <p><?= htmlspecialchars($article->content); ?></p>
    <p>Published at: <?= htmlspecialchars($article->published_at); ?></p>
    <?php if (!empty($article->updated_at)) : ?>
      <p>Updated at: <?= htmlspecialchars($article->updated_at); ?></p>
    <?php endif; ?>
  </div>
  <a href="edit_article.php?id=<?= $article->id; ?>">Edit</a>
  <a href="delete_article.php?id=<?= $article->id; ?>">Delete</a>
  <a href="edit_article_image.php?id=<?= $article->id; ?>">Edit Image</a>
<?php else : ?>
  <p>Article not found</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>