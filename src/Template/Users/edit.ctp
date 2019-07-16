<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<ul class="">
    <li class=""><?= $this->Html->link(__('Overview'), ['action' => 'view', $user->id], ['class' => '']) ?></li>
    <li class=""><?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => '']) ?></li>
    <li class="">
        <a class=" active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Edit User</a>
    </li>
    <li class=""><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => ' text-danger border border-danger']) ?></li>
</ul>

<hr />

<?php echo $this->cell('Breadcrumb', [null, $user->id]); ?>

<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
