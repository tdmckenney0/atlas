<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->start('actions'); ?>
    <ul class="menu-list">
        <li><?= $this->Html->link(__('Overview'), ['action' => 'view', $user->id], ['class' => '']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => '']) ?></li>
        <li>
            <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit User</a>
        </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => ' text-danger border border-danger']) ?></li>
    </ul>
<?php echo $this->end(); ?>

<div class="container">
    <h1 class="is-1 title"><?= __('Edit {0}', $user->email) ?></h1>
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
