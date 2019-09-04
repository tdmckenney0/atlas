<?php

namespace App\Model\Entity\Traits;

use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

trait LazyLoad {

    protected static $tableName = null;

    /**
     * _getTable
     *
     * Gets the Table object for this Entity.
     *
     * @return App\Model\Table\NodesTable
     */
    protected function _getTable()
    {
        if (empty(self::$tableName)) {
            $name = get_class($this);
            self::$tableName = Inflector::pluralize(substr($name, -(strlen($name) - strrpos($name, '\\') - 1)));
        }
        return TableRegistry::getTableLocator()->get(self::$tableName);
    }

    /**
     * lazyLoad
     *
     * @param Array An array to feed into App\Model\Table\NodesTable::loadInto's second arg.
     *
     * @return EntityInterface|array
     */
    public function lazyLoad(Array $contain = [])
    {
        return $this->_getTable()->loadInto($this, $contain);
    }
}
