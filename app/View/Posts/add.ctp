<!-- File: /app/View/Posts/add.ctp -->
<?php
/**
 * @var $this View
 */
?>
<h1>Add Post</h1>
<?php
echo $this->Form->create('Post', array('type' => 'file'));
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->file('attachment');
echo $this->Form->end('Save Post');
?>