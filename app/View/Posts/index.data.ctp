<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id', 'ID'); ?></th>
		<th><?php echo $this->Paginator->sort('title', 'Title'); ?></th>
		<th>Action</th>
		<th>By</th>
		<th>Created</th>
	</tr>

	<!-- Here is where we loop through our $posts array, printing out post info -->
    <?php foreach ($posts as $post) : ?>
	    <tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td>
	            <?php echo $this->Html->link($this->Text->truncate($post['Post']['title'],15), array('action' => 'view', $post['Post']['id']),array('escape' => false)); ?>
	        </td>
		<td>
	            <?php
					
echo $this->Form->postLink ( 'Delete', array (
							'action' => 'delete',
							$post ['Post'] ['id'] 
					), array (
							'confirm' => 'Are you sure?' 
					) );
					?>
	            <?php echo $this->Html->link('Edit', array('action' => 'edit', $post['Post']['id'])); ?>
	        </td>
	        <td>
	        	<?php echo $this->Html->link($post['User']['username'], array('controller'=>'Users','action' => 'view', $post['Post']['user_id'])); ?>
	        </td>
		<td>
	            <?php echo $this->Time->timeAgoInWords($post['Post']['created']); ?>
	        </td>
	</tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>

<?php echo $this->element('paginate', array("updateDomId"=>"#datacontent")); ?>