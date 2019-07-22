<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-folder"></i>
                </span>&nbsp;<?php echo __('List Nodes'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-file-alt"></i>
                </span>&nbsp;<?php echo __('List Files'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-user"></i>
                </span>&nbsp;<?php echo __('List Users'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<h1 class="title is-1"><?php echo __('Files'); ?></h1>

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
        <ul class="pagination-list justify-content-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
