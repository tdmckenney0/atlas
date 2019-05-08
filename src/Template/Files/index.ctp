<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>

<script type="text/javascript">
    $(function() {
        $('.atlas-file-add').unbind('click').click(function(event) {
            event.preventDefault();
            $('.atlas-file-add-form input[type="file"]').click();
        });

        $('.atlas-file-add-form input[type="file"]').change(function() {
            if(atlas.think) atlas.think();
            $(this).parent('form').submit();
        });
    });
</script>

<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item"><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List Files</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb'); ?>

<div class="files">
    <div class="list-group">
        <?php foreach ($files as $file): ?>
            <?php echo $this->element('browser_item', [
                    'url' => ['controller' => 'files', 'action' => 'view', $file->id],
                    'title' => $file->name,
                    'body' => __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type),
                    'icon' => 'fas fa-file-alt',
                    'class' => ""
                ]); ?>
        <?php endforeach; ?>

        <?php echo $this->element('browser_item', [
                'url' => ['controller' => 'Files', 'action' => 'add'],
                'title' => __('Add File'),
                'body' => __('Upload a new top-level file.'),
                'icon' => 'fas fa-plus-circle',
                'class' => "text-primary atlas-file-add"
            ]); ?>

        <?php echo $this->Form->create(null, ['url' => ['controller' => 'Files', 'action' => 'add'], 'type' => 'file', 'class' => 'atlas-file-add-form d-none']) ?>
            <?php $this->Form->unlockField('file'); ?>
            <input type="file" name="file" class="custom-file-input" id="customFile">
        <?php echo $this->Form->end(); ?>
    </div>

    <nav class="paginator mt-3">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
