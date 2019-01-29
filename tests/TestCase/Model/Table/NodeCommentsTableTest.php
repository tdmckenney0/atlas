<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeCommentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeCommentsTable Test Case
 */
class NodeCommentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeCommentsTable
     */
    public $NodeComments;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NodeComments',
        'app.Users',
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
        $config = TableRegistry::getTableLocator()->exists('NodeComments') ? [] : ['className' => NodeCommentsTable::class];
        $this->NodeComments = TableRegistry::getTableLocator()->get('NodeComments', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeComments);

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
