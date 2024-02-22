<?php

require 'includes/init.php';

$connection = require 'includes/db.php';

$articles = Article::getAll($connection);

?>

<?php require 'includes/header.php'; ?>

<?php if (empty($articles)) : ?>
    <p>No articles found</p>
<?php else : ?>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li>
                <div>
                    <h2><a href="article.php?id=<?= $article['id']; ?>"> <?= htmlspecialchars($article['title']); ?></a></h2>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                    <p>Date of publication: <?= $article['published_at']; ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>