<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\File[]|\Cake\Collection\CollectionInterface $files
 */
?>
<?php $this->start('navbar'); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-medical', 'text' => 'Add File', 'link' => ['action' => 'add']]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?php echo __('Recycle Bin'); ?></h1>
        <?php echo $this->element('search'); ?>
    </div>

    <?php echo $this->cell('FileTile::tesselate', [$files]); ?>

    <?php echo $this->element('pager'); ?>
</div>