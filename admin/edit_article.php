<?php

require '../includes/init.php';

Auth::requireLogin();

$connection = require '../includes/db.php';

date_default_timezone_set('America/Mexico_City');


if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $article = Article::getArticleByID($connection, $id);

    if (!$article) {
        die("Article not found");
    }
} else {

    die("ID not supplied, arcticle not found.");
}

//ArrayDump::dump(array_column($article->getCategories($connection), 'id'));
$category_ids = array_column($article->getCategories($connection), 'id');
$categories = Category::getAll($connection);
//ArrayDump::dump($categories);

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    ArrayDump::dump($_POST['category']);
    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->updated_at = date('Y-m-d H:i:s');
    $category_ids = $_POST['category'] ?? [];

    if ($article->update($connection)) {
        $article->setCategories($connection, $category_ids);
        Url::redirect("/crm_tw_php_js_mysql/admin/article.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php' ?>
<h2>Edit Article</h2>
<?php require 'includes/ArticleForm.php' ?>

<?php require '../includes/footer.php' ?>