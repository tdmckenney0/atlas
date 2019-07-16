<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li>
            <?php if(!empty($node->children) || !empty($node->files)): ?>
                <a data-toggle="collapse" href="#item-<?php echo $node->id; ?>"><i class="fas fa-folder"></i>&nbsp;<?php echo __($node->name); ?></a>
                <ul id="item-<?php echo $node->id; ?>" class="collapse">
                    <?php if(!empty($node->children)) echo $this->cell('TableOfContents::child', [$node->children]); ?>

                    <?php echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-folder-open']) . '&nbsp;' . __("Overview"), ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => '', 'escape' => false]); ?>

                    <?php if(!empty($node->files)): ?>
                        <?php foreach($node->files as $file): ?>
                            <li><a href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id, $node->id]); ?>"><i class="fas fa-file-alt"></i>&nbsp;<?php echo h($file->name); ?></a></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            <?php else: ?>
                <a href="<?php echo $this->Url->build(['controller' => 'nodes', 'action' => 'view', $node->id]); ?>"><i class="fas fa-folder-open"></i>&nbsp;<?php echo h($node->name); ?></a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
