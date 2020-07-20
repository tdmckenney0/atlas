<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Filesystem\File as CakeFile;

/**
 * Files Controller
 *
 * @property \App\Model\Table\FilesTable $Files
 *
 * @method \App\Model\Entity\File[]|\Cake\Datasource\ResultSetInterface paginate($file = null, array $settings = [])
 */
class FilesController extends AppController
{

    /**
     * Pagination Settings
     */
    public $paginate = [
        'conditions' => [],
        'limit' => 20
    ];

    /**
     * Searchs and Pages Nodes for interactions between the two. 
     * 
     * @param array List of Query options.
     */
    protected function getNodes(array $options = [])
    {
        if (empty($options['order'])) {
            $options['order'] = ['name'];
        }

        // Search Setup
        $search = $this->request->getQuery('search');

        if (!empty($search)) {
            $search = '%' . trim($search) . '%';

            if (empty($options['conditions']['OR']) || !is_array($options['conditions']['OR'])) {
                $options['conditions']['OR'] = [];
            }

            $options['conditions']['OR'] += [
                'Nodes.name LIKE' => $search,
                'Nodes.description LIKE' => $search
            ];
        }

        return $this->paginate($this->Files->Nodes->getTarget(), $options);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $search = '%' . trim($search) . '%';
            $this->paginate['conditions'] = [
                'OR' => [
                    'Files.name LIKE' => $search
                ]
            ];
        }

        $files = $this->paginate($this->Files);

        $this->set(compact('files'));
        $this->set('_serialize', 'files');
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
     * get method
     *
     * @param string|null $id File id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function thumbnail($id = null)
    {
        $file = $this->Files->get($id);
        $thumbnail = $file->getThumbnail();
        return $this->response->withFile($thumbnail->path);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($node_id = null)
    {
        $node = $this->Files->Nodes->findById($node_id)->first();
        $data = $this->request->getData();
        if ($this->request->is('post') && !empty($data['file']['tmp_name']) && is_uploaded_file($data['file']['tmp_name'])) {
            $temp = new CakeFile($data['file']['tmp_name']);
            $file = $this->Files->importFromFile($temp, $node, [
                'name' => $data['file']['name']
            ]);
            if (!empty($file)) {
                $this->Flash->success(__('The file has been saved.'));

                if(!empty($node->id)) {
                    return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
                }
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The file could not be saved. Please, try again.'));
        }
        $file = $this->Files->newEntity();
        $nodes = $this->Files->Nodes->find('list', ['limit' => 200, 'order' => ['Nodes.name' => 'ASC']]);
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
        $nodes = $this->Files->Nodes->find('list', ['limit' => 200, 'order' => ['Nodes.name' => 'ASC']]);
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
        $node = $this->Files->Nodes->findById($node_id)->first();
        if(!empty($node->id)) {
            $file = $this->Files->get($id);
            $folder = $file->decompress();
            $this->Files->Nodes->importFromFolder($node, $folder)->delete();
            return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $node->id]);
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Attach a File to a Node. 
     * 
     * @param string The File ID
     * @param string The Node ID
     */
    public function attach($id = null, $node_id = null) 
    {
        $file = $this->Files->get($id);
        $node = null;        

        if (!empty($node_id)) {
            $node = $this->Files->Nodes->get($node_id);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!empty($node->id)) {
                $this->Files->Nodes->link($file, [$node]);                

                $this->Flash->success(__('The File has been attached to "{0}"', $node->name));

                return $this->redirect(['action' => 'view', $file->id]);
            } else {
                $this->Flash->error(__('The File could not be attached. Please, try again.'));
            }
        }

        // Load Attached Nodes. 
        $this->Files->loadInto($file, ['Nodes']);

        // Exclude all nodes already attached.
        $exclude = collection($file->nodes)->extract('id')->toArray();

        // Get Nodes to List and search for. 
        $nodes = $this->getNodes([
            'conditions' => [
                ['Nodes.id NOT IN' => $exclude]
            ]
        ]);

        $this->set(compact('file', 'node', 'nodes'));
    }

    /**
     * Detach a file from a Node. 
     * 
     * @param string The File ID.
     * @param string The Node ID
     */
    public function detach($id = null, $node_id = null)
    {
        $file = $this->Files->get($id);
        $node = null;

        if (!empty($node_id)) {
            $node = $this->Files->Nodes->get($node_id);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!empty($node->id)) {
                $this->Files->Nodes->unlink($file, [$node]);                

                $this->Flash->success(__('The File has been detached from "{0}"', $node->name));

                return $this->redirect(['action' => 'view', $file->id]);
            } else {
                $this->Flash->error(__('The File could not be detached. Please, try again.'));
            }
        }

        // Load Attached Nodes. 
        $this->Files->loadInto($file, ['Nodes']);

        // Only nodes already attached.
        $only = collection($file->nodes)->extract('id')->toArray();

        // Get Nodes to List and search for. 
        $nodes = $this->getNodes([
            'conditions' => [
                ['Nodes.id IN' => $only]
            ]
        ]);

        $this->set(compact('file', 'node', 'nodes'));
    } 
}
