<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<?php $this->start('navbar'); ?>
    <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-user-plus', 'text' => 'Add User', 'link' => ['action' => 'add']]); ?>
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title is-1"><?php echo __('Users'); ?></h1>
        <?php echo $this->element('search'); ?>
    </div> 

    <?php foreach ($users as $user): ?>
        <article class="media box">
            <div class="media-content">
                <div class="content">
                    <h2><?php echo $user->name; ?></h2>
                    <?php echo $this->cell('LocalTime', [$user]); ?>
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" href="<?php echo $this->Url->build(['action' => 'view', $user->id]); ?>">
                            <span class="icon is-small"><i class="fas fa-reply"></i></span>&nbsp;&nbsp;<?php echo __('View'); ?>
                        </a>
                        <a class="level-item" href="<?php echo $this->Url->build(['action' => 'edit', $user->id]); ?>">
                            <span class="icon is-small"><i class="fas fa-edit"></i></span>&nbsp;&nbsp;<?php echo __('Edit'); ?>
                        </a>
                        <?= $this->Form->postLink('<span class="icon is-small"><i class="fas fa-trash"></i></span>&nbsp;&nbsp;' . __('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete {0}?', $user->name), 'class' => 'level-item has-text-danger', 'escape' => false]) ?>
                    </div>
                </nav>
            </div>
        </article>
    <?php endforeach; ?>

    <?php echo $this->element('pager'); ?>
</div>
