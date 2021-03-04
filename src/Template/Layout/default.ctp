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
<html class="has-navbar-fixed-top">
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0, user-scalable=no">
    <title>
        <?php echo __('Atlas: Collaboration System'); ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', '/img/xenolith_icon_white.png') ?>

    <?php $this->Html->script('navbar', ['block' => true]); ?>

    <?php $this->Html->css(['default', 'fontawesome', 'microgramma'], ['block' => true]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header class="has-background-primary">
        <nav class="navbar is-fixed-top is-primary" role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="<?php echo $this->Url->build('/'); ?>">
                    <?php echo $this->Html->image('atlas_white.png'); ?>
                </a>

                <a id="navbarToggle" role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarMenu">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-start">
                    <?php echo $this->element('Navbar/search'); ?>
                    <?php echo $this->fetch('navbar'); ?>
                </div>
            </div>
        </nav>
    </header>
    <section class="section">
        <main class="container-fluid">
            <?= $this->Flash->render() ?>
            <?= $this->fetch('content') ?>
            <?php echo $this->element('thinking'); ?>
        </main>
    </section>
</body>
</html>
