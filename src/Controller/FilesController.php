<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($file = null, array $settings = [])
 */
class FilesController extends AppController
{

    public $paginate = [
        'limit' => 10
    ];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
    }

    /**
     * View method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null, $node_id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Nodes']
        ]);

        $node = $this->Files->Nodes->findById($node_id)->first();

        $this->set(compact('file', 'node'));
    }

    /**
     * get method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function get($id = null)
    {
        $file = $this->Files->get($id);
        return $this->response->withFile($file->File->path);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($node_id = null)
    {
        $node = $this->Files->Nodes->findById($node_id)->first();
        $file = $this->Files->newEntity();
        if ($this->request->is('post')) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                if(!empty($node->id)) {
                    return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $nodes = $this->Files->Nodes->find('list', ['limit' => 200]);
        $this->set(compact('file', 'nodes', 'node'));
    }

    /**
     * Edit method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null, $node_id = null)
    {
        $file = $this->Files->get($id, [
            'contain' => ['Nodes']
        ]);
        $node = $this->Files->Nodes->findById($node_id)->first();
        $children = array_column($file->nodes, 'id');
        if ($this->request->is(['patch', 'post', 'put'])) {
            $file = $this->Files->patchEntity($file, $this->request->getData());
            if ($this->Files->save($file)) {
                $this->Flash->success(__('The file has been saved.'));

                if(!empty($node->id)) {
                    return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
                }
                return $this->redirect(['action' => 'view', $file->id]);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $nodes = $this->Files->Nodes->find('list', ['limit' => 200]);
        $this->set(compact('file', 'nodes', 'children', 'node'));
    }

    /**
     * Delete method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null, $node_id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $file = $this->Files->get($id);
        $node = $this->Files->Nodes->findById($node_id)->first();
        if ($this->Files->delete($file)) {
            $this->Flash->success(__('The file has been deleted.'));
        } else {
            $this->Flash->error(__('The file could not be deleted. Please, try again.'));
        }

        if(!empty($node->id)) {
            return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Extract method
     *
     *
     */
    public function extract($id = null, $node_id = null)
    {
        $this->request->allowMethod(['get']);
        $file = $this->Files->get($id);
        $node = $this->Files->Nodes->findById($node_id)->first();
        $folder = $file->decompress();
        $folder->delete();
        if(!empty($node->id)) {
            return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
        }
        return $this->redirect(['action' => 'index']);
    }
}
