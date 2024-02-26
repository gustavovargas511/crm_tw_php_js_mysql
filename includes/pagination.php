<?php $base = strtok($_SERVER["REQUEST_URI"], '?'); ?>
<div>
        <div>
            <?php if ($paginator->previous) : ?>
                <a href="<?= $base; ?>?page=<?= $paginator->previous; ?>">Previous</a>
            <?php else : ?>
                Previous
            <?php endif; ?>
        </div>
        <div>
            <?php if ($paginator->next) : ?>
                <a href="<?= $base; ?>?page=<?= $paginator->next; ?>">Next</a>
            <?php else : ?>
                Next
            <?php endif; ?>
        </div>
    </div>