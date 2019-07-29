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
     *
     */
    protected static $currentNode = null;

    /**
     * Initialization logic run at the end of object construction.
     *
     * @return void
     */
    public function initialize()
    {

    }

    /**
     * setCurrentNode
     */
    public static function setCurrentNode(Node $node)
    {
        static::$currentNode = $node;
    }

    /**
     * Default display method.
     *
     * @return void
     */
    public function display(string $field = 'node_id')
    {
        $user = $this->request->getSession()->read('Auth.User.id');
        if(!empty($user)) {
            $this->loadModel('Nodes');
            $nodes = $this->Nodes->find('threaded', [
                'contain' => [
                    'Files' => [
                        'sort' => ['Files.name' => 'ASC']
                    ]
                ],
                'order' => ['Nodes.name' => 'ASC']
            ])->all();

            $path = null;

            if (!empty(static::$currentNode)) {
                $path = $this->Nodes->find('path', ['for' => static::$currentNode->id])->all()->extract('id');
            }

            $this->set(compact('nodes', 'path', 'field'));
        }
    }

    /**
     * Child Display Method.
     *
     * @return void
     */
    public function child($nodes = null, $path = null, string $field = 'node_id')
    {
        $this->set(compact('nodes', 'path', 'field'));
    }
}
