<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 *
 * @method \App\Model\Entity\Car[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $cars = $this->paginate($this->Cars);

        $this->set(compact('cars'));
    }

    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('car', $car);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
			$cararray=$this->request->getData('users');
			//$placa=$this->request->getData('car_plate');
            if ($this->Cars->save($car)) {
				//$this->Flash->error($car);
				//$this->Flash->error(implode(",", $cararray));
				//$carusers = $this->UsersCars->newEntity();
				$userid=array('id'=>implode($cararray));
				//$this->Flash->error($userid['id']);
				//$datos=array('user_id'=>$userid['id'], 'car_id'=>$car['id']);
				//$this->Flash->error(implode(", ", $datos));
				//$carusers = $this->UsersCars->patchEntity($carusers, $datos);
				$this->redirect(['controller'=>'UsersCars', 'action' => 'add', $userid['id'], $car['id']]); 
				//$this->Flash->error($cararray);
                $this->Flash->success(__('The {0} has been saved.', 'Car'));

                return $this->redirect(['action'=>'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
    }
	public function addre($ids)
    {
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->getData());
			//$cararray=$this->request->getData('users');
			//$placa=$this->request->getData('car_plate');
            if ($this->Cars->save($car)) {
				//$this->Flash->error($car);
				//$this->Flash->error(implode(",", $cararray));
				//$carusers = $this->UsersCars->newEntity();
				//$userid=array('id'=>implode($cararray));
				//$this->Flash->error($userid['id']);
				//$datos=array('user_id'=>$userid['id'], 'car_id'=>$car['id']);
				//$this->Flash->error(implode(", ", $datos));
				//$carusers = $this->UsersCars->patchEntity($carusers, $datos);
				$this->redirect(['controller'=>'UsersCars', 'action' => 'addre', $ids, $car['id']]); 
				//$this->Flash->error($cararray);
                $this->Flash->success(__('The {0} has been saved.', 'Car'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users', 'ids'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			
            $car = $this->Cars->patchEntity($car, $this->request->getData());
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Car id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car'));
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
