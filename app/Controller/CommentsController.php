<?php
/**
 * Class CommentsController
 * @property Comment $Comment
 */
class CommentsController extends AppController {
	public $helpers = array('Html', 'Form', 'Session');
	public $scaffold = 'admin';
    public $components = array('Paginator');
	
    public function add() {
		if ($this->request->is('post') && $this->request->data) {
			$post_id = $this->request->data['Comment']['post_id'];
			$data = $this->Comment->add($this->request->data, $this->Auth->user('id'));
			if ($data) {
				$this->Session->setFlash('Your comment has been saved.','dialog');
			} else {
				$this->Session->setFlash('Unable to add your comment.');
			}
			$this->lists($post_id);
		}
    }
    
    public function lists($post_id=null) {
	   	if ($this->request->is('ajax')) {
	   		if (!isset($post_id)) {
    			$post_id = $post_id ? $post_id : $this->request->params['named']['post_id'];
	   		}
            $this->Paginator->settings = $this->Comment->_Pagination($post_id);
    		$comments = $this->Paginator->paginate('Comment');
    		$this->set(compact('comments','post_id'));
    		$this->render('lists', false);
	   	}
    }
    
    public function delete() {
    	$id = $this->request->data['id'];
    	$post_id = $this->Comment->deleteComment($id);
        if ($post_id) {
    		$this->Session->setFlash('The comment with id: ' . $id . ' has been deleted.', 'dialog');
    	} else {
    		$this->Session->setFlash('Unable to delete comment');
    	}
    	$this->lists($post_id);
    }
}
?>