<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>
<div class="nodeComments">
    <?= $this->Form->create($nodeComment) ?>
        <?php echo $this->Form->control('body');  ?>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
