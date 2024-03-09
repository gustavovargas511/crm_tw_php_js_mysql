<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();
$category_ids = [];
$connection = require '../includes/db.php';
$categories = Category::getAll($connection);

date_default_timezone_set('America/Mexico_City');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = date('Y-m-d H:i:s');
    $category_ids = $_POST['category'] ?? [];

    if ($article->create($connection)) {
        $article->title = '';
        $article->content = '';
        $article->setCategories($connection, $category_ids);
        Url::redirect("/crm_tw_php_js_mysql/admin/article.php?id={$article->id}");
    }

}
?>

<?php require '../includes/header.php' ?>
<h2>New Article</h2>
<?php require 'includes/ArticleForm.php' ?>

<?php require '../includes/footer.php' ?>