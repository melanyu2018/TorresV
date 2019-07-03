<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * OrderDetail Controller
 *
 * @property \App\Model\Table\OrderDetailTable $OrderDetail
 *
 * @method \App\Model\Entity\OrderDetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OrderDetailController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Orders', 'Products']
        ];
        $orderDetail = $this->paginate($this->OrderDetail);

        $this->set(compact('orderDetail'));
    }

    /**
     * View method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $orderDetail = $this->OrderDetail->get($id, [
            'contain' => ['Orders', 'Products']
        ]);

        $this->set('orderDetail', $orderDetail);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($ido, $idpro, $preci, $cant, $t)
    {
        $orderDetail = $this->OrderDetail->newEntity();
        //if ($this->request->is('post')) {
            $orderDetail = $this->OrderDetail->patchEntity($orderDetail, $this->request->getData());
			$orderDetail->order_id=$ido;
			$orderDetail->product_id=$idpro;
			$orderDetail->cant=$cant;
			$orderDetail->unit_price=$preci;
			$orderDetail->total_price=$t;
			
            if ($this->OrderDetail->save($orderDetail)) {
                //$this->Flash->success(__('The {0} has been saved.', 'Order Detail'));
				//return $this->redirect(['controller'=>'Orders', 'action' => 'mount', $ido, $t]);
                return $this->redirect(['controller'=>'Orders', 'action' => 'view', $ido]);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order Detail'));
        //}
        /*$orders = $this->OrderDetail->Orders->find('list', ['conditions'=>['id'=>$ido],'limit' => 200]);
        $products = $this->OrderDetail->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderDetail', 'orders', 'products'));*/
    }

	public function addlist($ido)
    {
		
        if ($this->request->is('post')) {
			$ar=$this->request->getData();
            //$orderDetail = $this->OrderDetail->patchEntity($orderDetail, $this->request->getData());
            /*if ($this->OrderDetail->save($orderDetail)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order Detail'));

                return $this->redirect(['action' => 'index']);
            }*/
			
            //$this->Flash->error(implode('    ', $a).'  y tiene '.count($a));
			$this->loadModel('Orders');
			for($i=0;$i<(count($ar)/3)-1;$i++){
				$idpro=$ar['a'.$i];
				$preci=$ar['b'.$i];
				$cant=$ar['c'.$i];
				$t=$preci*$cant;
				if($cant!=0){
					$this->add($ido, $idpro, $preci, $cant, $t);
					$x=new OrdersController();
					$x->mount($ido, $t);
					
				}
				
			}
			
			
			
			
			
			
        }
        $orders = $this->OrderDetail->Orders->find('list', ['conditions'=>['id'=>$ido],'limit' => 200]);
        $products = $this->OrderDetail->Products->find('list', ['limit' => 200]);
		$p = $this->OrderDetail->Products->find('all')->toArray();
        $this->set(compact('orders', 'products', 'p'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $orderDetail = $this->OrderDetail->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $orderDetail = $this->OrderDetail->patchEntity($orderDetail, $this->request->getData());
            if ($this->OrderDetail->save($orderDetail)) {
                $this->Flash->success(__('The {0} has been saved.', 'Order Detail'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Order Detail'));
        }
        $orders = $this->OrderDetail->Orders->find('list', ['limit' => 200]);
        $products = $this->OrderDetail->Products->find('list', ['limit' => 200]);
        $this->set(compact('orderDetail', 'orders', 'products'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Order Detail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $orderDetail = $this->OrderDetail->get($id);
        if ($this->OrderDetail->delete($orderDetail)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Order Detail'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Order Detail'));
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
			if (in_array($action, ['index', 'view','add', 'edit', 'delete', 'addre', 'addlist', 'changeLanguage', 'pay', 'deliv', 'mount'])) {
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
