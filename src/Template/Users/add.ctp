<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="container box">
    <h1 class="is-1 title"><?= __('Add User') ?></h1>
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
