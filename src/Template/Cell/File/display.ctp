<?php if($file->isImage()): ?>
    <div class="p-3">
        <?php echo $this->Html->image($this->Url->build(['controller' => 'files', 'action' => 'get', $file->id]), ['class' => 'img-fluid']); ?>
    </div>
<?php elseif($file->isCSV()): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <?php while($row = $file->readlineCSV()): ?>
                <tr>
                    <?php foreach($row as $column): ?>
                        <td><?php echo h($column); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
<?php elseif($file->isText()): ?>
    <?php echo $this->cell('Markdown', [$file->File->read()]); ?>
<?php else: ?>
    <div class="alert alert-warning"><?php echo __('Could not display preview..'); ?></div>
<?php endif; ?>
