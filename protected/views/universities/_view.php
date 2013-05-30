<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('IdUniversity')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->IdUniversity),array('view','id'=>$data->IdUniversity)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UniversityKode')); ?>:</b>
	<?php echo CHtml::encode($data->UniversityKode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('UniversityName')); ?>:</b>
	<?php echo CHtml::encode($data->UniversityName); ?>
	<br />


</div>