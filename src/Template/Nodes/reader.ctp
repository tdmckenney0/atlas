<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <?php foreach($generator($node) as $child): ?>
        <?php $level = ($child->getLevel() - $topLevel) + 1; ?>
        <div class="box">
            <?php printf('<h%s class="title is-%s">%s</h%s>', $level, $level, $child->name, $level); ?>
            <div class="has-text-justified content">
                <?php echo $this->cell('Markdown', [$child->description]); ?>
            </div>
        </div>
        <?php if(!empty($child->files)): ?>
            <?php $fileLevel = $level + 1;?>
            <?php foreach($child->files as $file): ?>
                <div class="box">
                    <?php printf('<h%s class="title is-%s">%s</h%s>', $fileLevel, $fileLevel, $file->name, $fileLevel); ?>
                    <?php echo $this->cell('File', [$file]); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
