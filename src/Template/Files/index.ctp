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

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeRevisions', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-clock"></i>
                </span>&nbsp;<?php echo __('List Revisions'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-comments"></i>
                </span>&nbsp;<?php echo __('List Comments'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<div class="container">
    <h1 class="title is-1"><?php echo __('Files'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$files) {
        foreach($files as $file) {
            $entry = new stdClass;
            $entry->title = $file->name;
            $entry->subtitle = __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type);
            $entry->icon = 'fa-file-alt';
            $entry->href = $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
