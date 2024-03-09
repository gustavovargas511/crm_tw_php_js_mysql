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
    //ArrayDump::dump($_FILES);

    if (empty($_FILES)) {
        throw new Exception('Invalid Upload');
    }

    try {
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file uploaded.');
                break;
            default:
                throw new Exception('An error ocurred.');
                break;
        }

        if ($_FILES['file']['size'] > 1000000) {
            throw new Exception('File is too large.');
        }

        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type.');
        }

        //$destination_folder = '../../uploads/' . $_FILES['file']['name'];
        $pathinfo = pathinfo($_FILES['file']['name']);

        $base = $pathinfo['filename'];
        // Remove unwanted characters
        $destination_file = preg_replace("/[^\w\-\.]/", '', $base);

        // Limit the length of the file name
        $destination_file = substr($base, 0, 400);

        // Replace spaces with underscores
        $destination_file = str_replace(' ', '_', $base);

        $destination_file = $base . "." . $pathinfo['extension'];

        $destination_folder = "../../uploads/$destination_file";

        $file_count = 1;

        while (file_exists($destination_folder)) {
            $destination_file = $base . "-$file_count." . $pathinfo['extension'];
            $destination_folder = "../../uploads/$destination_file";
            $file_count++;
        }



        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination_folder)) {

            $previous_image = $article->image_file;

            if ($article->setImageFile($connection, $destination_file)) {

                if ($previous_image) {
                    unlink("../../uploads/$previous_image");
                }

                Url::redirect("/crm_tw_php_js_mysql/admin/edit_article_image.php?id={$article->id}");
            }
        } else {
            throw new Exception('Unable to move uploaded file.');
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}

?>

<?php require '../includes/header.php' ?>
<h2>Edit Article Image</h2>
<?php if ($article->image_file) : ?>
    <img src="../../uploads/<?= $article->image_file; ?>">
    <a class="delete_article" href="delete_article_image.php?id=<?= $article->id; ?>">Delete</a>
<?php endif; ?>
<?php if (isset($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </div>
    <button>Upload</button>
</form>
<?php require '../includes/footer.php' ?>