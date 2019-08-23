<li>
    <?php if(!empty($postLink)): ?>
        <?php echo $this->Form->postLink('<span class="icon"><i class="' . $icon . '"></i></span>&nbsp;' . __($text), $postLink, array_merge(['escape' => false], ($linkOptions ?? []))); ?>
    <?php else: ?>
        <?php echo $this->Html->link('<span class="icon"><i class="' . $icon . '"></i></span>&nbsp;' . __($text), $link, array_merge(['escape' => false], ($linkOptions ?? []))); ?>
    <?php endif; ?>
</li>
