<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<ul class="nav nav-tabs">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Browse</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Add Node'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Upload File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
</ul>

<?php echo $this->cell('Breadcrumb'); ?>

<div class="nodes">
    <table cellpadding="0" cellspacing="0" class="table table-sm table-striped table-hover">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nodes as $node): ?>
            <tr>
                <td>📁 <?= $this->Html->link($node->name, ['action' => 'browse', $node->id], ['class' => '']) ?></td>
                <td><?= h($node->created) ?></td>
                <td><?= h($node->modified) ?></td>
                <td class="btn btn-group">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $node->id], ['class' => 'btn btn-sm btn-warning']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'btn btn-sm btn-danger']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
