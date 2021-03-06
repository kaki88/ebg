<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormationTypesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormationTypesTable Test Case
 */
class FormationTypesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormationTypesTable
     */
    public $FormationTypes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formation_types',
        'app.formations',
        'app.organizations',
        'app.cities',
        'app.departments',
        'app.regions',
        'app.barracks',
        'app.events',
        'app.operations',
        'app.operation_activities',
        'app.operation_environments',
        'app.operation_delays',
        'app.operation_recommendations',
        'app.operation_types',
        'app.bills',
        'app.materials',
        'app.material_types',
        'app.barracks_materials',
        'app.user_materials',
        'app.users',
        'app.availabilities',
        'app.orders',
        'app.providers',
        'app.supplies',
        'app.orders_supplies',
        'app.providers_supplies',
        'app.barracks_users',
        'app.teams',
        'app.events_teams',
        'app.materials_teams',
        'app.teams_users',
        'app.vehicles',
        'app.vehicle_types',
        'app.vehicle_models',
        'app.barracks_vehicles',
        'app.events_vehicles',
        'app.teams_vehicles',
        'app.users_vehicles',
        'app.events_materials'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormationTypes') ? [] : ['className' => 'App\Model\Table\FormationTypesTable'];
        $this->FormationTypes = TableRegistry::get('FormationTypes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormationTypes);

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
}
