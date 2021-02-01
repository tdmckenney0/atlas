<?php if(!empty($postLink)): ?>
    <?php echo $this->Form->postLink('<span class="icon"><i class="' . $icon . '"></i></span>&nbsp;&nbsp;' . __($text), $postLink, array_merge(['escape' => false], ($linkOptions ?? []), ['class' => 'navbar-item'])); ?>
<?php else: ?>
    <?php echo $this->Html->link('<span class="icon"><i class="' . $icon . '"></i></span>&nbsp;&nbsp;' . __($text), $link, array_merge(['escape' => false], ($linkOptions ?? []), ['class' => 'navbar-item'])); ?>
<?php endif; ?>
