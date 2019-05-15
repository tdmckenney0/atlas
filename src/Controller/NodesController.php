<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Nodes Controller
 *
 * @property \App\Model\Table\NodesTable $Nodes
 *
 * @method \App\Model\Entity\Node[]|\Cake\Datasource\ResultSetInterface paginate($file = null, array $settings = [])
 */
class NodesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ParentNodes'],
            'conditions' => ['Nodes.parent_id IS' => null]
        ];
        $nodes = $this->paginate($this->Nodes);

        $this->set(compact('nodes'));
        $this->set('_serialize', 'nodes');
    }

    /**
     * View method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ext = $this->request->getParam('_ext');
        $node = $this->Nodes->get($id, [
            'contain' => ['ParentNodes', 'Files', 'ChildNodes']
        ]);

        if($ext == 'zip') {
            $file = $node->toZip();
            return $this->response->withFile($file->path);
        }

        $this->set('node', $node);
        $this->set('_serialize', 'node');
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($parent_id = null)
    {
        if(!empty($parent_id)) {
            $parent = $this->Nodes->get($parent_id);
            $parent_id = $parent->id;
        }
        $node = $this->Nodes->newEntity();
        if ($this->request->is('post')) {
            $node = $this->Nodes->patchEntity($node, $this->request->getData());
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                return $this->redirect(['action' => 'view', $node->id]);
            }
            $this->Flash->error(__('The node could not be saved. Please, try again.'));
        }
        $parentNodes = $this->Nodes->ParentNodes->find('list', ['limit' => 200]);
        $files = $this->Nodes->Files->find('list', ['limit' => 200, 'order' => ['Files.name' => 'ASC']]);
        $this->set(compact('node', 'parentNodes', 'files', 'parent_id'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $node = $this->Nodes->get($id, [
            'contain' => ['Files']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadComponent('UserInjection');
            $node = $this->Nodes->patchEntity($node, $this->request->getData());
            if ($this->Nodes->save($node)) {
                $this->Flash->success(__('The node has been saved.'));

                // return $this->redirect(['action' => 'view', $node->id]);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $parentNodes = $this->Nodes->ParentNodes->find('list', ['limit' => 200]);
        $files = $this->Nodes->Files->find('list', ['limit' => 200, 'order' => ['Files.name' => 'ASC']]);
        $this->set(compact('node', 'parentNodes', 'files'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $node = $this->Nodes->get($id);
        if ($this->Nodes->delete($node)) {
            $this->Flash->success(__('The node has been deleted.'));
        } else {
            $this->Flash->error(__('The node could not be deleted. Please, try again.'));
        }

        if(!empty($node->parent_id)) {
            return $this->redirect(['action' => 'view', $node->parent_id]);
        }

        return $this->redirect(['action' => 'index']);
    }
}
