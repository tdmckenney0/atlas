<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="container">
    <h1 class="title is-1"><?php echo __('Users'); ?></h1>

    <?php echo $this->element('search'); ?>

    <?php echo $this->cell('Browser', [function() use (&$users) {
        foreach($users as $user) {
            $entry = new stdClass;
            $entry->title = $user->email;
            $entry->subtitle = $user->created;
            $entry->icon = 'fa-user';
            $entry->href = $this->Url->build(['action' => 'view', $user->id]);

            yield $entry;
        }
    }]); ?>

    <?php echo $this->element('pager'); ?>
</div>
