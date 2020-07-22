<p class="menu-label"><?php echo __('Browser'); ?></p>
<ul class="menu-list">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-book"></i>
            </span>&nbsp;<?php echo __('All Nodes'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-file"></i>
            </span>&nbsp;<?php echo __('All Files'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-user"></i>
            </span>&nbsp;<?php echo __('All Users'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'NodeRevisions', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-clock"></i>
            </span>&nbsp;<?php echo __('All Revisions'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-comments"></i>
            </span>&nbsp;<?php echo __('All Comments'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'recycled']); ?>">
            <span class="icon">
                <i class="fas fa-recycle"></i>
            </span>&nbsp;<?php echo __('Recycle Bin'); ?>
        </a>
    </li>
</ul>
