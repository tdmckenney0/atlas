<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-user-plus', 'text' => 'Add User', 'link' => ['action' => 'add']]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-user-edit', 'text' => 'Edit User', 'link' => ['action' => 'edit', $user->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-user', 'text' => 'Show User', 'link' => ['action' => 'view', $user->id]]); ?>
        <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete User', 'postLink' => ['action' => 'delete', $user->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $user->email)]]); ?>
    </ul>
<?php echo $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title"><?= __('Edit {0}', $user->email) ?></h1>
        <?= $this->Form->create($user) ?>
            <?php
                echo $this->Form->control('email');
                echo $this->Form->control('password');
            ?>
        <?= $this->Form->submit(__('Submit')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
