<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\NodeRevisionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\NodeRevisionsTable Test Case
 */
class NodeRevisionsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\NodeRevisionsTable
     */
    public $NodeRevisions;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.NodeRevisions',
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
        $config = TableRegistry::getTableLocator()->exists('NodeRevisions') ? [] : ['className' => NodeRevisionsTable::class];
        $this->NodeRevisions = TableRegistry::getTableLocator()->get('NodeRevisions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->NodeRevisions);

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
