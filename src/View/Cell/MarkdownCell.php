<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * Markdown cell
 */
class MarkdownCell extends Cell
{
    /**
     * Pandoc Command Constant
     */
    const PANDOC_COMMAND = 'pandoc -f markdown -t html';

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
     * @param string The Markdown text to render
     * @param bool True to trigger the --self-contained flag for pandoc
     *
     * @return void
     */
    public function display(string $body = null, bool $selfContained = false)
    {
        if(!empty($body)) {
            $pipes = [];
            $cmd = self::PANDOC_COMMAND;

            if($selfContained) {
                $cmd .= ' --self-contained';
            }

            $res = proc_open($cmd, [
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
