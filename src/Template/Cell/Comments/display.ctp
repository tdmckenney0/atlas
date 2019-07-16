<div class="content">
    <h2><?= __('Comments') ?></h2>
    <?php echo $this->element('comments', ['comments' => $comments]); ?>

    <div class="nodeComments mt-3">
        <h4><?= __('Add Comment') ?></h4>
        <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node_id]]) ?>
            <?php echo $this->Form->control('body', ['label' => false]);  ?>
            <?= $this->Form->button(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
