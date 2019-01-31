<?php foreach($comments as $comment): ?>

    <div class="card mt-3">
        <div class="card-header font-weight-bold"><?php echo h($comment->user->email); ?></div>
        <div class="card-body"><?php echo h($comment->body); ?></div>
        <div class="card-footer">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <?= $this->Html->link(__('Reply'), ['controller' => 'NodeComments', 'action' => 'reply', $comment->id], ['class' => 'nav-link border border-primary']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link(__('Edit'), ['controller' => 'NodeComments', 'action' => 'edit', $comment->id], ['class' => 'nav-link text-secondary']) ?>
                </li>
                <li class="nav-item">
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'NodeComments', 'action' => 'delete', $comment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $comment->id), 'class' => 'nav-link text-danger']) ?>
                </li>
            </ul>
        </div>
    </div>

    <div class="ml-lg-5">
        <?php echo $this->element('comments', ['comments' => $comment->children]); ?>
    </div>

<?php endforeach; ?>
