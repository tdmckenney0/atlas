<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li class="nav-item py-1">
            <?php if(!empty($node->children) || !empty($node->files)): ?>
                <a class="nav-link pl-0 text-nowrap text-light" data-toggle="collapse" href="#item-<?php echo $node->id; ?>"><i class="fas fa-folder"></i>&nbsp;<?php echo __($node->name); ?></a>
                <div id="item-<?php echo $node->id; ?>" class="collapse">
                    <ul class="nav flex-column ml-4">
                        <?php echo $this->Html->link($this->Html->tag('i', '', ['class' => 'fas fa-file-alt']) . '&nbsp;' . __("Overview"), ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => 'nav-link pl-0 text-nowrap text-light', 'escape' => false]); ?>

                        <?php if(!empty($node->children)) echo $this->element('node_branch', ['nodes' => $node->children]); ?>

                        <?php if(!empty($node->files)): ?>
                            <?php foreach($node->files as $file): ?>
                                <li class="nav-item font-italic py-1">
                                    <a class="nav-link pl-0 text-nowrap text-light" href="<?php echo $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id]); ?>"><i class="fas fa-file-alt"></i>&nbsp;<?php echo h($file->name); ?></a>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

            <?php else: ?>
                <a class="nav-link pl-0 text-nowrap text-light" href="<?php echo $this->Url->build(['controller' => 'nodes', 'action' => 'view', $node->id]); ?>"><i class="fas fa-file-alt"></i>&nbsp;<?php echo h($node->name); ?></a>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
