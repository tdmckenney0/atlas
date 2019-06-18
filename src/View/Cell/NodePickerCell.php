<?php
namespace App\View\Cell;

use Cake\View\Cell;
use Cake\ORM\ResultSet;
use \App\Model\Entity\Node;

/**
 * NodePicker cell
 */
class NodePickerCell extends Cell
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
    public function display(string $name = 'node_id', string $label = 'Node Picker', $value = [], Node $current = null)
    {
        $this->loadModel('Nodes');

        if (is_string($value)) {
            $value = [$value];
        }

        $nodes = $this->Nodes->find('all', [
            'conditions' => ['Nodes.parent_id IS' => null],
            'order' => ['Nodes.name' => 'ASC']
        ])->all();

        $selected = $this->Nodes->find('all')->where(['id' => $value], ['id' => 'string[]'])->all();

        $this->set(compact('nodes', 'current', 'selected', 'name', 'label'));
    }

    /**
     * Child display method
     *
     * @param Node The node to populate
     * @param Node The current node, if available; A node cannot be its own parent!
     * @param ResultSet ResultSet of currently selected nodes.
     *
     * @return void
     */
    public function child(Node $node, Node $current = null, ResultSet $selected = null)
    {
        if (empty($node->child_nodes)) {
            $node->lazyLoad(['ChildNodes']);
        }

        $is_current = !empty($current) ? ($node->id == $current->id) : false;

        $is_selected = !empty($selected) ? $selected->some(function($v) use ($node) {
            return $v->id == $node->id;
        }) : false;

        $this->set(compact('node', 'current', 'selected', 'is_selected', 'is_current'));
    }
}
