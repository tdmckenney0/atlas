<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Node[]|\Cake\Collection\CollectionInterface $nodes
 */
?>

<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-folder"></i>
                </span>&nbsp;<?php echo __('List Nodes'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-file-alt"></i>
                </span>&nbsp;<?php echo __('List Files'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
                <span class="icon">
                    <i class="fas fa-user"></i>
                </span>&nbsp;<?php echo __('List Users'); ?>
            </a>
        </li>
    </ul>
<?php $this->end(); ?>

<h1 class="title is-1"><?php echo __('Nodes'); ?></h1>

<div class="nodes">
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

    <nav class="paginator mt-3">
        <ul class="pagination-list">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
