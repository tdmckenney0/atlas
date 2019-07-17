<?php if(!empty($comments)): ?>
    <?php foreach($comments as $comment): ?>
        <article class="media">
            <figure class="media-left">
                <!-- <p class="image is-32x32">
                    <img src="/img/xenolith_icon_white.png">
                </p> -->
            </figure>
            <div class="media-content">
                <div class="content">
                    <p>
                        <strong><?php echo h($comment->user->email); ?></strong>
                        <br>
                        <?php echo $this->cell('Markdown', [$comment->body]); ?>
                    </p>
                </div>
                <nav class="level is-mobile">
                    <div class="level-left">
                        <a class="level-item" href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'add', $comment->node_id, $comment->id]); ?>">
                            <span class="icon is-small"><i class="fas fa-reply"></i></span>&nbsp;&nbsp;<?php echo __('Reply'); ?>
                        </a>
                        <a class="level-item" href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'edit', $comment->id]); ?>">
                            <span class="icon is-small"><i class="fas fa-edit"></i></span>&nbsp;&nbsp;<?php echo __('Edit'); ?>
                        </a>
                        <?= $this->Form->postLink('<span class="icon is-small"><i class="fas fa-trash"></i></span>&nbsp;&nbsp;' . __('Delete'), ['controller' => 'NodeComments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'level-item has-text-danger', 'escape' => false]) ?>
                    </div>
                </nav>
                <?php echo $this->cell('Comments::comment', [$comment->children]); ?>
            </div>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
