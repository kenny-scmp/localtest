<?php
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
	public $displayField = 'username';
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post'
		),
		'Comment' => array(
			'className' => 'Comment'		
		)
	);
	
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required',
                'on'=>'create'
            )
        ),
        'role' => array(
            'valid' => array(
                'rule' => array('inList', array('admin', 'author')),
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        )
    );
    
    public function beforeSave($options = array()) {
    	if (isset($this->data[$this->alias]['password'])) {
    		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    	}
    	return true;
    }

    public function beforeValidate($options = array()){
        if (isset($this->data['User']['password']) && empty($this->data[$this->alias]['password'])) {
            unset($this->data[$this->alias]['password']);
        }
        return true;
    }
}
?>