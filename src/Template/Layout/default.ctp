<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, user-scalable=no">
    <title>
        <?php echo __('Atlas: Collaboration System'); ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', '/img/xenolith_icon_white.png') ?>

    <?php $this->Html->script('sidebar', ['block' => true]); ?>

    <?php $this->Html->css(['default', 'fontawesome', 'microgramma'], ['block' => true]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="columns" style="min-height: 100vh !important; margin: 0 !important;">
        <aside class="column is-3 has-background-primary" role="navigation" aria-label="main navigation" style="padding: 0;">
            <nav class="navbar is-primary">
                <div class="navbar-brand">
                    <a class="navbar-item" href="<?php echo $this->Url->build('/'); ?>">
                        <?php echo $this->Html->image('atlas_white.png'); ?>
                    </a>

                    <a id="sidebar-toggle" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                </div>
            </nav>
            <div class="menu is-hidden-mobile has-text-light is-clipped" id="sidebar-menu" style="padding: 1em;">

                <?php if($this->fetch('actions')): ?>
                    <p class="menu-label">Actions</p>
                    <?php echo $this->fetch('actions'); ?>
                <?php endif; ?>

                <?php if($this->fetch('nodes')): ?>
                    <p class="menu-label">Nodes</p>
                    <?php echo $this->fetch('nodes'); ?>
                <?php endif; ?>

                <?php if($this->fetch('files')): ?>
                    <p class="menu-label">Files</p>
                    <?php echo $this->fetch('files'); ?>
                <?php endif; ?>

                <p class="menu-label">Navigation</p>
                <?php echo $this->cell('TableOfContents'); ?>
            </div>
        </aside>
        <main class="column is-9 has-background-white" style="">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <?php echo $this->element('thinking'); ?>
        </main>
    </div>
</body>
</html>
