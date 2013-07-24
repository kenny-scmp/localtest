<?php
if ($this->Paginator->params()['count'] >= 4) {
	$this->Paginator->options(array('update' => $updateDomId));
	
	// Shows the next and previous links
	echo $this->Paginator->prev(' << ', array(), null, array('class' => 'prev disabled'));
	
	// Shows the page numbers
	echo $this->Paginator->numbers(array('modulus'=>'4'));
	
	echo $this->Paginator->next(' >> ', null, null, array('class' => 'next disabled'));
	echo $this->Js->writeBuffer();
}
?>