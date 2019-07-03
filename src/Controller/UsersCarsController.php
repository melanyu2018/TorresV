<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * UsersCars Controller
 *
 * @property \App\Model\Table\UsersCarsTable $UsersCars
 *
 * @method \App\Model\Entity\UsersCar[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersCarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Cars']
        ];
        $usersCars = $this->paginate($this->UsersCars);

        $this->set(compact('usersCars'));
    }

    /**
     * View method
     *
     * @param string|null $id Users Car id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersCar = $this->UsersCars->get($id, [
            'contain' => ['Users', 'Cars']
        ]);

        $this->set('usersCar', $usersCar);
    }

    /** 
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addre($u, $c)
    {
        $usersCar = $this->UsersCars->newEntity();
		//$this->Flash->error(count($datos));
		$datos=array('user_id'=>$u, 'car_id'=>$c);
        //if ($this->request->is('post')) {
            $usersCar = $this->UsersCars->patchEntity($usersCar, $datos);
            if ($this->UsersCars->save($usersCar)) {
                $this->Flash->success(__('The users car has been saved.'));

                return $this->redirect(['controller'=>'Zones', 'action' => 'addre', $u]);
            }
            $this->Flash->error(__('The users car could not be saved. Please, try again.'));
        /*}
        $users = $this->UsersCars->Users->find('list', ['limit' => 200]);
        $cars = $this->UsersCars->Cars->find('list', ['limit' => 200]);
        $this->set(compact('usersCar', 'users', 'cars'));
		*/
		
    }
	public function add($u, $c)
    {
        $usersCar = $this->UsersCars->newEntity();
		//$this->Flash->error(count($datos));
		$datos=array('user_id'=>$u, 'car_id'=>$c);
        //if ($this->request->is('post')) {
            $usersCar = $this->UsersCars->patchEntity($usersCar, $datos);
            if ($this->UsersCars->save($usersCar)) {
                $this->Flash->success(__('The users car has been saved.'));

                return $this->redirect(['controller'=>'Cars', 'action' => 'index']);
            }
            $this->Flash->error(__('The users car could not be saved. Please, try again.'));
        /*}
        $users = $this->UsersCars->Users->find('list', ['limit' => 200]);
        $cars = $this->UsersCars->Cars->find('list', ['limit' => 200]);
        $this->set(compact('usersCar', 'users', 'cars'));
		*/
		
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Car id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersCar = $this->UsersCars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCar = $this->UsersCars->patchEntity($usersCar, $this->request->getData());
            if ($this->UsersCars->save($usersCar)) {
                $this->Flash->success(__('The users car has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users car could not be saved. Please, try again.'));
        }
        $users = $this->UsersCars->Users->find('list', ['limit' => 200]);
        $cars = $this->UsersCars->Cars->find('list', ['limit' => 200]);
        $this->set(compact('usersCar', 'users', 'cars'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Car id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersCar = $this->UsersCars->get($id);
        if ($this->UsersCars->delete($usersCar)) {
            $this->Flash->success(__('The users car has been deleted.'));
        } else {
            $this->Flash->error(__('The users car could not be deleted. Please, try again.'));
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
