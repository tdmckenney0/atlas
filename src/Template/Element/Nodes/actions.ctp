<?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-book-reader', 'text' => 'Read', 'link' => ['controller' => 'Nodes', 'action' => 'reader', $node->id]]); ?>

<div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link">
        <span class="icon">
            <i class="fas fa-plus-circle"></i>
        </span>
        &nbsp;<?php echo __('Add'); ?></a></span>
    <div class="navbar-dropdown">
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-book-medical', 'text' => 'Node', 'link' => ['controller' => 'Nodes', 'action' => 'add', $node->id]]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-upload', 'text' => 'File', 'link' => ['controller' => 'Files', 'action' => 'add', $node->id]]); ?>
    </div>
</div>

<?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-edit', 'text' => 'Edit', 'link' => ['controller' => 'Nodes', 'action' => 'edit', $node->id]]); ?>
<?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-exchange-alt', 'text' => 'Change Parent', 'link' => ['controller' => 'Nodes', 'action' => 'adopt', $node->id]]); ?>
<?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-clock', 'text' => 'Show Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $node->id]]); ?>

<div class="navbar-item has-dropdown is-hoverable">
    <a class="navbar-link">
        <span class="icon">
            <i class="fas fa-file-export"></i>
        </span>
        &nbsp;<?php echo __('Export'); ?></a></span>
    <div class="navbar-dropdown">
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-pdf', 'text' => 'PDF', 'link' => ['controller' => 'Nodes', 'action' => 'export', $node->id, '_ext' => 'pdf']]); ?>
        <?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-file-archive', 'text' => 'Zip', 'link' => ['controller' => 'Nodes', 'action' => 'export', $node->id, '_ext' => 'zip']]); ?>
    </div>
</div>

<?php echo $this->element('Navbar/linkitem', ['icon' => 'fas fa-trash', 'text' => 'Delete', 'postLink' => ['controller' => 'Nodes', 'action' => 'delete', $node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $node->name)]]); ?>
