<!-- index //-->
<?php
/**
 * @var $this View
 */
?>
<?=$this->Html->link('Add User', array('action'=>'add'))?>
<div id="UserIndexData"></div>

<script>
    $(function() {
        $("#UserIndexData").load("<?php echo $this->Html->url(array('action'=>'index.data'));?>");
    });
</script>