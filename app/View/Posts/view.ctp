<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?> by <?php echo $post['User']['username']?></small></p>

<p><?php echo nl2br($this->Text->wrap($post['Post']['body'])); ?></p>

<p><hr></p>
<?php echo $this->element('../Comments/lists', compact('comments')); ?>
	
<?php
echo $this->Form->create('Comment', array('controller'=>'comment','action'=>'add'));
echo $this->Form->input('post_id',array('type'=>'hidden','value'=>$post['Post']['id']));
echo $this->Form->input('body',array('label'=>false));
echo $this->Form->end('Save Comment');
?>
<script>
$(function() {
	$("#CommentAddForm").submit(function() {
		var $form = $(this);
		$form.ajaxSubmit({
			success: function(html) {
				$("#list_comments").html(html);
				$form.get(0).reset();
			}
		});
		return false;
	});
});
</script>


