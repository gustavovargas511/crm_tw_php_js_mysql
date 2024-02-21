<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'classes/Url.php';
date_default_timezone_set('America/Mexico_City');

$db = new Database();
$connection = $db->getConnection();


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $article = Article::getArticleByID($connection, $id);

    if (!$article) {
        die("Article not found");
    }
} else {

    die("ID not supplied, arcticle not found.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($article->delete($connection)) {
        Url::redirect("/crm_tw_php_js_mysql");
    }
}
?>

<?php require 'includes/header.php' ?>

<h2>Delete article</h2>
<form method="post">
    <p>Are you sure you want to delete this article?</p>
    <button>Delete</button>
    <a href="article.php?id=<?= $article->id; ?>">Go back</a>
</form>

<?php require 'includes/footer.php' ?>