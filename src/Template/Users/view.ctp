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
<?php $this->end(); ?>

<div class="container-fluid">
    <div class="box">
        <h1 class="title"><?= h($user->name) ?></h1>
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Location') ?></th>
                    <td><?= h($user->location) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Timezone') ?></th>
                    <td><?= h($user->timezone) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Added') ?></th>
                    <td><?= $user->created->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]); ?></td>
                </tr>
                <tr>
                    <th scope="row"><?= __('Updated') ?></th>
                    <td><?= $user->modified->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <?php if (!empty($user->about)): ?>
        <div class="box">
            <h2 class="title"><?php echo __('About'); ?></h2>
            <?php echo $this->cell('Markdown', [$user->about]); ?>
        </div>
    <?php endif; ?>
</div>
