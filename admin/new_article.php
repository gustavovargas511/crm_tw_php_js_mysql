<?php

require '../includes/init.php';

Auth::requireLogin();

$article = new Article();
date_default_timezone_set('America/Mexico_City');

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $connection = require '../includes/db.php';

    $article->title = $_POST['title'];
    $article->content = $_POST['content'];
    $article->published_at = date('Y-m-d H:i:s');

    if ($article->create($connection)) {
        $article->title = '';
        $article->content = '';
        Url::redirect("/crm_tw_php_js_mysql/admin/article.php?id={$article->id}");
    }

}
?>

<?php require '../includes/header.php' ?>
<h2>New Article</h2>
<?php require '../includes/ArticleForm.php' ?>

<?php require '../includes/footer.php' ?>