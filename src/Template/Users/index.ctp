<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
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

<h1 class="title is-1"><?php echo __('Users'); ?></h1>

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
        <ul class="pagination-list justify-content-center">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p class="text-center text-muted"><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </nav>
</div>
