<?php foreach($comments as $comment): ?>

    <!-- <div class="media p-1">
        <div class="media-body">
            <h5 class="mt-0"><?php echo h($comment->user->email); ?></h5>
            <div class="border rounded">
                <div class="clearfix">
                    <p class="float-left p-3"><?php echo h($comment->body); ?></p>
                    <div class="btn-group-vertical float-right">
                        <?= $this->Html->link(__('Reply'), ['controller' => 'NodeComments', 'action' => 'reply', $comment->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Html->link(__('Edit'), ['controller' => 'NodeComments', 'action' => 'edit', $comment->id], ['class' => 'btn btn-warning']) ?>
                        <?= $this->Form->postLink(__('Delete'), ['controller' => 'NodeComments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'btn btn-danger']) ?>
                    </div>
                </div>
            </div>

        </div>
    </div> -->


    <div class="border rounded mt-3">
        <div class="clearfix">
            <div class="media p-3">
                <img src="..." class="mr-3" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><?php echo h($comment->user->email); ?></h5>
                    <p><?php echo h($comment->body); ?></p>
                </div>
            </div>
            <div class="btn-group float-right">
                <?= $this->Html->link(__('Reply'), ['controller' => 'NodeComments', 'action' => 'reply', $comment->id], ['class' => 'btn btn-primary']) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'NodeComments', 'action' => 'edit', $comment->id], ['class' => 'btn btn-warning']) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'NodeComments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>

    <div class="ml-5">
        <?php echo $this->element('comments', ['comments' => $comment->children]); ?>
    </div>

<?php endforeach; ?>
