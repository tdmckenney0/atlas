<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Comments cell
 */
class CommentsCell extends Cell
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
    public function display($node_id = null)
    {
        if(!empty($node_id)) {
            $this->loadModel('NodeComments');
            $nodeComment = $this->NodeComments->newEntity();
            $comments = $this->NodeComments->find('threaded', [
                'conditions' => ['node_id' => $node_id],
                'contain' => ['Users']
            ]);
            $this->set(compact('comments', 'nodeComment', 'node_id'));
        }
    }

    /**
     * Comment display method.
     *
     * @return void
     */
    public function comment($comments = null)
    {
        $this->set(compact('comments'));
    }
}
