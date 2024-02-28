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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $previous_image = $article->image_file;

    if ($article->setImageFile($connection, null)) {

        if ($previous_image) {
            unlink("../../uploads/$previous_image");
        }

        Url::redirect("/crm_tw_php_js_mysql/admin/edit_article_image.php?id={$article->id}");
    }
}

?>

<?php require '../includes/header.php' ?>
<h2>Delete Article Image</h2>
<?php if ($article->image_file) : ?>
    <img src="../../uploads/<?= $article->image_file; ?>">
<?php endif; ?>
<form method="post">
    <p>Are you sure?</p>
    <button>Delete</button>
    <a href="edit_article_image.php?id=<?= $article->id; ?>">Go back</a>
</form>
<?php require '../includes/footer.php' ?>