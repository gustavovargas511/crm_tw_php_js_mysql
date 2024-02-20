<?php

require 'includes/routes.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['name'] == 'a' && $_POST['pass'] == 'b') {
        session_regenerate_id(true);
        $_SESSION['is_logged_in'] = true;
        redirect("/blog_php_mysql_tailwind");
    } else {
        $error = "Invalid credentials";
    }

    $real_user = User::authenticate($_POST['name'], $_POST['pass']);
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