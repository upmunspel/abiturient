<?php
/* @var $this DocumentsController */
/* @var $data Documents */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idDocuments')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idDocuments), array('view', 'id'=>$data->idDocuments)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonID')); ?>:</b>
	<?php echo CHtml::encode($data->PersonID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('TypeID')); ?>:</b>
	<?php echo CHtml::encode($data->TypeID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Series')); ?>:</b>
	<?php echo CHtml::encode($data->Series); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numbers')); ?>:</b>
	<?php echo CHtml::encode($data->Numbers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateGet')); ?>:</b>
	<?php echo CHtml::encode($data->DateGet); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ZNOPin')); ?>:</b>
	<?php echo CHtml::encode($data->ZNOPin); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('AtestatValue')); ?>:</b>
	<?php echo CHtml::encode($data->AtestatValue); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Issued')); ?>:</b>
	<?php echo CHtml::encode($data->Issued); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('isCopy')); ?>:</b>
	<?php echo CHtml::encode($data->isCopy); ?>
	<br />

	*/ ?>

</div>