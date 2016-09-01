<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Formations Controller
 *
 * @property \App\Model\Table\FormationsTable $Formations */
class FormationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Organizations', 'Teachers','Events']
        ];
        $formations = $this->paginate($this->Formations)->toArray();


        $this->set(compact('formations'));
        $this->set('_serialize', ['formations']);
    }

    /**
     * View method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Events');
        $this->loadModel('Cities');
        $this->loadModel('Users');
        $this->loadModel('Barracks');
        $formation = $this->Formations->get($id, [
            'contain' => ['Organizations', 'Teachers']
        ]);


        $event = $this->Events->findAllById($formation['event_id'])->toArray();

        $cities = $this->Cities->findAllById($event[0]['city_id'])->toArray();
        $Users = $this->Users->findAllById($event[0]['creator_id'])->toArray();
        $barracks = $this->Barracks->findAllById($event[0]['barrack_id'])->toArray();



        $this->set(compact('formation', 'cities','Users','event','barracks','bills'));
        $this->set('_serialize', ['formation']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $this->loadModel('Cities');
        $this->loadModel('Barracks');

        $formation = $this->Formations->newEntity();

        if ($this->request->is('post')) {
            $formation = $this->Formations->patchEntity($formation, $this->request->data, ['associated' => [
                    'Events',
                    'Events.Formations'
            ]]);

            if ($this->Formations->save($formation)) {
                $this->Flash->success(__('The formation has been saved.'));

/*                return $this->redirect(['action' => 'index']);*/
            } else {
                $this->Flash->error(__('The formation could not be saved. Please, try again.'));
            }
        }

                $organizations = $this->Formations->Organizations->find('list', ['valueField' => 'title']);
                $teachers = $this->Formations->Teachers->find('list', ['valueField' => 'firstname']);


        $cities = $this->Cities->find('list', ['valueField' => 'city']);
        $barracks = $this->Barracks->find('list', ['valueField' => 'name']);

        $this->set(compact('formation', 'organizations', 'teachers','barracks','cities'));
        $this->set('_serialize', ['formation']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $this->loadModel('Cities');
        $this->loadModel('Barracks');

        $formation = $this->Formations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $formation = $this->Formations->patchEntity($formation, $this->request->data,['associated' => [
                'Events',
                'Events.Formations'
            ]]);
            if ($this->Formations->save($formation)) {
                $this->Flash->success(__('The formation has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The formation could not be saved. Please, try again.'));
            }
        }
        $organizations = $this->Formations->Organizations->find('list', ['valueField' => 'title']);
        $teachers = $this->Formations->Teachers->find('list', ['valueField' => 'firstname']);

        $cities = $this->Cities->find('list', ['valueField' => 'city']);
        $barracks = $this->Barracks->find('list', ['valueField' => 'name']);


        $this->set(compact('formation', 'organizations', 'teachers','barracks','cities'));
        $this->set('_serialize', ['formation']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Formation id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('Events');

        $this->request->allowMethod(['post', 'delete']);
        $formation = $this->Formations->get($id);

      $event = $this->Events->get($formation['event_id']);

         $this->Events->delete($event);

        if ($this->Formations->delete($formation)) {
            $this->Flash->success(__('The formation has been deleted.'));
        } else {
            $this->Flash->error(__('The formation could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}