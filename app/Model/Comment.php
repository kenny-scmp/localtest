<?php
class Comment extends AppModel {
	public $actsAs = array('Containable');
    public $belongsTo = array(
        'Post' => array(
            'className'    => 'Post',
            'foreignKey'   => 'post_id'
        ),
    	'User' => array(
    		'className' => 'User',
    		'foreignKey' => 'user_id'
    	)
    );
	public $validate = array(
			'body' => array(
					'rule' => 'notEmpty'
			)
	);
	
	public function add($data, $user_id) {
		$data['Comment']['user_id'] = $user_id;
		$this->create();
		$data = $this->save($data);
		return $data;
	}
	
	public function deleteComment($id) {
		$post_id = $this->getById($id)['Comment']['post_id'];
		$result = $this->delete($id);
		if ($result) {
			return $post_id;
		} else {
			return false;
		}
	}
	
	public function isOwnedBy($comment, $user) {
		return $this->field('id', array('id' => $comment, 'user_id' => $user)) === $comment;
	}
	
	public function _Pagination($post_id=null) {
		$conditions = array();
		$params = array(
				'limit'=> 3,
				'order'=> array('Comment.created'=>'desc')
		);
		if (isset($post_id)) {
			$conditions = Hash::insert($conditions, 'post_id', $post_id);
		}
		$params = Hash::insert($params, 'conditions', $conditions);

		return $params;
	}
	
	
	public function getById($id) {
		return $this->findById($id);
	}
}
?>