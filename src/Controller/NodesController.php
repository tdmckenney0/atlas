<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

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
     * Pagination Settings
     */
    public $paginate = [
        'order' => 'name',
        'conditions' => []
    ];

    /**
     * Callbacks
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        // Search Setup
        $search = $this->request->getQuery('search');
        if (!empty($search)) {
            $search = '%' . trim($search) . '%';
            $this->paginate['conditions'] = [
                'OR' => [
                    'Nodes.name LIKE' => $search,
                    'Nodes.description LIKE' => $search
                ]
            ];
        }
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        if(empty( $this->paginate['conditions'])) {
            $this->paginate['conditions'] = ['Nodes.parent_id IS' => null];
        }

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

        // Compress if requested zip.
        if($ext == 'zip') {
            $file = $node->toZip();
            return $this->response->withFile($file->path, [
                'download' => true,
                'name' => (trim($node->name) . '.zip')
            ]);
        }

        // Comments and new comments
        $nodeComment = $this->Nodes->NodeComments->newEntity();
        $comments = $this->Nodes->NodeComments->find('threaded', [
            'conditions' => ['node_id' => $node->id],
            'contain' => ['Users']
        ])->all();

        // Seperate the Files out.
        $files = collection($node->files);

        $images = $files->filter(function($file, $key) {
            return $file->isImageEmbeddable();
        })->chunk(3);

        $videos = $files->filter(function($file, $key) {
            return $file->isVideo();
        });

        $audio = $files->filter(function($file, $key) {
            return $file->isAudio();
        })->chunk(3);

        $other = $files->filter(function($file, $key) {
            return !$file->isImageEmbeddable() && !$file->isVideo() && !$file->isAudio();
        })->chunk(3);

        // Only embeddable images.

        $this->set(compact('node', 'nodeComment', 'comments', 'images', 'videos', 'audio', 'other'));
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
        } else {
            $parent = null;
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
        $this->set(compact('node', 'parent'));
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
                $this->Nodes->enforceSortOrder($node);
                $this->Flash->success(__('The node has been saved.'));
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }
        $files = $this->Nodes->Files->find('list', ['limit' => 200, 'order' => ['Files.name' => 'ASC']]);
        $this->set(compact('node', 'files'));
    }

    /**
     * Adopt Method - Changes the parent node
     *
     * @param string|null $adoptee_id The Node to change the parent of
     * @param string|null $adoptor_id The new parent node
     */
    public function adopt($adoptee_id = null, $adopter_id = null)
    {
        $adoptee = $this->Nodes->get($adoptee_id);
        $adopter = null;
        if (!empty($adopter_id)) {
            $adopter = $this->Nodes->get($adopter_id);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!empty($adopter->id)) {
                $adoptee->parent_id = $adopter->id;
            } else {
                $adoptee->parent_id = null;
            }
            if ($this->Nodes->save($adoptee)) {
                $this->Flash->success(__('The node parent has been changed.'));

                return $this->redirect(['action' => 'view', $adoptee->id]);
            } else {
                $this->Flash->error(__('The node could not be saved. Please, try again.'));
            }
        }

        // Exclude all child nodes.
        $exclude = $this->Nodes->find('children', ['for' => $adoptee->id])->extract('id')->toArray();

        // Exclude current node.
        $exclude = array_merge($exclude, [$adoptee->id]);

        $this->paginate['conditions'] += ['Nodes.id NOT IN' => $exclude]; $this->log($this->paginate);

        $nodes = $this->paginate($this->Nodes);

        $this->set(compact('adoptee', 'adopter', 'nodes'));
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
