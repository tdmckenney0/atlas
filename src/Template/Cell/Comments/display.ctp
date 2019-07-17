<div class="">
    <h2 class="title is-2"><?= __('Comments') ?></h2>
    <?php echo $this->cell('Comments::comment', [$comments]); ?>

    <hr />

    <h3 class="title is-3"><?= __('Add Comment') ?></h3>
    <?= $this->Form->create($nodeComment, ['url' => ['controller' => 'NodeComments', 'action' => 'add', $node_id]]) ?>
        <?php echo $this->Form->control('body', ['label' => false]);  ?>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>


