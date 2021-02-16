<div class="tile is-parent">
    <article class="tile is-child box">
        <p class="title"><?php echo h($node->name); ?></p>
        <div class="content">
            <?php echo $this->cell('Markdown', [$node->description]); ?>                            
        </div>
        
        <?php if (!empty($linkName) && !empty($linkUrl)): ?>
            <div class="block has-text-centered">
                <?php if(empty($postLink)): ?>
                    <?php echo $this->Html->link($linkName, $linkUrl); ?>
                <?php else: ?>
                    <?php echo $this->Form->create(null, ['url' => $linkUrl]); ?>
                        <input type="submit" class="button is-primary is-inverted is-fullwidth" value="<?php echo h($linkName); ?>" />
                    <?php echo $this->Form->end(); ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </article>
</div>