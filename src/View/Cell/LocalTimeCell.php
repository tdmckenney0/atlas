<?php
namespace App\View\Cell;

use Cake\View\Cell;
use App\Model\Entity\User;
use \DateTime;
use \DateTimeZone;

/**
 * LocalTime cell
 */
class LocalTimeCell extends Cell
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
    public function display(User $user)
    {
        $now = new DateTime();
        if (!empty($user->timezone)) {
            $tz = new DateTimeZone($user->timezone);

            $now->setTimezone($tz);

            $progress = (int) $now->format('G');
            $progress += (intval($now->format('i')) / 60);

            $this->set(compact('tz', 'progress'));
        }
        $this->set('now', $now);
    }
}
