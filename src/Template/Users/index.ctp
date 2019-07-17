<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<ul class="menu-list">
    <li class=""><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index'], ['class' => '']) ?></li>
    <li class=""><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => '']) ?></li>
    <li class="">
        <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">List Users</a>
    </li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb'); ?>

<div class="nodes">
    <div class="list-group">
        <?php foreach ($users as $user): ?>
            <?php echo $this->element('browser_item', [
                'url' => ['action' => 'view', $user->id],
                'title' => $user->email,
                'body' => substr($user->email, 0, 200),
                'icon' => 'fas fa-user',
                'class' => ""
            ]); ?>
        <?php endforeach; ?>

        <?php echo $this->element('browser_item', [
            'url' => ['action' => 'add'],
            'title' => __('Add User'),
            'body' => __('Add a new User'),
            'icon' => 'fas fa-user-plus',
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
