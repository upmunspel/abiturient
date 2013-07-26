<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idUniversity')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idUniversity),array('view','id'=>$data->idUniversity)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UniversityKode')); ?>:</b>
	<?php echo CHtml::encode($data->UniversityKode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UniversityName')); ?>:</b>
	<?php echo CHtml::encode($data->UniversityName); ?>
	<br />


</div>