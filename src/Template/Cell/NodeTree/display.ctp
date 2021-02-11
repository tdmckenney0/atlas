<?php if (!empty($node->files) || !empty($children)): ?>
    <?php echo $this->Html->script('tree'); ?>

    <div class="menu">
        <?php if (!empty($children)): ?>
            <p class="menu-label">
                Nodes
            </p>

            <ul class="menu-list node-tree">
                <?php foreach ($children as $child): ?>
                    <?php echo $this->cell('NodeTree::child', [$child]); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($node->files)): ?>
            <p class="menu-label">
                Files
            </p>

            <ul class="menu-list">
                <?php foreach ($node->files as $file): ?>
                    <?php echo $this->cell('NodeTree::menulink', [$file->name, 'fas fa-file', ['controller' => 'files', 'action' => 'view', $file->id] ]); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>
