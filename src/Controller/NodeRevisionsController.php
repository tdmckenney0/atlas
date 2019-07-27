<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NodeRevisions Controller
 *
 * @property \App\Model\Table\NodeRevisionsTable $NodeRevisions
 *
 * @method \App\Model\Entity\NodeRevision[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NodeRevisionsController extends AppController
{

    public $paginate = [
        'contain' => ['Users', 'Nodes'],
        'conditions' => [],
        'order' => ['NodeRevisions.created' => 'DESC']
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($node_id = null)
    {
        $search = $this->request->getQuery('search');
        $node = null;
        if (!empty($search)) {
            $search = '%' . trim($search) . '%';
            $this->paginate['conditions'] = [
                'OR' => [
                    'NodeRevisions.name LIKE' => $search,
                    'NodeRevisions.description LIKE' => $search
                ]
            ];
        }

        if (!empty($node_id)) {
            $node = $this->NodeRevisions->Nodes->get($node_id);
            $this->paginate['conditions'] = array_merge($this->paginate['conditions'], ['NodeRevisions.node_id' => $node->id]);
        }

        $nodeRevisions = $this->paginate($this->NodeRevisions);

        $this->set(compact('nodeRevisions', 'node'));
        $this->set('_serialize', ['nodeRevisions']);
    }

    /**
     * View method
     *
     * @param string|null $id Node Revision id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nodeRevision = $this->NodeRevisions->get($id, [
            'contain' => ['Users', 'Nodes', 'ParentNodeRevisions', 'ChildNodeRevisions']
        ]);

        $first = $this->NodeRevisions->find('root', ['node_id' => $nodeRevision->node_id])->first();
        $last = $this->NodeRevisions->find('recent', ['node_id' => $nodeRevision->node_id])->first();

        $this->set(compact('nodeRevision', 'first', 'last'));
        $this->set('_serialize', ['nodeRevision','first', 'last']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Node Revision id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nodeRevision = $this->NodeRevisions->get($id);
        $this->NodeRevisions->removeFromTree($nodeRevision);
        if ($this->NodeRevisions->delete($nodeRevision)) {
            $this->Flash->success(__('The node revision has been deleted.'));
        } else {
            $this->Flash->error(__('The node revision could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index', $nodeRevision->node_id]);
    }
}
