<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li class="nav-item">
            <?php if(!empty($node->children) || !empty($node->objects)): ?>
                <a class="nav-link" data-toggle="collapse" href="#item-1"><?php echo __($node->name); ?></a>
                <div id="item-1" class="collapse">
                    <ul class="nav flex-column ml-3">
                        <?php if(!empty($node->children)) echo $this->element('node_branch', ['nodes' => $node->children]); ?>

                        <?php if(!empty($node->objects)): ?>
                            <?php foreach($node->objects as $object): ?>
                                <li class="nav-item font-italic">
                                    <?php echo $this->Html->link($object->name, ['controller' => 'objects', 'action' => 'view', $object->id], ['class' => 'nav-link']); ?>
                                </li>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php echo $this->Html->link(__("Open Node"), ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => 'nav-link font-weight-bold']); ?>
                    </ul>
                </div>

            <?php else: ?>
                <?php echo $this->Html->link($node->name, ['controller' => 'nodes', 'action' => 'view', $node->id], ['class' => 'nav-link']); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
