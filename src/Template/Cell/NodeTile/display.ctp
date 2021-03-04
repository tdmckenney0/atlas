<p class="title is-clipped"><?php echo h($node->name); ?></p>
<div class="content is-clipped">
    <?php echo $this->cell('Markdown', [$node->description]); ?>                            
</div>

<?php if (!empty($linkName) && !empty($linkUrl)): ?>
    <div class="block has-text-centered is-clipped">
        <?php if(empty($postLink)): ?>
            <?php echo $this->Html->link($linkName, $linkUrl); ?>
        <?php else: ?>
            <?php echo $this->Form->create(null, ['url' => $linkUrl]); ?>
                <input type="submit" class="button is-primary is-inverted is-fullwidth" value="<?php echo h($linkName); ?>" />
            <?php echo $this->Form->end(); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
