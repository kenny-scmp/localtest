<!-- edit //-->
<?php
/**
 * @var $this View
 */
?>
<div class="users form">
    <?php echo $this->Form->create('User', array('action'=>'edit','novalidate', 'autocomplete'=>'off')); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('id', array('type' => 'hidden'));
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
        ?>
        <?php
        debug($this->request->data['User']['password']);
        ?>
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>