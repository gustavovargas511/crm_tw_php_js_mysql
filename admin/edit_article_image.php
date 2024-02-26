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
    ArrayDump::dump($_FILES);

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

        $mime_types = ['image/gif','image/png','image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['file']['tmp_name']);

        if (!in_array($mime_type, $mime_types)) {
            throw new Exception('Invalid file type.');
            
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

?>

<?php require '../includes/header.php' ?>
<h2>Edit Article Image</h2>
<form method="post" enctype="multipart/form-data">
    <div>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </div>
    <button>Upload</button>
</form>
<?php require '../includes/footer.php' ?>