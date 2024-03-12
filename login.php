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
    <div class="form-group">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name">
    </div>
    <div class="form-group mt-2">
        <label for="pass" class="form-label">Password</label>
        <input type="password" class="form-control" name="pass" id="pass">
    </div>
    <button class="btn btn-primary mt-3" type="submit">Login</button>
</form>
<?php require 'includes/footer.php' ?>