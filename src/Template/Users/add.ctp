<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<div class="container box">
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
