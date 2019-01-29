<nav aria-label="breadcrumb" class="mt-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page"><?php echo $this->Html->link(__('Home'), ['controller' => 'nodes', 'action' => 'browse']); ?></li>
        <?php foreach($nodes as $node): ?>
            <?php if($last_node === $node): ?>
                <li class="breadcrumb-item active"><?php echo h($node->name); ?></li>
            <?php else: ?>
                <li class="breadcrumb-item"><?php echo $this->Html->link($node->name, ['controller' => 'nodes', 'action' => 'browse', $node->id]); ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ol>
</nav>
