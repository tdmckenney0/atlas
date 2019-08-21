<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li>
            <?php $active = (!empty($path) ? $path->contains($node->id) : false); ?>
            <a class="table-of-contents-node"><i class="fas <?php echo $active ? 'fa-folder-open' : 'fa-folder'; ?>"></i>&nbsp;<?php echo __($node->name); ?></a>
            <ul class="menu-list <?php echo $active ? '' : 'is-hidden'; ?> table-of-contents-list">
                <?php if(!empty($node->children)) echo $this->cell('TableOfContents::child', [$node->children, $path]); ?>

                <?php if(!empty($node->files)): ?>
                    <?php foreach($node->files as $file): ?>
                        <li><a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id, $node->id]); ?>"><i class="fas fa-file-alt"></i>&nbsp;<?php echo h($file->name); ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li><?php echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-sticky-note']) . '&nbsp;' . __("Overview"), ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => '', 'escape' => false]); ?></li>
                <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-clock']) . '&nbsp;' . __('List Revisions'), ['controller' => 'NodeRevisions', 'action' => 'index', $node->id], ['escape' => false]) ?></li>
                <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-edit']) . '&nbsp;' . __('Edit Node'), ['action' => 'edit', $node->id], ['escape' => false]) ?></li>
                <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-pdf']) . '&nbsp;' . __('Export to PDF'), ['action' => 'view', $node->id, '_ext' => 'pdf'], ['escape' => false]) ?></li>
                <li><?= $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-archive']) . '&nbsp;' . __('Export to Zip'), ['action' => 'view', $node->id, '_ext' => 'zip'], ['escape' => false]) ?></li>
                <li><?= $this->Form->postLink($this->Html->tag('i', '', ['class' => 'fas fa-trash']) . '&nbsp;' . __('Delete Node'), ['action' => 'delete', $node->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $node->id)]) ?></li>
            </ul>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
