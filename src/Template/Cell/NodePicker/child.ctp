<div class="my-4 ml-4">
    <div class="btn-group d-flex flex-row">

        <?php if($is_selected): ?>
            <?php $class = 'btn-outline-info'; ?>
        <?php elseif($is_current): ?>
            <?php $class = 'btn-outline-secondary'; ?>
        <?php else: ?>
            <?php $class = 'btn-outline-primary'; ?>
        <?php endif; ?>

        <button type="button" class="w-100 btn btn-block text-nowrap dont-think text-left node-picker-select overflow-hidden <?php echo $class; ?>" <?php echo $is_current || $is_selected ? 'disabled="disabled"' : ''; ?> data-node-id="<?php echo $node->id; ?>">
            <i class="fas fa-folder"></i>&nbsp;
            <span class="node-picker-node-name"><?php echo $node->name; ?></span>&nbsp;
        </button>
        <button type="button" class="px-4 btn btn-primary text-nowrap dont-think node-picker-toggle" <?php echo $is_current ? 'disabled="disabled"' : ''; ?> data-toggle="collapse" href="#node-picker-<?php echo $node->id; ?>"><i class="fas fa-angle-down"></i></button>
    </div>

    <div class="flex-column collapse" id="node-picker-<?php echo $node->id; ?>">
        <?php if(!$is_current): ?>
            <?php foreach($node->child_nodes as $node): ?>
                <?php echo $this->cell('NodePicker::child', [$node, $current, $selected]); ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
