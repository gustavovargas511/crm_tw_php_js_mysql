<?php

require '../includes/init.php';

Auth::requireLogin();

$connection = require '../includes/db.php';

$paginator = new Paginator($_GET['page'] ?? 1, 6, Article::getTotal($connection));

$articles = Article::getPage($connection, $paginator->limit, $paginator->offset);


?>

<?php require '../includes/header.php'; ?>


<h2>Administration</h2>

<p><a href="new_article.php">Create new article</a></p>

<?php if (empty($articles)) : ?>
    <p>No articles found</p>
<?php else : ?>
    <table class="table table-striped">
        <thead>
            <th>Title</th>
            <th>Published Date</th>
        </thead>
        <tbody>
            <?php foreach ($articles as $article) : ?>
                <tr>
                    <td>
                        <a href="article.php?id=<?= $article['id']; ?>"> <?= htmlspecialchars($article['title']); ?></a>
                    </td>
                    <td>
                     <time><?= $article['published_at']; ?></time>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php require "../includes/pagination.php" ?>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>