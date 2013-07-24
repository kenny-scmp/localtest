<!-- app/View/Users/add.ctp -->
<div class="users form">
<?php echo $this->Form->create('User', array('action'=>'add.ajax','novalidate', 'autocomplete'=>'off')); ?>
    <fieldset>
        <legend><?php echo __('Add User'); ?></legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'author' => 'Author')
        ));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<script>
    $(function() {
        $("#addAjaxForm").submit(function() {
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