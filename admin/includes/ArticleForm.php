<?php if ($article->errors) : ?>
    <?php foreach ($article->errors as $err) : ?>
        <p><?= $err; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
<form method="post" id="formArticle">
    <div class="form-group mt-2">
        <label for="title" class="form-label">Post Title</label>
        <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($article->title); ?>">
    </div>
    <div class="form-group mt-2">
        <label for="content" class="form-label">What do you wanna say?</label>
        <textarea name="content" class="form-control" id="content" cols="40" rows="4"><?= htmlspecialchars($article->content); ?></textarea>
    </div>
    <fieldset class="mt-2">
        <legend>Categories</legend>
        <?php foreach ($categories as $category) : ?>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="category[]" value="<?= $category['id'] ?>"
                       id="<?= $category['id'] ?>"
                       <?php if (in_array($category['id'], $category_ids)) : ?> 
                        checked 
                        <?php endif; ?>>
                <label class="form-check-label" for="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></label>
            </div>
        <?php endforeach; ?>
    </fieldset>
    <button class="btn btn-primary mt-3" type="submit">Publish!</button>
</form>
