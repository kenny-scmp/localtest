<!-- File: /app/View/Posts/index.ctp -->
<script>
$(function() {
	$("#datacontent").load("<?php echo $this->Html->url(array('action'=>'index.data'));?>");
});
</script>
<h1>Blog posts</h1>

<?php
echo $this->Html->link ( 'Add Post', array (
		'controller' => 'posts',
		'action' => 'add' 
) );
?>

<script>
function jsonview() {
	var url = "<?php echo $this->Html->url(array('action'=>'index.json')) ?>";
	$.getJSON(url, function(json) {
		console.log(json);
	});
}
</script>
<a href="javascript:;" onclick="jsonview()">jsonview</a>
<div id="datacontent"></div>