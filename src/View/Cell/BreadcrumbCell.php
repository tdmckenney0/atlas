<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Breadcrumb cell
 */
class BreadcrumbCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($id = null, $append = null)
    {
        if(!empty($id)) {
            $this->loadModel('Nodes');
            $nodes = $this->Nodes->find('path', ['for' => $id]);
            $this->set('nodes', $nodes);
            $this->set('last_node', $nodes->last());
        }
        $this->set('append', $append);
    }
}
