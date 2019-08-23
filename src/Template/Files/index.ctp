<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>

<div class="container">
    <h1 class="title is-1"><?php echo __('Files'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$files) {
        foreach($files as $file) {
            $entry = new stdClass;
            $entry->title = $file->name;
            $entry->subtitle = __('Created: {0}, Modified: {1}, MIME Type: {2}', '?', '?', $file->mime_type);
            $entry->icon = 'fa-file';
            $entry->href = $this->Url->build(['controller' => 'files', 'action' => 'view', $file->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
