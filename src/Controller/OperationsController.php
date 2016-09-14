<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Operations Controller
 *
 * @property \App\Model\Table\OperationsTable $Operations
 */
class OperationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Events', 'Barracks', 'Cities', 'OperationActivities', 'OperationEnvironments', 'OperationDelays', 'OperationRecommendations', 'OperationTypes']
        ];

        $operations = $this->paginate($this->Operations);

        $this->set(compact('operations'));
        $this->set('_serialize', ['operations']);
    }


    public function addevent($id = null) {

        $this->loadModel('Events');
        $event = $this->Events->newEntity();



        if ($this->request->is('post')) {
            $event = $this->Events->patchEntity($event, $this->request->data);
            $event->module_id = $id;
            $event->module = 'operations';
            if ($this->Events->save($event)) {

                $this->Flash->success(__('The event has been saved.'));

            } else {
                $this->Flash->error(__('The event could not be saved. Please, try again.'));
            }
        }

        $barracks = $this->Events->Barracks->find('list', ['limit' => 200]);
        $materials = $this->Events->Materials->find('list', ['limit' => 200]);
        $teams = $this->Events->Teams->find('list', ['limit' => 200]);
        $vehicles = $this->Events->Vehicles->find('list', ['limit' => 200]);
        $this->set(compact( 'event', 'barracks', 'modules', 'materials', 'teams', 'vehicles'));
        $this->set('_serialize', ['event']);
    }



    public function gestion($id = null)
    {
        $operation = $this->Operations->get($id, [
            'contain' => ['Events', 'Events.Teams', 'Barracks', 'Cities', 'OperationActivities', 'OperationEnvironments', 'OperationDelays', 'OperationRecommendations', 'OperationTypes']
        ]);
        $this->loadModel('Teams');
        $this->loadModel('Users');
        $this->loadModel('Materials');
        $this->loadModel('Vehicles');


        $teamsList = $this->Teams->find('all');
        $usersList = $this->Users->find('all');
        $materialsList = $this->Materials->find('all');
        $vehiclesList = $this->Vehicles->find('all');

        $this->set(compact('teamsList', 'usersList', 'materialsList', 'vehiclesList' ));
        $this->set('operation', $operation);
        $this->set('_serialize', ['operation']);
    }


    //ajax version of joints function that manages add and remove for joint tables.
    public function ajoints()
    {
        $this->autoRender = false;

        //id of the container from where to add/remove
        $containerID = $this->request->data('containerID');

        //if of the content
        $contentID = $this->request->data('contentID');

        //id of the event or else that contains all the rest, allows url redirect to initial page
        $source = $this->request->data('source');

        //container and content types : to load model and contain and to determine switch cases for query objects
        $containerType = $this->request->data('containerType');
        $contentType = $this->request->data('contentType');

        //add or remove : link/unlink
        $action = $this->request->data('action');

        //loads container's model
        $this->loadModel($containerType);

        //cases to populate with joint table
        switch ($containerType . $contentType) {
            case 'TeamsUsers':
                $containerTable = $this->Teams;
                $contentTable = $this->Teams->Users;
                break;
            case 'TeamsMaterials':
                $containerTable = $this->Teams;
                $contentTable = $this->Teams->Materials;
                break;
            case 'TeamsVehicles':
                $containerTable = $this->Teams;
                $contentTable = $this->Teams->Vehicles;
                break;
            case 'EventsTeams':
                $containerTable = $this->Events;
                $contentTable = $this->Events->Teams;
                break;
        }

        //get container query object
        $container = $containerTable->get($containerID, ['contain' => [$contentType]]);
        //get content
        $content = $contentTable->findById($contentID)->toArray();

        //links or unlinks container and content
        if ($action == 'add') {
            $contentTable->link($container, $content);
        } elseif ($action == 'remove') {
            $contentTable->unlink($container, $content);
        }
    }

    //dynamic loading of lists
    public function loadlist() {

        //gets context
        $source = $this->request->data('source');
        $containerID = $this->request->data('containerID');
        $containerType = $this->request->data('containerType');
        $contentType = $this->request->data('contentType');

        //loads model
        $this->loadModel($containerType);

        //cases to load container query object
        switch ($containerType) {
            case 'Teams':
                $containerTable = $this->Teams;
                break;
            case 'Events':
                $containerTable = $this->Events;
                break;
        }

        //get container object with container id
        $content = $containerTable->get($containerID, [
            'contain' => $contentType
        ]);

        //cases to load content tables
        switch ($contentType) {
            case 'Users':
                $list = $content->users;
                break;
            case 'Materials':
                $list = $content->materials;
                break;
            case 'Vehicles':
                $list = $content->vehicles;
                break;
            case 'Teams':
                $list = $content->teams;
                break;
        }

        //sets vars
        $this->set('list', $list);
        $this->set(compact('containerID', 'source', 'contentType', 'containerType'));
        $this->set('_serialize', [$list]);
    }



    /**
     * View method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $operation = $this->Operations->get($id, [
            'contain' => ['Events', 'Barracks', 'Cities', 'OperationActivities', 'OperationEnvironments', 'OperationDelays', 'OperationRecommendations', 'OperationTypes']
        ]);

        $this->set('operation', $operation);
        $this->set('_serialize', ['operation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $operation = $this->Operations->newEntity();
        if ($this->request->is('post')) {
            $operation = $this->Operations->patchEntity($operation, $this->request->data);
            if ($this->Operations->save($operation)) {
                $this->Flash->success(__('The operation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The operation could not be saved. Please, try again.'));
            }
        }
        $barracks = $this->Operations->Barracks->find('list', ['limit' => 200]);
        $cities = $this->Operations->Cities->find('list', ['limit' => 200]);
        $operationActivities = $this->Operations->OperationActivities->find('list', ['limit' => 200]);
        $operationEnvironments = $this->Operations->OperationEnvironments->find('list', ['limit' => 200]);
        $operationDelays = $this->Operations->OperationDelays->find('list', ['limit' => 200]);
        $operationRecommendations = $this->Operations->OperationRecommendations->find('list', ['limit' => 200]);
        $organizations = $this->Operations->Organizations->find('list', ['limit' => 200]);
        $operationTypes = $this->Operations->OperationTypes->find('list', ['limit' => 200]);
        $this->set(compact('operation', 'barracks', 'cities', 'operationActivities', 'operationEnvironments', 'operationDelays', 'operationRecommendations', 'organizations', 'operationTypes'));
        $this->set('_serialize', ['operation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $operation = $this->Operations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $operation = $this->Operations->patchEntity($operation, $this->request->data);
            if ($this->Operations->save($operation)) {
                $this->Flash->success(__('The operation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The operation could not be saved. Please, try again.'));
            }
        }
        $barracks = $this->Operations->Barracks->find('list', ['limit' => 200]);
        $cities = $this->Operations->Cities->find('list', ['limit' => 200]);
        $operationActivities = $this->Operations->OperationActivities->find('list', ['limit' => 200]);
        $operationEnvironments = $this->Operations->OperationEnvironments->find('list', ['limit' => 200]);
        $operationDelays = $this->Operations->OperationDelays->find('list', ['limit' => 200]);
        $operationRecommendations = $this->Operations->OperationRecommendations->find('list', ['limit' => 200]);
        $organizations = $this->Operations->Organizations->find('list', ['limit' => 200]);
        $operationTypes = $this->Operations->OperationTypes->find('list', ['limit' => 200]);
        $this->set(compact('operation', 'barracks', 'cities', 'operationActivities', 'operationEnvironments', 'operationDelays', 'operationRecommendations', 'organizations', 'operationTypes'));
        $this->set('_serialize', ['operation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Operation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $operation = $this->Operations->get($id);
        if ($this->Operations->delete($operation)) {
            $this->Flash->success(__('The operation has been deleted.'));
        } else {
            $this->Flash->error(__('The operation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
