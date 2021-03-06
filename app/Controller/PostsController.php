<?php
/**
 * @property Post $Post
 */
class PostsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session', 'Paginator','Js');
    public $components = array('Session','RequestHandler');
    public $paginate = array('limit' => 3,'order'=> array('Post.created'=>'desc'));
    public $scaffold = 'admin';
    
    public function index() {
        if ($this->request->is('ajax')) {
        	$user_id = $this->request->query ? $this->request->query['user_id'] : null;
        	if (isset($user_id)) {
        		$posts = $this->paginate(array('user_id'=>$user_id));
        	} else {
        		$posts = $this->paginate();
        	}
        	$this->set(compact('posts'));
        	$this->set('_serialize', 'posts');
        	$this->render('index.data');
        }
    }

    public function view($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('Invalid post'));
    	}
    	$post = $this->Post->findById($id);

    	if (!$post) {
    		throw new NotFoundException(__('Invalid post'));
    	}    	
    	
    	$this->paginate = $this->Post->Comment->_Pagination($id);
    	$comments = $this->paginate($this->Post->Comment);

    	$this->set(compact('post','comments'));
    	$this->set('post_id', $id);
    }
    public function add() {
    	if ($this->request->is('post')) {
    		$this->request->data['Post']['user_id'] = $this->Auth->user('id'); //Added this line

            $attachment = $this->request->data['Post']['attachment'];
            if ($attachment["size"]>0) {
                $attachment = fread(fopen($attachment['tmp_name'],"r"), $attachment['size']);
                $this->request->data['Post']['attachment'] = $attachment;
            }

    		$this->Post->create();
    		if ($this->Post->save($this->request->data)) {
    			$this->Session->setFlash('Your post has been saved.','dialog');
    			$this->redirect(array('action' => 'index'));
    		} else {
    			$this->Session->setFlash('Unable to add your post.');
    		}
    	}
    }
    
    public function edit($id = null) {
    	if (!$id) {
    		throw new NotFoundException(__('Invalid post'));
    	}
    
    	$post = $this->Post->findById($id);
    	if (!$post) {
    		throw new NotFoundException(__('Invalid post'));
    	}
    
    	if ($this->request->is('post') || $this->request->is('put')) {
    		$this->Post->id = $id;
    		if ($this->Post->save($this->request->data)) {
    			$this->Session->setFlash('Your post has been updated.');
    			$this->redirect(array('action' => 'index'));
    		} else {
    			$this->Session->setFlash('Unable to update your post.');
    		}
    	}
    
    	if (!$this->request->data) {
    		$this->request->data = $post;
    	}
    }
    
    public function delete($id) {
    	if ($this->request->is('get')) {
    		throw new MethodNotAllowedException();
    	}
    
    	if ($this->Post->delete($id)) {
    		$this->Session->setFlash('The post with id: ' . $id . ' has been deleted.');
    		$this->redirect(array('action' => 'index'));
    	}
    }
    
    public function isAuthorized($user) {
    	// All registered users can add posts
    	if ($this->action === 'add') {
    		return true;
    	}
    
    	// The owner of a post can edit and delete it
    	if (in_array($this->action, array('edit', 'delete'))) {
    		$postId = $this->request->params['pass'][0];
    		if ($this->Post->isOwnedBy($postId, $user['id'])) {
    			return true;
    		} else {
    			$this->Session->setFlash('Unable to update posts owned by others.');
    			return false;
    		}
    	}
    
    	return parent::isAuthorized($user);
    }    
}
?>