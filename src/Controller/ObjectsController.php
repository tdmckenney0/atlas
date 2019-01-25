<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Objects Controller
 *
 * @property \App\Model\Table\ObjectsTable $Objects
 *
 * @method \App\Model\Entity\Object[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ObjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $objects = $this->paginate($this->Objects);

        $this->set(compact('objects'));
    }

    /**
     * View method
     *
     * @param string|null $id Object id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $object = $this->Objects->get($id, [
            'contain' => ['Nodes']
        ]);

        $this->set('object', $object);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {
            $object = $this->Objects->patchEntity($object, $this->request->getData());
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The object has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The object could not be saved. Please, try again.'));
        }
        $nodes = $this->Objects->Nodes->find('list', ['limit' => 200]);
        $this->set(compact('object', 'nodes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Object id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $object = $this->Objects->get($id, [
            'contain' => ['Nodes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->getData());
            if ($this->Objects->save($object)) {
                $this->Flash->success(__('The object has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The object could not be saved. Please, try again.'));
        }
        $nodes = $this->Objects->Nodes->find('list', ['limit' => 200]);
        $this->set(compact('object', 'nodes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Object id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $object = $this->Objects->get($id);
        if ($this->Objects->delete($object)) {
            $this->Flash->success(__('The object has been deleted.'));
        } else {
            $this->Flash->error(__('The object could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
