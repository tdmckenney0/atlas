# <?php echo $node->name; ?>

<?php echo $node->description; ?>

<?php foreach($node->files as $file): ?>
    <?php if($file->isImage()): ?>
        <?php printf(PHP_EOL . '![%s](%s)', $file->name, $file->File->path); ?>
    <?php endif; ?>
<?php endforeach; ?>
