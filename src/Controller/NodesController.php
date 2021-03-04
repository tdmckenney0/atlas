<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\Node;
use Cake\Event\Event;
use Cake\Http\Exception\NotFoundException;

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
        'order' => ['name'],
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
        $node = $this->Nodes->get($id, [
            'contain' => [
                'Files', 
                'NodeRevisions' => function ($query) {
                    return $query->contain('Users')->order('NodeRevisions.created DESC')->limit(5);
                }
            ]
        ]);

        // Comments and new comments
        $nodeComment = $this->Nodes->NodeComments->newEntity();
        $nodeRevision = $node->node_revisions[0] ?? null;
        $comments = $this->Nodes->NodeComments->find('threaded', [
            'conditions' => ['node_id' => $node->id],
            'contain' => ['Users']
        ])->all();

        $this->set(compact('node', 'nodeComment', 'nodeRevision', 'comments'));
        $this->set('_serialize', 'node');
    }

    /**
     * Reader Method
     * 
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function reader($id = null) 
    {
        $node = $this->Nodes->get($id, [
            'contain' => [
                'Files',
                'NodeRevisions' => function ($query) {
                    return $query->contain('Users')->order('NodeRevisions.created DESC')->limit(1);
                }
            ]
        ]);

        $node->children = $this->Nodes->find('children', [
            'for' => $node->id, 
            'contain' => [
                'Files' => [
                    'sort' => ['Files.name' => 'ASC']
                ]
            ],
            'order' => [
                'Nodes.sort' => 'ASC',
                'Nodes.name' => 'ASC'
            ]
        ])->find('threaded')->toArray();

        $nodeRevision = $node->node_revisions[0] ?? null;

        $this->set(compact('node', 'nodeRevision'));
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
            if (!empty($parent)) {
                $node->parent_id = $parent->id;
            } else {
                $node->parent_id = null;
            }
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

        $this->paginate['conditions'] += ['Nodes.id NOT IN' => $exclude];

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

    /**
     * Export method
     *
     * @param string|null $id Node id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function export($id = null)
    {
        $file = null;
        $ext = $this->request->getParam('_ext');
        $node = $this->Nodes->get($id, [
            'contain' => ['ParentNodes', 'Files', 'ChildNodes']
        ]);

        switch ($ext) {
            case 'zip':
                $file = $node->toZip();
            break;

            case 'pdf':
                $file = $node->toPdf();
            break;

            default:
                throw new NotFoundException(__('Could not export to specified file type.'));
            break;
        }

        $created = $this->Nodes->Files->importFromFile($file, $node, [
            'name' => (trim($node->name) . '.' . $ext)
        ]);

        $file->delete();

        $this->redirect(['controller' => 'files', 'action' => 'view', $created->id]);
    }
}
