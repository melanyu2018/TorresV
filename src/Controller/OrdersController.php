<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 *
 * @method \App\Model\Entity\Order[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $orders = $this->paginate($this->Orders);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => ['Users', 'OrderDetail']
        ]);
		$this->loadModel('Products'); 
		$pr=$this->Products->find('all', ['contain' => []]);
		$pr=$pr->toArray();
		//$this->Flash->error($pr);
		//$pr=$this->Products->find('all');
        $this->set(compact('order', $order, 'pr'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEntity();
		
		$usid=$this->Auth->user('id');
		$dat = date("Y/m/d");
	
		//en form DE OBJETO ORM
			//$usid='43453453543543';
		//$a=$this->Orders->find('all')
			//->where(['user_id'=>$usid, 'date'=>$dat]);
			
		$a=$this->Orders->find('all', array('conditions' => array('user_id' => $usid, 'date'=>$dat), 
            'order' => array('reload' => 'DESC') ))->first();
			
		if(is_null($a)){
			$a=$this->Orders->find('all', array('conditions' => array('user_id' => $usid), 
                               'order' => array('date' => 'DESC') ))->first();
			
			if(is_null($a)){
				$bn=1000000*$usid;
				$re=1;
			}else{
				$a=$a->toArray();
				$bn=$a['ballot_number']+1;
				$re=1;
			}
		}else{
			$a=$a->toArray();
			if($a['reload']==3){
				$this->Flash->error(__('Exeso'));
				return $this->redirect(['action' => 'index']);
			}
			$bn=$a['ballot_number'];
			$re=$a['reload']+1;
		}


        if ($this->request->is('post')) {	
            $order = $this->Orders->patchEntity($order, $this->request->getData());
			$order->ballot_number=$bn;
			$order->reload=$re;
			$order->date=$dat;
            if ($this->Orders->save($order)) {
                //$this->Flash->success(__('The {0} has been saved.', 'Order'));
				//$a=$this->Orders->find('all', ['conditions'=>['user_id'=>$usid, 'date'=>$dat]]);
                return $this->redirect(['controller'=>'OrderDetail', 'action' => 'addlist', $order['id']]);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order'));
        }
        $users = $this->Orders->Users->find('list', ['conditions' => ['id' => $usid], 'limit' => 200]);
        $this->set(compact('order', 'users', 'bn', 're', 'dat'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $order = $this->Orders->patchEntity($order, $this->request->getData());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order'));
        }
        $users = $this->Orders->Users->find('list', ['limit' => 200]);
        $this->set(compact('order', 'users'));
    }


	public function pay($id)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        //if ($this->request->is(['patch', 'post', 'put'])) {
			$orderp= $this->Orders->find('all', ['conditions'=>['id'=>$id]])->first()->toArray();
			$orderp['status_payment']=true;
            $order = $this->Orders->patchEntity($order, $orderp);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order'));
        //}
        //$users = $this->Orders->Users->find('list', ['limit' => 200]);
        //$this->set(compact('order', 'users'));
    }

	public function deliv($id)
    {
        $order = $this->Orders->get($id, [
            'contain' => []
        ]);
        //if ($this->request->is(['patch', 'post', 'put'])) {
			$orderp= $this->Orders->find('all', ['conditions'=>['id'=>$id]])->first()->toArray();
			$orderp['status_delivery']=true;
            $order = $this->Orders->patchEntity($order, $orderp);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order'));
        //}
        //$users = $this->Orders->Users->find('list', ['limit' => 200]);
        //$this->set(compact('order', 'users'));
    }
	
	public function mount($ido, $t)
    {
        $order = $this->Orders->get($ido, [
            'contain' => []
        ]);
        //if ($this->request->is(['patch', 'post', 'put'])) {
			$orderp= $this->Orders->find('all', ['conditions'=>['id'=>$ido]])->first()->toArray();
			$tem=$orderp['amount'];
			$orderp['amount']=$tem+$t;
            $order = $this->Orders->patchEntity($order, $orderp);
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order'));

                //return $this->redirect(['action' => 'view', $ido]);
            }
            //$this->Flash->error(__('The {0} coulcasanovain.', 'Order'));
        //}
        //$users = $this->Orders->Users->find('list', ['limit' => 200]);
        //$this->set(compact('order', 'users'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Order'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Order'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	
	
	public function isAuthorized($user)
	{	
		$u=TableRegistry::getTableLocator()->get('Users')->findById($user['id'])->first();
		if($u['role_id'] == 1){
			$action = $this->request->getParam('action');
			// The add and tags actions are always allowed to logged in users.
			if (in_array($action, ['index','view','add', 'edit', 'delete', 'addre', 'addlist', 'changeLanguage', 'pay', 'deliv', 'mount'])) {
				return true;
			}
		}
		if($u['role_id'] == 2){
			$action = $this->request->getParam('action');
			// The add and tags actions are always allowed to logged in users.
			if (in_array($action, ['index','view', 'add', 'addre', 'addlist', 'changeLanguage', 'mount'])) {
				return true;
			}
		}
		return false;
		// All other actions require a slug.
		$usuario = $this->request->getParam('pass.0');
		if (!$usuario) {
			return false;
		}/*
		$s=$this->Users->findById($user['id'])->first();
		if($s['status'] === false){
			$this->Flash->error('Desactivado');
		$this->redirect($this->Auth->logout());
			return false;
	}*/
	}
}
