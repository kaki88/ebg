<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TeamsVehiclesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TeamsVehiclesTable Test Case
 */
class TeamsVehiclesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TeamsVehiclesTable
     */
    public $TeamsVehicles;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teams_vehicles',
        'app.teams',
        'app.event_teams',
        'app.users',
        'app.permissions',
        'app.grades',
        'app.roles',
        'app.availabilities',
        'app.barrack_users',
        'app.barracks',
        'app.cities',
        'app.events',
        'app.event_types',
        'app.creators',
        'app.borrowed_materials',
        'app.materials',
        'app.material_types',
        'app.user_materials',
        'app.vehicles',
        'app.type_vehicles',
        'app.model_vehicles',
        'app.borrowed_vehicles',
        'app.event_vehicles',
        'app.users_vehicles',
        'app.orders',
        'app.providers',
        'app.supplies',
        'app.order_supplies',
        'app.providers_supplies',
        'app.team_users',
        'app.bills',
        'app.responsibles',
        'app.event_equipments',
        'app.equipment',
        'app.formations',
        'app.organizations',
        'app.operations',
        'app.operation_activities',
        'app.operation_environments',
        'app.operation_delays',
        'app.operation_types',
        'app.operation_recommendations',
        'app.teachers',
        'app.team_chieves'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TeamsVehicles') ? [] : ['className' => 'App\Model\Table\TeamsVehiclesTable'];
        $this->TeamsVehicles = TableRegistry::get('TeamsVehicles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TeamsVehicles);

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
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}