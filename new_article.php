<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/routes.php';
require 'includes/auth.php';

session_start();

if (!isLoggedIn()) {
    die("Unauthorized");
}

$article = new Article();
date_default_timezone_set('America/Mexico_City');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $db = new Database();
    $connection = $db->getConnection();

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = date('Y-m-d H:i:s');

    if ($article->create($connection)) {
        $article->title = '';
        $article->content = '';
        redirect("/blog_php_mysql_tailwind/article.php?id={$article->id}");
    }

}
?>

<?php require 'includes/header.php' ?>
<h2>New Article</h2>
<?php require 'includes/ArticleForm.php' ?>

<?php require 'includes/footer.php' ?>