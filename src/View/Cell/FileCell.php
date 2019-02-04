<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * File cell
 */
class FileCell extends Cell
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
    public function display($file_id = null)
    {
        if(!empty($file_id)) {
            $this->loadModel('Files');
            $file = $this->Files->get($file_id);
            $this->set('file', $file);
        }
    }
}
