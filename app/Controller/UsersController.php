<?php
/**
 * @property User $User
 */
class UsersController extends AppController {
    public $components = array('RequestHandler','Paginator');
	public $scaffold = 'admin';
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('add');
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->redirect($this->Auth->redirect());
			} else {
				$this->Session->setFlash(__('Invalid username or password, try again'));
			}
		}
	}

    public function ping() {
        $this->autoRender = false;
    }
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}	

	public function index() {
		$this->User->recursive = 0;
        $this->Paginator->settings = array('limit'=>13,'order'=>'id desc');
        $users = $this->Paginator->paginate();
		$this->set(compact('users'));
        $this->set('_serialize', 'posts');
        if ($this->request->is('ajax')) {
            $this->render('index.data');
        }
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
            if ($this->request->is('ajax')) {
                $this->autoRender = false;
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $message = "OK";
                } else {
                    $message = "Error";
                    $errFields = $this->User->validationErrors;
                }
                echo json_encode(compact('message','errFields'));
            } else {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(json_encode($this->User->validationErrors));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
			//unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>