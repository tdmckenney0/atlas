<nav aria-label="breadcrumb" class="breadcrumb is-centered box">
    <ul class="breadcrumb">
        <?php if(!empty($nodes) || !empty($append)): ?>
            <li><?php echo $this->Html->link(__('Home'), ['controller' => 'nodes', 'action' => 'index'], ['aria-current' => 'page']); ?></li>
        <?php else: ?>
            <li class="is-active"><a href="#" aria-current="page">Home</a></li>
        <?php endif; ?>


        <?php if(!empty($nodes)): ?>
            <?php foreach($nodes as $node): ?>
                <?php if($last_node === $node && empty($append)): ?>
                    <li class="is-active"><a href="#" aria-current="page"><?php echo h($node->name); ?></a></li>
                <?php else: ?>
                    <li class=""><?php echo $this->Html->link($node->name, ['controller' => 'nodes', 'action' => 'view', $node->id]); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php if(!empty($append)): ?>
            <?php if(is_array($append)): ?>
                <?php foreach($append as $v): ?>
                    <li class=" <?php echo ($v == end($append) ? 'is-active' : ''); ?>"><?php echo trim($v); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="is-active"><a href="#" aria-current="page"><?php echo h($append); ?></a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</nav>
