<div class="tile is-ancestor is-align-items-start">
    <?php foreach ($grouped as $column): ?>
        <div class="tile is-vertical is-align-items-start is-<?php echo floor(12 / $columns); ?>">
            <?php foreach ($column as $file): ?>
                <div class="tile is-parent is-12">
                    <article class="tile is-child box is-12">
                        <?php echo $this->cell('FileTile', [$file, __($linkName, $file->name), $linkGenerator($file), $postLink]); ?>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
