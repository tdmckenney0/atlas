<?php if($file->isImage()): ?>
    <div class="p-3">
        <?php echo $this->Html->image($this->Url->build(['controller' => 'files', 'action' => 'get', $file->id]), ['class' => 'img-fluid']); ?>
    </div>
<?php elseif($file->isText()): ?>
    <?php echo $this->cell('Markdown', [$file->File->read()]); ?>
<?php else: ?>
    <?php echo $this->Html->link('Download File', ['controller' => 'files', 'action' => 'get', $file->id], ['class' => 'btn btn-primary']); ?>
<?php endif; ?>
