<?php if ($article->errors) : ?>
    <?php foreach ($article->errors as $err) : ?>
        <p><?= $err; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<form method="post" id="formArticle">
    <div>
        <label for="title">Post Title</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($article->title); ?>">
    </div>
    <div>
        <label for="content">What do you wanna say?</label>
        <textarea name="content" id="content" cols="40" rows="4"><?= htmlspecialchars($article->content); ?></textarea>
    </div>
    <fieldset>
        <legend>Categories</legend>
        <?php foreach ($categories as $category) : ?>
            <div>
                <input type="checkbox" name="category[]" value="<?= $category['id'] ?>"
                       id="<?= $category['id'] ?>"
                       <?php if (in_array($category['id'], $category_ids)) : ?> 
                        checked 
                        <?php endif; ?>>
                <label for="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>
    <button type="submit">Publish!</button>
</form>
