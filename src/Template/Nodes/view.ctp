<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node $node
 */
?>
<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Nodes/actions', ['node' => $node]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <?php echo $this->element('Nodes/section', compact('node', 'nodeRevision')); ?>

    <div class="columns">
        <?php $tree = (string) $this->cell('NodeTree', [$node]); ?>

        <?php if (!empty($tree)): ?>
            <div class="column is-one-third"> 
                <div id="<?php echo ('node-tree-' . $node->id); ?>" class="box">
                    <?php echo $tree; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="column">
            <?php if(empty($node->print)): ?>
                <article class="message is-info" role="error">
                    <div class="message-body"><?php echo __('This node will not be printed'); ?></div>
                </article>
            <?php endif; ?>

            <?php echo $this->cell('FileTile::tesselate', [$node->files, 3]); ?>

            <?php if(count($comments) > 0): ?>
                <div class="box">
                    <?php foreach($comments as $comment): ?>
                        <?php echo $this->cell('Comments', [$comment]); ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="box">
                <h2 class="title is-3"><?= __('Add Comment') ?></h3>
                <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node->id]]) ?>
                    <?php echo $this->Form->control('body', ['label' => false]);  ?>
                    <?= $this->Form->submit(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
