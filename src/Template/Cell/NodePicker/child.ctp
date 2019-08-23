<?php if (!empty($nodes)): ?>
    <?php foreach($nodes as $node): ?>
        <li>
            <?php $active = (!empty($path) ? $path->contains($node->id) : false); ?>
            <a class="node-picker-node has-text-dark">
                <div class="">
                    <span class="icon">
                        <i class="fas <?php echo $active ? 'fa-book-open' : 'fa-book'; ?>"></i>
                    </span>&nbsp;<?php echo __($node->name); ?>

                    <div class="is-pulled-right">
                        <input type="radio" class="node-picker-radio" name="<?php echo $field; ?>" value="<?php echo $node->id; ?>">
                    </div>
                </div>
            </a>

            <?php if(!empty($node->children)): ?>
                <ul class="<?php echo $active ? '' : 'is-hidden'; ?> node-picker-list">
                    <?php echo $this->cell('NodePicker::child', [$node->children, $path, $field]); ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
