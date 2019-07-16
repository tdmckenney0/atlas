<div class="box">
    <a href="<?php echo $this->Url->build($url); ?>"  class="<?= !empty($class) ? h($class) : ''; ?>" class="is-primary">
        <article class="media">
            <figure class="media-left">
                <i class="mr-3 <?= !empty($icon) ? h($icon) : 'fas fa-question'; ?>" style="font-size: 3rem; width: 3rem; height: 3rem;"></i>
            </figure>
            <div class="media-content">
                <h5 class="mt-0"><?= h($title) ?></h5>
                <div class="text-muted"><?php echo h(str_ireplace(['*', '#', '-'], '', $body)); ?>...</div>
            </div>
        </article>
    </a>
</div>
