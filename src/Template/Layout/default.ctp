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

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('textarea').each(function(e) {
                this.EasyMDE = new EasyMDE({
                    element: $(this).get(0)
                });
            });
        });
    </script>

    <style type="text/css">

        @font-face {
            font-family: 'microgramma-bold';
            src: url('/font/microgramma-bold.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        h1,h2,h3,legend, .mg-bold {
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
    <div class="container">
        <div class="columns">
            <aside class="is-primary column is-4 menu">

                    <figure class="image" href="<?php echo $this->Url->build('/'); ?>">
                        <?php echo $this->Html->image('atlas_white.png', [
                            'height' => 30
                        ]); ?>
                    </figure>
                <p class="menu-label">Actions</p>
                <?php echo $this->fetch('actions'); ?>

                <p class="menu-label">Navigation</p>
                <?php echo $this->cell('TableOfContents'); ?>
            </aside>
            <main class="column is-8">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>
    <?php echo $this->element('thinking'); ?>
</body>
</html>
