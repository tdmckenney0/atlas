<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * NodeComments Controller
 *
 * @property \App\Model\Table\NodeCommentsTable $NodeComments
 *
 * @method \App\Model\Entity\NodeComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NodeCommentsController extends AppController
{
    /**
     * Paginate Options
     */
    public $paginate = [
        'contain' => ['Users', 'Nodes', 'ParentNodeComments'],
        'limit' => 10,
        'order' => ['NodeComments.modified DESC']
    ];
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $nodeComments = $this->paginate($this->NodeComments);

        $this->set(compact('nodeComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Node Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $nodeComment = $this->NodeComments->get($id, [
            'contain' => ['Users', 'Nodes', 'ParentNodeComments', 'ChildNodeComments']
        ]);

        $this->set('nodeComment', $nodeComment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($node_id, $parent_id = null)
    {
        $nodeComment = $this->NodeComments->newEntity();
        $parentComment = $this->NodeComments->findById($parent_id)->contain('Users')->first();
        $node = $this->NodeComments->Nodes->get($node_id);

        if ($this->request->is('post')) {
            $nodeComment = $this->NodeComments->patchEntity($nodeComment, $this->request->getData());

            $nodeComment->user_id = $this->Auth->user('id');
            $nodeComment->node_id = $node->id;

            if(!empty($parentComment->id)) {
                $nodeComment->parent_id = $parentComment->id;
            }

            if ($this->NodeComments->save($nodeComment)) {
                $this->Flash->success(__('The node comment has been saved.'));

                return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $nodeComment->node_id]);
            }
            $this->Flash->error(__('The node comment could not be saved. Please, try again.'));
        }
        $this->set(compact('nodeComment', 'node', 'parentComment'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Node Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $nodeComment = $this->NodeComments->get($id, [
            'contain' => ['Nodes', 'ParentNodeComments']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $nodeComment = $this->NodeComments->patchEntity($nodeComment, $this->request->getData());
            if ($this->NodeComments->save($nodeComment)) {
                $this->Flash->success(__('The node comment has been saved.'));

                return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $nodeComment->node_id]);
            }
            $this->Flash->error(__('The node comment could not be saved. Please, try again.'));
        }
        $this->set(compact('nodeComment'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Node Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $nodeComment = $this->NodeComments->get($id);
        if ($this->NodeComments->delete($nodeComment)) {
            $this->Flash->success(__('The node comment has been deleted.'));
            return $this->redirect(['controller' => 'Nodes', 'action' => 'view', $nodeComment->node_id]);
        } else {
            $this->Flash->error(__('The node comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
