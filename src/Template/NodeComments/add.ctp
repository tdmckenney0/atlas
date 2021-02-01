<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container-fluid">
    <?php echo $this->cell('Breadcrumb::fromNode', [$node, [__('Add Comment')]]); ?>

    <?php if(!empty($parentComment)): ?>
        <div class="box">
            <h1 class="title"><?php echo __('Replying to'); ?></h1>
            <?php echo $this->cell('Comments', [$parentComment]); ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <h1 class="title"><?php echo __('Add Comment'); ?></h1>
        <?= $this->Form->create($nodeComment) ?>
            <?php echo $this->Form->control('body', ['label' => false]);  ?>
            <?= $this->Form->submit(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
