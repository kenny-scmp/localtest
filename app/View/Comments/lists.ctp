<?php
/**
 * @var $this View
 */
?>
<div id="list_comments">
	<?php
	echo $this->Session->flash ();
	?>
	
	<?php foreach ($comments as $comment): ?>
		<p>
		<b>[<?php echo $comment['User']['username']?>]:</b>
				<?php echo nl2br($this->Text->wrap(h($comment['Comment']['body']), array('wordWrap'=>false))); ?>
				--
				<small>
					<?php echo $this->Time->timeAgoInWords($comment['Comment']['modified']); ?>
					<?php if ($authUser ['id'] == $comment ['Comment'] ['user_id']) :?>
						<a href="javascript:;" onclick="if (confirm('delete this comment?')) { deleteComment(<?php echo $comment['Comment']['id']?>); }">[x]</a>
					<?php endif ?>
				</small>
	</p>
	<?php endforeach;?>
	<?php
	$this->Paginator->options ( array (
			'url' => array (
					'controller' => 'comments',
					'action' => 'lists',
					'post_id' => $post_id 
			) 
	) );
	echo $this->element ( 'paginate', array (
			"updateDomId" => "#list_comments" 
	) );
	?>
</div>

<script>
function deleteComment(id) {
	var url = "<?php echo $this->Html->url(array('controller'=>'comments','action'=>'delete','page'=>$this->Paginator->current())); ?>";
	$.post(url, {id: id}, function(html) {
		$("#list_comments").html(html);
	});
}
</script>
