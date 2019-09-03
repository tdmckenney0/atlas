<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>
<div class="container">
    <h1 class="title is-1"><?php echo __('Reply'); ?></h1>
    <?= $this->Form->create($nodeComment) ?>
        <?php echo $this->Form->control('body');  ?>
        <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
