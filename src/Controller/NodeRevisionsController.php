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
        'limit' => 10,
        'contain' => ['Users'],
        'order' => ['NodeRevisions.created' => 'DESC']
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($node_id = null)
    {
        $node = $this->NodeRevisions->Nodes->get($node_id);

        $this->paginate = array_merge($this->paginate, [
            'conditions' => ['NodeRevisions.node_id' => $node->id]
        ]);
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
            'contain' => ['Users', 'ParentNodeRevisions', 'ChildNodeRevisions']
        ]);
        $node = $this->NodeRevisions->Nodes->get($nodeRevision->node_id);

        $this->set(compact('nodeRevision', 'node'));
        $this->set('_serialize', ['nodeRevision']);
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
