<a href="<?php echo $this->Url->build($url); ?>"  class="list-group-item list-group-item-action <?= !empty($class) ? h($class) : ''; ?>">
    <div class="media p-1">
        <i class="mr-3 <?= !empty($icon) ? h($icon) : 'fas fa-question'; ?>" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
        <div class="media-body overflow-hidden">
            <h5 class="mt-0"><?= h($title) ?></h5>
            <div class="text-muted"><?php echo h($body); ?>...</div>
        </div>
    </div>
</a>
