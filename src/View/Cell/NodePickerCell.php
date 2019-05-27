<?php
namespace App\View\Cell;

use Cake\View\Cell;
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
    public function display(Node $node = null, Array $options = [])
    {
        if (!isset($options['top'])) {
            $options['top'] = true;
        }
        if (!empty($options['value']) && is_string($options['value'])) {
            $this->loadModel('Nodes');
            $options['value'] = $this->Nodes->get($options['value']);
        }
        if (!empty($options['this']) && is_string($options['this'])) {
            $this->loadModel('Nodes');
            $options['this'] = $this->Nodes->get($options['this']);
        }
        if ($node === null) {
            $this->loadModel('Nodes');
            $nodes = $this->Nodes->find('all', [
                'conditions' => ['Nodes.parent_id IS' => null],
                'order' => ['Nodes.name' => 'ASC']
            ])->toArray();
            $this->set(compact('nodes'));
        } else {

            if (empty($node->child_nodes)) {
                $node->lazyLoad([
                    'ChildNodes'
                ]);
            }
            $this->set('nodes', $node->child_nodes);
            $this->set('current', $node);
        }
        $this->set('options', $options);
    }
}
