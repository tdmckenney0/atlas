<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li class="nav-item">
            <?php if(!empty($node->children) || !empty($node->files)): ?>
                <a class="nav-link font-weight-bolder" data-toggle="collapse" href="#item-<?php echo $node->id; ?>">📁 <?php echo __($node->name); ?></a>
                <div id="item-<?php echo $node->id; ?>" class="collapse">
                    <ul class="nav flex-column ml-4">
                        <?php echo $this->Html->link(__("🔍 Overview"), ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => 'nav-link']); ?>

                        <?php if(!empty($node->children)) echo $this->element('node_branch', ['nodes' => $node->children]); ?>

                        <?php if(!empty($node->files)): ?>
                            <?php foreach($node->files as $file): ?>
                                <li class="nav-item font-italic">
                                    <?php echo $this->Html->link('🔩 ' . $file->name, ['controller' => 'files', 'action' => 'view', $file->id], ['class' => 'nav-link']); ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>

            <?php else: ?>
                <?php echo $this->Html->link('🔍 ' . $node->name, ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => 'nav-link']); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
