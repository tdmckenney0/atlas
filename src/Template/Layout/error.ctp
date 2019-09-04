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

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <style type="text/css">

        @font-face {
            font-family: 'microgramma-bold';
            src: url('/font/microgramma-bold.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        h1,h2,h3,legend, .mg-bold,.menu-label {
            font-family: "microgramma-bold", system-ui, sans-serif;
            letter-spacing: 0.05em;
        }

    </style>

    <?php echo $this->Html->css('bulma-0.7.5/css/bulma.min'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <section class="hero is-primary is-fullheight">
        <div class="hero-body">
            <div class="container-fluid">
                <div class="columns is-vcentered">
                    <div class="column is-two-thirds">
                        <h1 class="title">
                            Atlas
                            <!-- <?php echo $this->Html->image('atlas_white.png'); ?> -->
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
