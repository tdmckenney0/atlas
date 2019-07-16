<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>

<ul class="">
    <li class=""><?= $this->Html->link(__('List Nodes'), ['controller' => 'Nodes', 'action' => 'index'], ['class' => '']) ?></li>
    <li class=""><?= $this->Html->link(__('List Files'), ['controller' => 'Files', 'action' => 'index'], ['class' => '']) ?></li>
    <li class=""><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => '']) ?></li>
    <li class="">
        <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add User</a>
    </li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb'); ?>

<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
