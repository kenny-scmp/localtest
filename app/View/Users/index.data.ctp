<!-- index.data //-->
<?php
/**
 * @var $this View
 */
?>

<table class="fixheader">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Action</th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user) : ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['username'], array('controller'=>'users','action' => 'view', $user['User']['id'])); ?>
        </td>
        <td>
            <?php
            echo $this->Form->postLink ( 'Delete', array (
                'action' => 'delete',
                $user['User']['id']
            ), array (
                'confirm' => 'Are you sure?'
            ) );
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
        </td>
        <td>
            <?php echo $this->Time->timeAgoInWords($user['User']['created']); ?>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
    <?php unset($user); ?>
</table>
<?php echo $this->element('paginate', array("updateDomId"=>"#UserIndexData")); ?>

<script>
    $(function() {
        $('.fixheader').tableScroll({height:200});
    });
</script>