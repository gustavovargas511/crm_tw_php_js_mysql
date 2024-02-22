<?php

require 'includes/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $connection = require 'includes/db.php';

    if (User::authenticate($connection, $_POST['name'], $_POST['pass'])) {
        Auth::login();
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