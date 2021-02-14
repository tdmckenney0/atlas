<?php if (!empty($node->files) || !empty($children) || !empty($node->node_revisions)): ?>
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
                    <?php echo $this->element('Menu/link', ['name' => $file->name, 'icon' => 'fas fa-file', 'url' => ['controller' => 'files', 'action' => 'view', $file->id] ]); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($node->node_revisions)): ?>
            <p class="menu-label">
                Latest Revisions
            </p>

            <ul class="menu-list">
                <?php foreach ($node->node_revisions as $revision): ?>
                    <?php echo $this->element('Menu/link', ['name' => $revision->created, 'icon' => 'fas fa-clock', 'url' => ['controller' => 'node_revisions', 'action' => 'view', $revision->id] ]); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
<?php endif; ?>
