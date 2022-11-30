<?php echo $this->element('Nodes/section', ['level' => $level + 1, 'node' => $node, 'append' => [__("Read")]]); ?>

<?php if(!empty($node->children)): ?>
    <?php foreach($node->children as $child): ?>
        <?php echo $this->element('Nodes/reader', ['level' => $level + 1, 'node' => $child]); ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(!empty($node->files)): ?>
    <?php foreach($node->files as $file): ?>
        <div class="box" style="break-before: page;">
            <?php echo $this->cell('File', [$file]); ?>

            <hr />

            <nav class="level is-small">
                <div class="level-left">
                    <div class="level-item">
                        <?php echo $this->Html->link($file->name, ['controller' => 'files', 'action' => 'view', $file->id]); ?>
                    </div>
                </div>
            </nav>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
