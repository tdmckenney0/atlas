<div class="my-4 ml-4">
    <div class="btn-group d-flex flex-row">

        <?php if($is_selected): ?>
            <?php $class = 'btn-outline-primary'; ?>
            <?php $selectClass = 'btn-primary'; ?>
            <?php $disabled = 'disabled="disabled"'; ?>
        <?php elseif($is_current): ?>
            <?php $class = 'btn-outline-danger'; ?>
            <?php $selectClass = 'btn-danger'; ?>
            <?php $disabled = 'disabled="disabled"'; ?>
        <?php else: ?>
            <?php $class = 'btn-outline-secondary'; ?>
            <?php $selectClass = 'btn-success'; ?>
            <?php $disabled = ''; ?>
        <?php endif; ?>

        <button type="button" class="w-100 btn btn-block text-nowrap dont-think text-left node-picker-toggle <?php echo $class; ?>" data-toggle="collapse" href="#node-picker-<?php echo $node->id; ?>">
            <i class="fas fa-folder"></i>&nbsp;
            <span class="node-picker-node-name"><?php echo $node->name; ?></span>&nbsp;
            <i class="fas fa-angle-down"></i>
        </button>
        <button type="button" class="px-4 btn <?php echo $selectClass; ?> text-nowrap dont-think node-picker-select" data-node-id="<?php echo $node->id; ?>" <?php echo $disabled; ?>>Select</button>
    </div>

    <div class="flex-column collapse" id="node-picker-<?php echo $node->id; ?>">
        <?php if(!$is_current): ?>
            <?php foreach($node->child_nodes as $node): ?>
                <?php echo $this->cell('NodePicker::child', [$node, $current, $selected]); ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
