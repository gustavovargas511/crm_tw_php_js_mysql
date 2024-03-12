<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Php, Mysql and Tailwind CSS</title>
  <!--<script src="https://cdn.tailwindcss.com"></script>-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/main.css">
</head>

<body>
  <div class="container">
  <div>
    <h1>BLOG</h1>
  </div>

  <nav class="navbar navbar-expand-lg bg-body-tertiary"">
    <ul class="nav">
      <li class="nav-item"><a class="nav-link" href="/crm_tw_php_js_mysql">Home</a></li>
      <?php if (Auth::isLoggedIn()) : ?>
        <li class="nav-item"><a class="nav-link" href="/crm_tw_php_js_mysql/admin">Admin</a></li>
        <li class="nav-item"><a class="nav-link" href="/crm_tw_php_js_mysql/logout.php">Log out</a></li>
      <?php else : ?>
        <li class="nav-item"><a class="nav-link" href="/crm_tw_php_js_mysql/login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <div> <!-- main content start-->