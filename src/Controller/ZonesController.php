<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * Zones Controller
 *
 * @property \App\Model\Table\ZonesTable $Zones
 *
 * @method \App\Model\Entity\Zone[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $zones = $this->paginate($this->Zones);

        $this->set(compact('zones'));
    }

    /**
     * View method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zone = $this->Zones->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('zone', $zone);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $zone = $this->Zones->newEntity();
        if ($this->request->is('post')) {
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
			
			$zonearray=$this->request->getData('users');
			
            if ($this->Zones->save($zone)) {
				
				$userid=array('id'=>implode($zonearray));
				
				
				
				
                //$this->Flash->success(__('The {0} has been saved.', 'Zone'));
				
                return $this->redirect($this->redirect(['controller'=>'ZonesUsers', 'action' => 'addre', $userid['id'], $zone['id']]));
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zone'));
        }
        $users = $this->Zones->Users->find('list', ['limit' => 200]);
        $this->set(compact('zone', 'users'));
    }
	
	public function addre($ids)
    {
        $zone = $this->Zones->newEntity();
        if ($this->request->is('post')) {
			
			if(count($this->request->getData())==1){
				$z=$this->request->getData()['zones']; 
				//return $this->Flash->error(__($z));
				return $this->redirect($this->redirect(['controller'=>'ZonesUsers', 'action' => 'addre', $ids, $z]));
			}
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
			
			//$zonearray=$this->request->getData('users');
			
            if ($this->Zones->save($zone)) {
				
				//$userid=array('id'=>implode($zonearray));
				
				
				
				
                //$this->Flash->success(__('The {0} has been saved.', 'Zone'));
				
                return $this->redirect($this->redirect(['controller'=>'ZonesUsers', 'action' => 'addre', $ids, $zone['id']]));
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zone'));
        }
        $users = $this->Zones->Users->find('list', ['limit' => 200]);
		$zoness = $this->Zones->find('list', ['limit' => 200]);
        $this->set(compact('zone', 'ids', 'zoness'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $zone = $this->Zones->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zone = $this->Zones->patchEntity($zone, $this->request->getData());
            if ($this->Zones->save($zone)) {
                $this->Flash->success(__('The {0} has been saved.', 'Zone'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zone'));
        }
        $users = $this->Zones->Users->find('list', ['limit' => 200]);
        $this->set(compact('zone', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Zone id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zone = $this->Zones->get($id);
        if ($this->Zones->delete($zone)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Zone'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Zone'));
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
			if (in_array($action, ['view', 'add', 'addre', 'addlist', 'changeLanguage', 'mount'])) {
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
