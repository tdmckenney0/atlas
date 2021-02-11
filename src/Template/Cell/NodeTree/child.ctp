<li>
    <a class="menu-tree-toggle">
        <span class="icon">
            <i class="fas fa-book"></i>
        </span>&nbsp;&nbsp;<?php echo h($node->name); ?>
    </a>

    <ul class="menu-list">
        <?php foreach ($node->children as $child): ?>
            <?php echo $this->cell('NodeTree::child', [$child]); ?>
        <?php endforeach; ?>

        <a href="<?php echo $this->Url->build(['controller' => 'nodes', 'action' => 'view', $node->id]); ?>">
            <span class="icon">
                <i class="fas fa-eye"></i>
            </span>&nbsp;&nbsp;<?php echo __('View ') . h($node->name); ?>
        </a>
    </ul>
</li>