<?php
namespace App\Controller;
use Cake\Mailer\Email;
use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\I18n;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Cars', 'Zones', 'Orders']
        ]);

        $this->set('user', $user);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$dni = $this->request->getData('dni');
			$name=$this->request->getData('name');
			$role=$this->request->getData('role_id');
			$lastname=$this->request->getData('surname');
			$email=$this->request->getData('email');
            $user = $this->Users->patchEntity($user, $this->request->getData());
        	if ($this->Users->save($user)) {
				
				
				
				
				
				
				
				
				if(($this->request->getData('image'))['name'] != null)
                {
                  $filename = $this->request->getData('image');
                  $idUser = $user['id'];
                  //Obtener la extensión del archivo
                  $ext = substr(strtolower(strrchr($filename['name'], '.')), 1);
                  if( intval($filename['size'])>0 && 
                  (intval($filename['size'])<=100000) && in_array($ext,['png','jpg' ,'gif','svg']) )
                  {
                    //$dir = new Folder(WWW_ROOT.'img');
				  if( move_uploaded_file($filename['tmp_name'], WWW_ROOT.'img'.DS.$idUser.'.'.$ext) )
                    {
                      $this->Flash->success(__('The image has upload sucessfully.'));
                    }else{
                      $this->Flash->error(__('The image has not upload.'));
                    }
                  }else{
                    $this->Flash->error(__('The size image is invalid.'));
                  }
                }else{
                  //$this->Flash->error(__('The image is null.'));
                }
				
				
				
				
				
				
				
				
				
				$email=new Email('default');
				$email->setTo($user->email)
					->setProfile('default')
					->setEmailFormat('html')
					->setSubject('Bienvenido')
					->send(sprintf('Usted '.$name.' a sido registrado con una cuenta en la empresa Torres. Gracias por su eleccion.'));  
				
                $this->Flash->success(__('The {0} has been saved.', 'User'));
				
				
				
				$r=$user['role_id'];
				
				if($r==2){
					return $this->redirect(['controller'=>'cars', 'action' => 'addre', $user['id']]);
				}
				return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $cars = $this->Users->Cars->find('list', ['limit' => 200]);
        $zones = $this->Users->Zones->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'cars', 'zones'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Cars', 'Zones']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));
				
				
				
				if(($this->request->getData('image'))['name'] != null)
                {
                  $filename = $this->request->getData('image');
                  $idUser = $user['id'];
                  //Obtener la extensión del archivo
                  $ext = substr(strtolower(strrchr($filename['name'], '.')), 1);
                  if( intval($filename['size'])>0 && 
                  (intval($filename['size'])<=100000) && in_array($ext,['png','jpg' ,'gif','svg']) )
                  {
                    //$dir = new Folder(WWW_ROOT.'img');
				  if( move_uploaded_file($filename['tmp_name'], WWW_ROOT.'img'.DS.$idUser.'.'.$ext) )
                    {
                      $this->Flash->success(__('The image has upload sucessfully.'));
                    }else{
                      $this->Flash->error(__('The image has not upload.'));
                    }
                  }else{
                    $this->Flash->error(__('The size image is invalid.'));
                  }
                }else{
                  $this->Flash->error(__('The image is null.'));
                }	
				
				
				
				
				
				
				

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $cars = $this->Users->Cars->find('list', ['limit' => 200]);
        $zones = $this->Users->Zones->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'cars', 'zones'));
    }


    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	 
	 
	  public function editper($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Cars', 'Zones']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The {0} has been saved.', 'User'));
				
				
				
				if(($this->request->getData('image'))['name'] != null)
                {
                  $filename = $this->request->getData('image');
                  $idUser = $user['id'];
                  //Obtener la extensión del archivo
                  $ext = substr(strtolower(strrchr($filename['name'], '.')), 1);
                  if( intval($filename['size'])>0 && 
                  (intval($filename['size'])<=100000) && in_array($ext,['png','jpg' ,'gif','svg']) )
                  {
                    //$dir = new Folder(WWW_ROOT.'img');
				  if( move_uploaded_file($filename['tmp_name'], WWW_ROOT.'img'.DS.$idUser.'.'.$ext) )
                    {
                      $this->Flash->success(__('The image has upload sucessfully.'));
                    }else{
                      $this->Flash->error(__('The image has not upload.'));
                    }
                  }else{
                    $this->Flash->error(__('The size image is invalid.'));
                  }
                }else{
                  $this->Flash->error(__('The image is null.'));
                }	
				
				
				
				
				
				
				

                return $this->redirect('/');
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'User'));
        }
        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $cars = $this->Users->Cars->find('list', ['limit' => 200]);
        $zones = $this->Users->Zones->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'cars', 'zones'));
    }

	 
	 
	 
	 
	 
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The {0} has been deleted.', 'User'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'User'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function login()
	{
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			$isHuman = captcha_validate($this->request->getData('CaptchaCode')); 
			if ($isHuman) { 
				if ($user) {
					$s=$this->Users->findById($user['id'])->first();
					if($s['status'] === false){
						$this->Flash->error('Desactivado');
						return $this->redirect($this->Auth->redirectUrl('/Users/login'));
					}
					$this->Auth->setUser($user);
					return $this->redirect($this->Auth->redirectUrl());
				}
				$this->Flash->error(__('Your username or password is incorrect.')); 
			}
			$this->Flash->error('Captcha is incorrect.');
		}
	}
	
	public function initialize()
	{
		parent::initialize();
		$this->Auth->allow(['logout']);
		$this->loadComponent('CakeCaptcha.Captcha', [
			'captchaConfig' => 'ExampleCaptcha' 
			]);  
	}
	public function logout()
	{
		$this->Flash->success(__('You are now logged out.'));
		return $this->redirect($this->Auth->logout());
		
	}

	public function isAuthorized($user)
	{	
		$u=$this->Users->findById($user['id'])->first();
		if($u['role_id'] == 1){
			$action = $this->request->getParam('action');
			// The add and tags actions are always allowed to logged in users.
			if (in_array($action, ['view', 'index', 'add', 'edit', 'delete', 'addre', 'addlist', 'changeLanguage', 'pay', 'deliv', 'mount'])) {
				return true;
			}
		}
		if($u['role_id'] == 2){
			$action = $this->request->getParam('action');
			// The add and tags actions are always allowed to logged in users.
			if (in_array($action, ['view', 'changeLanguage', 'edit', 'editper'])) {
				return true;
			}
		}
		return false;
		// All other actions require a slug.
		$usuario = $this->request->getParam('pass.0');
		if (!$usuario) {
			return false;
		}
		$s=$this->Users->findById($user['id'])->first();
		if($s['status'] === false){
			$this->Flash->error('Desactivado');
		$this->redirect($this->Auth->logout());
			return false;
	}
	
}
}
