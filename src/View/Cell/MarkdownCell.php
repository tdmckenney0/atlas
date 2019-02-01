<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Markdown cell
 */
class MarkdownCell extends Cell
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
    public function display(string $body = null)
    {
        if(!empty($body)) {
            $pipes = [];

            $res = proc_open('pandoc -f markdown -t html', [
                ["pipe", "r"],
                ["pipe", "w"],
            ], $pipes, TMP);

            if(is_resource($res)) {

                fwrite($pipes[0], $body);
                fclose($pipes[0]);

                $rendered = stream_get_contents($pipes[1]);
                fclose($pipes[1]);

                proc_close($res);

                $this->set(compact('rendered'));
            }
        }
    }
}
