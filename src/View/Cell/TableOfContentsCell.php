<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * TableOfContents cell
 */
class TableOfContentsCell extends Cell
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
    public function display()
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
            ])->toArray();
            $this->set(compact('nodes'));
        }
    }

    /**
     * Child Display Method.
     *
     * @return void
     */
    public function child($nodes)
    {
        $this->set(compact('nodes'));
    }
}
