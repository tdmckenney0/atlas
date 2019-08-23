<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment[]|\Cake\Collection\CollectionInterface $nodeComments
 */
?>
<div class="container-fluid">
    <h1 class="title is-1"><?= __('Comments') ?></h1>

    <div class="box">
        <?php foreach ($nodeComments as $nodeComment): ?>
            <?php echo $this->cell('Comments', [$nodeComment]); ?>
        <?php endforeach; ?>
    </div>

    <?php echo $this->element('pager'); ?>
</div>
