<?php

require 'includes/init.php';
Auth::requireLogin();

$connection = require 'includes/db.php';


if (isset($_GET['id'])) {


  $id = $_GET['id'];

  $article = Article::getWithCategories($connection, $id);
} else {

  $article = null;
}

?>

<?php require 'includes/header.php'; ?>

<?php if ($article) : ?>
  <div>
    <h2><?= htmlspecialchars($article[0]['title']); ?></h2>
    <?php if ($article[0]['category_name']) : ?>
      <p>Categories:
        <?php foreach ($article as $a) : ?>
          <?= htmlspecialchars($a['category_name']) ?>
        <?php endforeach; ?>
      </p>
    <?php endif; ?>
    <?php if ($article[0]['image_file']) : ?>
      <img src="../uploads/<?= $article[0]['image_file']; ?>">
    <?php endif; ?>
    <p><?= htmlspecialchars($article[0]['content']); ?></p>
    <p>Published at: <?= htmlspecialchars($article[0]['published_at']); ?></p>
    <?php if (!empty($article[0]['updated_at'])) : ?>
      <p>Updated at: <?= htmlspecialchars($article[0]['updated_at']); ?></p>
    <?php endif; ?>
  </div>
<?php else : ?>
  <p>Article not found</p>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>