<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\NodeComment;

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
    public function display(NodeComment $comment)
    {
        $children = [];

        if (empty($comment->user)) {
            $comment->lazyLoad(['Users']);
        }

        if (!empty($comment->children)) {
            $children =& $comment->children;
        } else if (!empty($comment->child_node_comments)) {
            $children =& $comment->child_node_comments;
        }

        $this->set(compact('comment', 'children'));
    }
}
