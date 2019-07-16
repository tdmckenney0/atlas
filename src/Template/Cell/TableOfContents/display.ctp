<?php if(!empty($nodes)): ?>
    <ul class="menu-list">
        <?php echo $this->cell('TableOfContents::child', [$nodes]); ?>
    </ul>
<?php endif; ?>
