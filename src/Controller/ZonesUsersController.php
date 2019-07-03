<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * ZonesUsers Controller
 *
 * @property \App\Model\Table\ZonesUsersTable $ZonesUsers
 *
 * @method \App\Model\Entity\ZonesUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ZonesUsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Zones', 'Users']
        ];
        $zonesUsers = $this->paginate($this->ZonesUsers);

        $this->set(compact('zonesUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Zones User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zonesUser = $this->ZonesUsers->get($id, [
            'contain' => ['Zones', 'Users']
        ]);

        $this->set('zonesUser', $zonesUser);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addre($id, $zone)
    {
        $zonesUser = $this->ZonesUsers->newEntity();
	/*$zone = $this->request->getData('zone_id');*/
	$datos=array('user_id'=>$id, 'zone_id'=>$zone);
        /*if ($this->request->is('post')) {*/
            $zonesUser = $this->ZonesUsers->patchEntity($zonesUser, $datos);
            /*if ($this->ZonesUsers->save($zonesUser)) {
                $this->Flash->success(__('The {0} has been saved.', 'Zones User'));
*/
                return $this->redirect(['controller'=>'Zones', 'action' => 'index']);
            /*}
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zones User'));
       	}*/
        $zones = $this->ZonesUsers->Zones->find('list', ['limit' => 200]);
        $users = $this->ZonesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('zonesUser', 'zones', 'users'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Zones User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $zonesUser = $this->ZonesUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zonesUser = $this->ZonesUsers->patchEntity($zonesUser, $this->request->getData());
            if ($this->ZonesUsers->save($zonesUser)) {
                $this->Flash->success(__('The {0} has been saved.', 'Zones User'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Zones User'));
        }
        $zones = $this->ZonesUsers->Zones->find('list', ['limit' => 200]);
        $users = $this->ZonesUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('zonesUser', 'zones', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Zones User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zonesUser = $this->ZonesUsers->get($id);
        if ($this->ZonesUsers->delete($zonesUser)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Zones User'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Zones User'));
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
