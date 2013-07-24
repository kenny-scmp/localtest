<div id="dialog-message" title="&nbsp;">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
    <?php echo $message; ?>
  </p>
</div>

<script>
$(function() {
	$( "#dialog-message" ).dialog({
		modal: true
	});
});
</script>