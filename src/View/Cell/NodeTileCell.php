<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\Node;

/**
 * NodeTile cell
 */
class NodeTileCell extends Cell
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
     * @param Node The Node to Display in the tile. 
     * @param string Optional. Link text.
     * @param array Optional, required for link to display. URL Array.
     * @param bool If the link should be a POST instead of a GET. Default false. 
     *
     * @return void
     */
    public function display(Node $node, string $linkName = null, array $linkUrl = null, bool $postLink = false)
    {
        $this->set(compact('node', 'linkName', 'linkUrl', 'postLink'));
    }

    /**
     * Tesselate a collection of Nodes. 
     * 
     * @param Traversable|array must yield or contain Node classes. 
     * @param int Optional. Column count; Max 12. Defaults to 4.
     * @param string Optional. Link text. Passed to Cake's __() function, with {0} being the node name. 
     * @param callable Optional. Function that is passed each Node instance, and must return a URL array. 
     * @param bool Optional. True to make into a post link. Defaults to false. 
     * 
     * @return void
     */
    public function tesselate($t, int $columns = 4, string $linkName = 'View {0}', callable $linkGenerator = null, bool $postLink = false)
    {
        if (!is_array($t) && !($t instanceof \Traversable)) {
            throw new InvalidArgumentException('Not an array or traversable object!');            
        }

        if (empty($linkGenerator)) {
            $linkGenerator = function (Node $node): array {
                // Default to the Node View. 
                return ['controller' => 'nodes', 'action' => 'view', $node->id];
            };
        }

        $collected = collection($t);
        $columns = ($columns % 12); // Max 12 columns. 

        $nodes = $collected->filter(function ($n) {
            return $n instanceof Node;
        });

        $grouped = $nodes->reduce(function ($carry, $v, $k) use (&$columns) {          
            $carry[($k) % $columns][] = $v;
    
            return $carry;
        }, []);

        $this->set(compact('grouped', 'columns', 'linkName', 'linkGenerator', 'postLink'));
    }
}
