<li>
    <?php echo $this->Form->postLink('<span class="icon"><i class="' . $icon . '"></i></span>&nbsp;&nbsp;' . __($name), $url, array_merge(['escape' => false], ($options ?? []))); ?>
</li>