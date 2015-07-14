<?php
/* @var $this ConvertAttestatController */
/* @var $data ConvertAttestat */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('twelve_p')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->twelve_p), array('view', 'id'=>$data->twelve_p)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('two_hundred_p')); ?>:</b>
	<?php echo CHtml::encode($data->two_hundred_p); ?>
	<br />


</div>