<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment[]|\Cake\Collection\CollectionInterface $nodeComments
 */
?>
<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?php echo __('Comments'); ?></h1>
        <?php echo $this->element('search'); ?>
    </div>

    <?php foreach ($nodeComments as $nodeComment): ?>
        <div class="box">
            <?php echo $this->cell('Comments', [$nodeComment]); ?>
        </div>
    <?php endforeach; ?>

    <?php echo $this->element('pager'); ?>
</div>
