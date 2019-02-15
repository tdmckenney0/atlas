<?php
namespace App\Test\TestCase\Controller\Component;

use App\Controller\Component\UserInjectionComponent;
use Cake\Controller\ComponentRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Controller\Component\UserInjectionComponent Test Case
 */
class UserInjectionComponentTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Controller\Component\UserInjectionComponent
     */
    public $UserInjection;

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $registry = new ComponentRegistry();
        $this->UserInjection = new UserInjectionComponent($registry);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UserInjection);

        parent::tearDown();
    }

    /**
     * Test initial setup
     *
     * @return void
     */
    public function testInitialization()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
