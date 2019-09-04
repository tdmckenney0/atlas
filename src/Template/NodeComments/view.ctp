<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeComment $nodeComment
 */
?>

<?php $this->start('actions'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $nodeComment->node]); ?>
<?php $this->end(); ?>

<?php $this->Html->css(['https://unpkg.com/easymde/dist/easymde.min.css'], ['block' => true]); ?>
<?php $this->Html->script(['https://unpkg.com/easymde/dist/easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container-fluid">

    <?php echo $this->cell('Breadcrumb::fromNode', [$nodeComment->node, [__('View Comment')]]); ?>

    <?php if(!empty($nodeComment->parent_node_comment)): ?>
        <div class="box">
            <h1 class="title"><?php echo __('In reply to'); ?></h1>
            <?php echo $this->cell('Comments', [$nodeComment->parent_node_comment]); ?>
        </div>
    <?php endif; ?>

    <div class="box">
        <?php echo $this->cell('Comments', [$nodeComment]); ?>
    </div>
</div>
