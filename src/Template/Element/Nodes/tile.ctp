<div class="tile is-parent">
    <article class="tile is-child box">
        <p class="title"><?php echo h($node->name); ?></p>
        <div class="content">
            <?php echo $this->cell('Markdown', [$node->description]); ?>                            
        </div>
        
        <?php if (!empty($linkName) && !empty($linkUrl)): ?>
            <div class="block">
                <?php echo $this->Html->link($linkName, $linkUrl); ?>
            </div>
        <?php endif; ?>
    </article>
</div>