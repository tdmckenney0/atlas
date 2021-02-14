<section class="box section" style="break-inside: avoid;">
    <?php printf('<h%1$s class="title is-%1$s">%2$s</h%1$s>', $level, $node->name); ?>
    
    <div class="has-text-justified content" style="break-inside: avoid;">
        <?php echo $this->cell('Markdown', [$node->description]); ?>
    </div>
</section>

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