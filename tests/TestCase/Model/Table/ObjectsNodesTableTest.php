<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ObjectsNodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ObjectsNodesTable Test Case
 */
class ObjectsNodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ObjectsNodesTable
     */
    public $ObjectsNodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ObjectsNodes',
        'app.Objects',
        'app.Nodes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ObjectsNodes') ? [] : ['className' => ObjectsNodesTable::class];
        $this->ObjectsNodes = TableRegistry::getTableLocator()->get('ObjectsNodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ObjectsNodes);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
