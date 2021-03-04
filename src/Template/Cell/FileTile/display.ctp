<div class="block has-text-centered">
    <?php if ($file->canEmbed()): ?>
        <?php echo $this->cell('File', [$file, $file->isImageEmbeddable() ? 'thumbnail' : null]); ?>
    <?php else: ?>
        <?php echo $this->cell('FileTile::icon', [$file, ['is-large'], ['fa-4x']]); ?>
    <?php endif; ?>
</div>

<div class="block has-text-centered">
    <ul class="is-clipped">
        <li class="has-text-weight-bold"><?php echo h($file->name); ?></li>
        <li class="is-italic"><?php echo __('Type: {0}', $file->mime_type); ?></li>
        <li class="is-italic"><?php echo __('Created: {0}', $file->created); ?></li>
        <li class="is-italic"><?php echo __('Modified: {0}', $file->modified); ?></li>
    </ul>
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
