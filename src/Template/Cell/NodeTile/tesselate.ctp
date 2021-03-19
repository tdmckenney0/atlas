<div class="tile is-ancestor is-align-items-start">
    <?php foreach ($grouped as $column): ?>
        <div class="tile is-vertical is-align-items-start is-<?php echo floor(12 / $columns); ?>">
            <?php foreach ($column as $node): ?>
                <div class="tile is-parent is-12">
                    <article class="tile is-child box is-12 <?= (empty($node->parent_id) ? 'has-text-black-bis' : ''); ?>">
                        <?php echo $this->cell('NodeTile', [$node, __($linkName, $node->name), $linkGenerator($node), $postLink]); ?>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>