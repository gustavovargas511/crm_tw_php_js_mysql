<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/auth.php';

session_start();


$db = new Database();
$connection = $db->getConnection();

$articles = Article::getAll($connection);

?>

<?php require 'includes/header.php'; ?>

<?php if (isLoggedIn()): ?>
    <p>You are logged in!!! <a href="logout.php">Log out</a></p>
<?php else: ?>
    <p>Not logged in. <a href="login.php">Login</a></p>
<?php endif; ?>

<?php if(isLoggedIn()): ?>
    <a href="new_article.php">Create new article</a>
<?php endif; ?>

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