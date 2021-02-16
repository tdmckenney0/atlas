<section class="section box node-view">
    <div class="block">
        <h1 class="title is-1"><?= h($node->name) ?></h1>
    </div>

    <div class="has-text-justified content block">
        <?php echo $this->cell('Markdown', [$node->description]); ?>
    </div>
    
    <hr />

    <nav class="level is-small">
        <div class="level-left">
            <div class="level-item">
                <?php echo $this->cell('Breadcrumb::fromNode', [$node, $append ?? []]); ?>
            </div>
        </div>

        <div class="level-right">
            <div class="level-item">
                <?php if(!empty($nodeRevision->id)): ?>
                    <div class="is-italic">
                        <?php if(!empty($nodeRevision->user)): ?>
                            <span><?php echo __('Revised by '); ?></span>
                            <?php echo $this->Html->link($nodeRevision->user->name, ['controller' => 'users', 'action' => 'view', $nodeRevision->user->id]); ?>
                            <span><?php echo __('on'); ?></span>
                        <?php else: ?>
                            <span><?php echo __('Revised on '); ?></span>
                        <?php endif; ?>
                        
                        <?php echo $this->Html->link($nodeRevision->created->i18nFormat([\IntlDateFormatter::FULL, \IntlDateFormatter::SHORT]), ['controller' => 'node_revisions', 'action' => 'view', $nodeRevision->id]); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>   
</section>