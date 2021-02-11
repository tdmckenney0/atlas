<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\Node;

/**
 * NodeTree cell
 */
class NodeTreeCell extends Cell
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
     * @param Node 
     *
     * @return void
     */
    public function display(Node $node)
    {
        $this->loadModel('Nodes');

        $children = $this->Nodes->find('children', ['for' => $node->id])->find('threaded')->toArray();

        $this->set(compact('node', 'children'));
    }

    /**
     * Node Tree Child
     * 
     * @param Node 
     * 
     * @return void
     */
    public function child(Node $node)
    {
        $this->set(compact('node'));
    }

    /**
     * Menu Link 
     * 
     * @param string Link Name
     * @param string Font awesome icon. 
     * @param Array CakePHP Url 
     * 
     * @return void
     */
    public function menulink(string $name, string $icon, Array $url)
    {
        $this->set(compact('name', 'icon', 'url'));
    }

    /**
     * Post Menu Link 
     * 
     * @param string Link Name
     * @param string Font awesome icon. 
     * @param Array CakePHP Url
     * @param Array Post Link options. 
     * 
     * @return void
     */
    public function postMenulink(string $name, string $icon, Array $url, Array $options)
    {
        $this->set(compact('name', 'icon', 'url', 'options'));
    }
}
