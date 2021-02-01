<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>

<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $nodeComment->node]); ?>
<?php $this->end(); ?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container-fluid">

    <?php echo $this->cell('Breadcrumb::fromNode', [$nodeComment->node, [__('Edit Comment')]]); ?>

    <?php if(!empty($nodeComment->parent_node_comment)): ?>
        <div class="box">
            <h1 class="title"><?php echo __('Replied to'); ?></h1>
            <?php echo $this->cell('Comments', [$nodeComment->parent_node_comment]); ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <?= $this->Form->create($nodeComment) ?>
        <fieldset>
            <h1 class="title"><?= __('Edit Comment') ?></h1>
            <?php echo $this->Form->control('body', ['label' => false]); ?>
        </fieldset>
        <?= $this->Form->submit(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
