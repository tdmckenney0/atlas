<div class="container">
    <?php if($file->isImageEmbeddable()): ?>
        <?php $cell = $this->cell('File', [$file]); $cell->viewBuilder()->setTemplate('image'); echo $cell; ?>
    <?php elseif($file->isAudio()): ?>
        <?php $cell = $this->cell('File', [$file]); $cell->viewBuilder()->setTemplate('audio'); echo $cell; ?>
    <?php elseif($file->isVideo()): ?>
        <?php $cell = $this->cell('File', [$file]); $cell->viewBuilder()->setTemplate('video'); echo $cell; ?>
    <?php elseif($file->isCSV()): ?>
        <?php $cell = $this->cell('File', [$file]); $cell->viewBuilder()->setTemplate('csv'); echo $cell; ?>
    <?php elseif($file->isText()): ?>
        <?php echo $this->cell('Markdown', [$file->File->read()]); ?>
    <?php elseif($file->isCompressed()): ?>
        <div class="alert alert-info"><?php echo __('This is a compressed file, you can extract it to the current node.'); ?></div>
    <?php else: ?>
        <div class="alert alert-warning"><?php echo __('Could not display preview..'); ?></div>
    <?php endif; ?>
</div>
