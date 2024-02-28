<?php if ($article->errors) : ?>
    <?php foreach ($article->errors as $err) : ?>
        <p><?= $err; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<form action="" method="post">
    <div>
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article->title); ?>">
    </div>
    <div>
        <label for="content">What do you wanna say?</label>
        <textarea name="content" id="content" cols="40" rows="4"><?= htmlspecialchars($article->content); ?></textarea>
    </div>
    <button type="submit">Publish!</button>
</form>