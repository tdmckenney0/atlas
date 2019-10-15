<?php if($file->isText()): ?>
    <?php echo $this->cell('Markdown', [$file->File->read()]); ?>
<?php elseif($file->isCompressed()): ?>
    <div class="notification is-info"><?php echo __('This is a compressed file, you can extract it to the current node.'); ?></div>
<?php else: ?>
    <div class="notification is-warning"><?php echo __('Could not display preview..'); ?></div>
<?php endif; ?>
