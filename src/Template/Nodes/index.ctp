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
    <li class="nav-item"><?= $this->Html->link(__('New Node'), ['action' => 'add'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('New File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'flex-lg-fill text-sm-center nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb'); ?>

<div class="nodes">
    <div class="card">
        <?php foreach ($nodes as $node): ?>
            <div class="media p-3 border-bottom">
                <i class="mr-3 fas fa-folder " style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
                <div class="media-body">
                    <h5 class="mt-0"><?= $this->Html->link($node->name, ['action' => 'view', $node->id]) ?></h5>
                    <div class="text-muted"><?php echo h(substr($node->description, 0, 128)); ?>...</div>
                </div>
            </div>
        <?php endforeach; ?>
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
