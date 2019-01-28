<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FilesNodesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FilesNodesTable Test Case
 */
class FilesNodesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FilesNodesTable
     */
    public $FilesNodes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.FilesNodes',
        'app.Files',
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
        $config = TableRegistry::getTableLocator()->exists('FilesNodes') ? [] : ['className' => FilesNodesTable::class];
        $this->FilesNodes = TableRegistry::getTableLocator()->get('FilesNodes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FilesNodes);

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
