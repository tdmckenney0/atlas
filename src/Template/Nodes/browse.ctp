<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Browse</a>
    </li>
    <li class="nav-item"><?= $this->Html->link(__('Add Node'), ['action' => 'add'], ['class' => 'nav-link']) ?></li>
    <li class="nav-item"><?= $this->Html->link(__('Upload File'), ['controller' => 'Files', 'action' => 'add'], ['class' => 'nav-link']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [$node->id]); ?>

<div class="nodes table-responsive">
    <table cellpadding="0" cellspacing="0" class="table table-hover ">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="text-right"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($node->child_nodes as $child): ?>
                <tr>
                    <td>📁 <?= $this->Html->link($child->name, ['action' => 'browse', $child->id], ['class' => 'font-weight-bolder']) ?></td>
                    <td><?= h($child->modified) ?></td>
                    <td class="text-right">
                        <div class="btn-group ">
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $child->id], ['class' => 'btn  btn-warning']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $child->id], ['confirm' => __('Are you sure you want to delete # {0}?', $child->id), 'class' => 'btn  btn-danger']) ?>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            <tr>
                <td>🔍 <?= $this->Html->link('Overview', ['action' => 'view', $node->id], ['class' => '']) ?></td>
                <td><?= h($node->modified) ?></td>
                <td class="btn-group">
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $node->id], ['class' => 'btn  btn-warning']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $node->id], ['confirm' => __('Are you sure you want to delete # {0}?', $node->id), 'class' => 'btn  btn-danger']) ?>
                </td>
            </tr>

            <?php foreach ($node->files as $file): ?>
            <tr>
                <td>🔩 <?= $this->Html->link($file->name, ['controller' => 'files', 'action' => 'view', $file->id], ['class' => 'font-italic']) ?></td>
                <td>Add Modified</td>


            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
