<?php

namespace App\View;

use Cake\View\View;

class PdfView extends View
{
    /**
     * Log Path
     */
    const LOG_PATH = LOGS . DS . 'pandoc.log';

    /**
     * JSON views are located in the 'json' sub directory for controllers' views.
     *
     * @var string
     */
    protected $subDir = 'pdf';

    /**
     * Response type.
     *
     * @var string
     */
    protected $_responseType = 'pdf';
    /**
     * The name of the layout file to render the view inside of. The name
     * specified is the filename of the layout in /src/Template/Layout without
     * the .ctp extension.
     *
     * @var string
     */
    public $layout = 'pdf';

    public function render($view = null, $layout = null)
    {
        $body = parent::render($view, $layout);
        $file = TMP . DS . time() . rand() . '.pdf';
        $pipes = [];

        touch($file);

        $res = proc_open('pandoc -f markdown -o ' . $file, [
            ["pipe", "r"],
            ["file", self::LOG_PATH, 'a']
        ], $pipes, TMP);

        if(is_resource($res)) {

            fwrite($pipes[0], $body);
            fclose($pipes[0]);

            proc_close($res);

            $rendered = file_get_contents($file);

            unlink($file);

            return $rendered;
        }
    }
}
