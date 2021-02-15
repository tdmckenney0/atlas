<div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link">
        <span class="icon">
            <i class="fas fa-search"></i>
        </span>
        &nbsp;<?php echo __('Search'); ?></a></span>
    <div class="navbar-dropdown">
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-book', 'text' => 'Nodes', 'link' => ['controller' => 'nodes', 'action' => 'index']]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-clock', 'text' => 'Revisions', 'link' => ['controller' => 'node_revisions', 'action' => 'index']]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file', 'text' => 'Files', 'link' => ['controller' => 'files', 'action' => 'index']]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-comments', 'text' => 'Comments', 'link' => ['controller' => 'node_comments', 'action' => 'index']]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-users', 'text' => 'Users', 'link' => ['controller' => 'users', 'action' => 'index']]); ?>
    </div>
</div>