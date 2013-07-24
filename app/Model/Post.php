<?php
class Post extends AppModel {
	public $actsAs = array('Containable', 'AuditLog.Auditable');
    public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        )
    );
    public $hasMany = array(
    	'Comment' => array(
    		'className' => 'Comment'
    	)
    );
	public $validate = array(
			'title' => array(
					'rule' => 'notEmpty'
			),
			'body' => array(
					'rule' => 'notEmpty'
			)
	);
	
	public function isOwnedBy($post, $user) {
		return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
	}
}
?>