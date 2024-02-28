<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Php, Mysql and Tailwind CSS</title>
  <!--<script src="https://cdn.tailwindcss.com"></script>-->
</head>

<body>
  <div>
    <h1>BLOG</h1>
  </div>

  <nav>
    <ul>
      <li><a href="/crm_tw_php_js_mysql">Home</a></li>
      <?php if (Auth::isLoggedIn()) : ?>
        <li><a href="/crm_tw_php_js_mysql/admin">Admin</a></li>
        <li><a href="/crm_tw_php_js_mysql/logout.php">Log out</a></li>
      <?php else : ?>
        <li><a href="/crm_tw_php_js_mysql/login.php">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>

  <div> <!-- main content start-->