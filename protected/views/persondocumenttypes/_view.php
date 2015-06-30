<?php
/* @var $this PersondocumenttypesController */
/* @var $data PersonDocumentTypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonDocumentTypes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonDocumentTypes), array('view', 'id'=>$data->idPersonDocumentTypes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonDocumentTypesName')); ?>:</b>
	<?php echo CHtml::encode($data->PersonDocumentTypesName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsEntrantDocument')); ?>:</b>
	<?php echo CHtml::encode($data->IsEntrantDocument); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display')); ?>:</b>
	<?php echo CHtml::encode($data->display); ?>
	<br />


</div>