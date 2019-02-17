<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\NodeRevision[]|\Cake\Collection\CollectionInterface $nodeRevisions
 */
?>
<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item"><?= $this->Html->link(__('Overview'), ['controller' => 'Nodes', 'action' => 'view', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo __('List Revisions'); ?></a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Edit Node'), ['controller' => 'Nodes', 'action' => 'edit', $node->id], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Export to PDF'), ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'pdf'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Form->postLink(__('Delete Node'), ['controller' => 'Nodes', 'action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'flex-lg-fill text-sm-center nav-link text-danger border border-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [$node->id, __('Revisions')]) ; ?>

<div class="nodeRevisions">
    <?php if(!$nodeRevisions->isEmpty()): ?>
        <div class="list-group">
            <?php foreach ($nodeRevisions as $nodeRevision): ?>
                <?php echo $this->element('browser_item', [
                    'url' => ['action' => 'view', $nodeRevision->id],
                    'title' => $nodeRevision->created,
                    'body' => __('Created By: {0}', (!empty($nodeRevision->user->email) ? $nodeRevision->user->email : 'Atlas')),
                    'icon' => 'fas fa-clock',
                    'class' => ""
                ]); ?>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info"><?php echo __('There are no revisions for this node. Edit it to create one!'); ?></div>
    <?php endif; ?>

    <nav class="paginator mt-3">
        <ul class="pagination justify-content-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
