<?php

require 'classes/Url.php';
require 'classes/User.php';
require 'classes/Database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new Database();
    $connection = $db->getConnection();

    if (User::authenticate($connection, $_POST['name'], $_POST['pass'])) {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        Url::redirect("/crm_tw_php_js_mysql");
    } else {
        $error = "Invalid credentials";
    }
}

?>

<?php require 'includes/header.php' ?>
<h2>Login</h2>
<?php if (!empty($error)) : ?>
    <p><?= $error; ?></p>
<?php endif; ?>
<form method="post">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>
    <div>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Login</button>
</form>
<?php require 'includes/footer.php' ?>