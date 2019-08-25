<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\Node;

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
    public function display(array $items = [])
    {
        $this->set('items', $items);
        $this->set('last', end($items));
    }

    /**
     *  Start with a trace up to the top-level node.
     *
     *  @param Node The node to start tracing from.
     *  @param array Additional items to be appended.
     */
    public function fromNode(Node $node = null, array $append = [])
    {
        $items = [];

        if (!empty($node)) {
            $path = $node->getPath();

            if (count($path) > 0) {
                foreach ($path as $node) {
                    $items[$node->name] = ['controller' => 'nodes', 'action' => 'view', $node->id];
                }
            }
        }

        $items += $append;
        $last = end($items);

        $this->template = 'display';
        $this->set(compact('items', 'last'));
    }
}
