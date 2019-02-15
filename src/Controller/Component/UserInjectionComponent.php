<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Event\EventManager;
use Cake\Event\EventListenerInterface;
use Cake\Datasource\EntityInterface;
use Cake\ORM\TableRegistry;
/**
 * UserInjection component
 */
class UserInjectionComponent extends Component implements EventListenerInterface
{
    /**
     *
     */
    public $components = ['Auth'];
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function initialize(array $config)
    {
        parent::initialize($config);
        EventManager::instance()->on($this);
    }

    public function implementedEvents()
    {
        return [
            'Model.beforeSave' => 'injectUserIntoOptions',
            'Model.beforeDelete' => 'injectUserIntoOptions',
        ];
    }

    public function injectUserIntoOptions(Event $event, EntityInterface $entity, \ArrayObject $options)
    {
        if($this->Auth->user('id')) {
            $options['User'] = TableRegistry::getTableLocator()->get('Users')->get($this->Auth->user('id'));
        }
    }
}
