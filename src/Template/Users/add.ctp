<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<?php $this->Html->css('easymde.min.css', ['block' => true]); ?>
<?php $this->Html->script(['easymde.min.js', 'enable-easymde'], ['block' => true]); ?>

<div class="container box">
    <h1 class="title"><?= __('Add User') ?></h1>
    <?= $this->Form->create($user) ?>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('email');
            echo $this->Form->control('location');
            echo $this->Form->control('timezone');
            echo $this->Form->control('password');
            echo $this->Form->control('about');
        ?>
    <?= $this->Form->submit(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
