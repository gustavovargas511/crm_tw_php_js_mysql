<?php

require 'includes/init.php';

$connection = require 'includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getTotal($connection));

$articles = Article::getPage($connection, $paginator->limit, $paginator->offset);

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
                    <?php if($article['category_names']) : ?>
                        <p>
                            Categories:
                            <?php foreach ($article['category_names'] as $name) : ?>
                                <?= htmlspecialchars($name); ?>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>
                    <p>Date of publication: <?= $article['published_at']; ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <?php require "includes/pagination.php" ?>
<?php endif; ?>

<?php require 'includes/footer.php'; ?>