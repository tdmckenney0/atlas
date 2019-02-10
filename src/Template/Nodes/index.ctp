<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<ul class="nav nav-pills flex-column flex-lg-row">
    <li class="nav-item">
        <a class="flex-lg-fill text-sm-center nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List Nodes</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb'); ?>

<div class="nodes">
    <div class="list-group">
        <?php foreach ($nodes as $node): ?>
            <?php echo $this->element('browser_item', [
                'url' => ['action' => 'view', $node->id],
                'title' => $node->name,
                'body' => substr($node->description, 0, 200),
                'icon' => 'fas fa-folder',
                'class' => ""
            ]); ?>
        <?php endforeach; ?>

        <?php echo $this->element('browser_item', [
            'url' => ['action' => 'add'],
            'title' => __('Add Node'),
            'body' => __('Add a new top-level Node'),
            'icon' => 'fas fa-folder-plus',
            'class' => "text-primary"
        ]); ?>
    </div>

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
