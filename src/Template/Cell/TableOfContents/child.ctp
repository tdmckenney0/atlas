<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li>
            <?php $active = (!empty($path) ? $path->contains($node->id) : false); ?>
            <a class="table-of-contents-node">
                <span class="icon">
                    <i class="fas <?php echo $active ? 'fa-book-open' : 'fa-book'; ?>"></i>
                </span>&nbsp;<?php echo __($node->name); ?>
            </a>
            <ul class="menu-list <?php echo $active ? '' : 'is-hidden'; ?> table-of-contents-list">
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => "Overview", 'link' => ['controller' => 'nodes', 'action' => 'view', $node->id]]); ?>

                <?php if(!empty($node->children)) echo $this->cell('TableOfContents::child', [$node->children, $path]); ?>

                <?php if(!empty($node->files)): ?>
                    <?php foreach($node->files as $file): ?>
                        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file', 'text' => $file->name, 'link' => ['controller' => 'files', 'action' => 'view', $file->id, $node->id]]); ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
