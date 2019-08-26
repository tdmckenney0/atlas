<ul class="menu-list">
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-book-medical', 'text' => 'Add Node', 'link' => ['controller' => 'Nodes', 'action' => 'add', $node->id]]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-upload', 'text' => 'Add File', 'link' => ['controller' => 'Files', 'action' => 'add', $node->id]]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-clock', 'text' => 'List Revisions', 'link' => ['controller' => 'NodeRevisions', 'action' => 'index', $node->id]]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-edit', 'text' => 'Edit Node', 'link' => ['controller' => 'Nodes', 'action' => 'edit', $node->id]]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-exchange-alt', 'text' => 'Change Parent', 'link' => ['controller' => 'Nodes', 'action' => 'adopt', $node->id]]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-pdf', 'text' => 'Export to PDF', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'pdf'], 'linkOptions' => ['download' => 'download']]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-file-archive', 'text' => 'Export to Zip', 'link' => ['controller' => 'Nodes', 'action' => 'view', $node->id, '_ext' => 'zip'], 'linkOptions' => ['download' => 'download']]); ?>
    <?php echo $this->element('menulistitem', ['icon' => 'fas fa-trash', 'text' => 'Delete Node', 'postLink' => ['controller' => 'Nodes', 'action' => 'delete', $node->id], 'linkOptions' => ['confirm' => __('Are you sure you want to delete {0}?', $node->name)]]); ?>
</ul>
