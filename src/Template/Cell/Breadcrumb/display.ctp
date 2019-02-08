<nav aria-label="breadcrumb" class="overflow-hidden mt-3">
    <ol class="breadcrumb">
        <?php if(!empty($nodes) || !empty($last)): ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $this->Html->link(__('Home'), ['controller' => 'nodes', 'action' => 'index']); ?></li>
        <?php else: ?>
            <li class="breadcrumb-item active">Home</li>
        <?php endif; ?>


        <?php if(!empty($nodes)): ?>
            <?php foreach($nodes as $node): ?>
                <?php if($last_node === $node && empty($last)): ?>
                    <li class="breadcrumb-item active"><?php echo h($node->name); ?></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><?php echo $this->Html->link($node->name, ['controller' => 'nodes', 'action' => 'view', $node->id]); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(!empty($last)): ?>
            <li class="breadcrumb-item active"><?php echo h($last); ?></li>
        <?php endif; ?>
    </ol>
</nav>
