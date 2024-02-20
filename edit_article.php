<?php

require 'classes/Database.php';
require 'classes/Article.php';
require 'includes/routes.php';
date_default_timezone_set('America/Mexico_City');
//$errors = [];

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->updated_at = date('Y-m-d H:i:s');

    if ($article->update($connection)) {
        redirect("/blog_php_mysql_tailwind/article.php?id={$article->id}");
    }
}

?>

<?php require 'includes/header.php' ?>
<h2>Edit Article</h2>
<?php require 'includes/ArticleForm.php' ?>

<?php require 'includes/footer.php' ?>