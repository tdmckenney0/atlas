<p class="menu-label">Main Menu</p>
<ul class="menu-list">
    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Nodes', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-book"></i>
            </span>&nbsp;<?php echo __('List Nodes'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Files', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-file"></i>
            </span>&nbsp;<?php echo __('List Files'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-user"></i>
            </span>&nbsp;<?php echo __('List Users'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'NodeRevisions', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-clock"></i>
            </span>&nbsp;<?php echo __('List Revisions'); ?>
        </a>
    </li>

    <li>
        <a href="<?php echo $this->Url->build(['controller' => 'NodeComments', 'action' => 'index']); ?>">
            <span class="icon">
                <i class="fas fa-comments"></i>
            </span>&nbsp;<?php echo __('List Comments'); ?>
        </a>
    </li>
</ul>
