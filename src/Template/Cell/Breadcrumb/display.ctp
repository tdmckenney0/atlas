<?php if(count($items) > 1): ?>
    <nav aria-label="breadcrumb" class="breadcrumb">
        <ul>
            <?php foreach($items as $name => $url): ?>
                <?php if($url === $last): ?>
                    <li class="is-active"><a href="#" aria-current="page"><?php echo h(is_numeric($name) ? $url : $name); ?></a></li>
                <?php else: ?>
                    <li><?php echo $this->Html->link($name, $url); ?></li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
    </nav>
<?php endif; ?>
