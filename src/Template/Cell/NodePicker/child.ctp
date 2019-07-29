<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li>
            <?php $active = (!empty($path) ? $path->contains($node->id) : false); ?>
            <a class="node-picker-node has-text-dark">
                <div class="">
                    <span class="icon">
                        <i class="fas <?php echo $active ? 'fa-folder-open' : 'fa-folder'; ?>"></i>
                    </span>&nbsp;<?php echo __($node->name); ?>

                    <div class="is-pulled-right">
                        <input type="radio" class="node-picker-radio" name="<?php echo $field; ?>" value="<?php echo $node->id; ?>">
                    </div>
                </div>
            </a>

            <ul class="<?php echo $active ? '' : 'is-hidden'; ?> node-picker-list">
                <?php if(!empty($node->children)) echo $this->cell('NodePicker::child', [$node->children, $path, $field]); ?>
            </ul>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
