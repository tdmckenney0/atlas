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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo __('Atlas: Collaboration System'); ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon', '/img/xenolith_icon_white.png') ?>

    <?php echo $this->Html->css(['default', 'fontawesome', 'microgramma'], ['block' => true]); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-two-thirds">
                        <h1 class="title">
                            Atlas
                        </h1>
                        <h2 class="subtitle">
                            Xenolith Collaboration System
                        </h2>
                    </div>
                    <div class="column">
                        <div class="box">
                            <?= $this->Flash->render() ?>
                            <?= $this->fetch('content') ?>
                            <?php echo $this->element('thinking'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
