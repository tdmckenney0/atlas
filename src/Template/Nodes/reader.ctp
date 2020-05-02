<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php if (!empty($node->child_nodes)): ?>
    <?php $this->start('nodes'); ?>
        <ul class="menu-list">
            <?php foreach ($node->child_nodes as $child): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book', 'text' => $child->name, 'link' => ['action' => 'reader', $child->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php if (!empty($node->files)): ?>
    <?php $this->start('files'); ?>
        <ul class="menu-list">
            <?php foreach ($node->files as $file): ?>
                <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file', 'text' => $file->name, 'link' => ['controller' => 'files', 'action' => 'view', $file->id, $node->id]]); ?>
            <?php endforeach; ?>
        </ul>
    <?php $this->end(); ?>
<?php endif; ?>

<?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Read')]]); ?>

<div class="container-fluid">
    <?php foreach($generator($node) as $child): ?>
        <?php $level = ($child->getLevel() - $topLevel) + 1; ?>
        <div class="box" style="break-inside: avoid;">
            <?php printf('<h%s class="title is-%s">%s</h%s>', $level, $level, $child->name, $level); ?>
            <div class="has-text-justified content" style="break-inside: avoid;">
                <?php echo $this->cell('Markdown', [$child->description]); ?>
            </div>
        </div>
        <?php if(!empty($child->files)): ?>
            <?php $fileLevel = $level + 1;?>
            <?php foreach($child->files as $file): ?>
                <div class="box" style="break-before: page;">
                    <?php printf('<h%s class="title is-%s">%s</h%s>', $fileLevel, $fileLevel, $file->name, $fileLevel); ?>
                    <?php echo $this->cell('File', [$file]); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
