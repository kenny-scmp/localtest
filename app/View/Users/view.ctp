<!-- File: /app/View/Users/view.ctp -->

<script>
$(function() {
	$("#datacontent").load("<?php echo $this->Html->url(array('controller'=>'Posts','action'=>'index.data','?'=>array('user_id'=>$user['User']['id'])));?>");	
});
</script>

<p>Username: <?php echo $user['User']['username']; ?></p>
<p>Role: <?php echo $user['User']['role']; ?></p>

<hr>
<div id="datacontent"></div>