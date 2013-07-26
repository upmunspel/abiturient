<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityID')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubjectID')); ?>:</b>
	<?php echo CHtml::encode($data->SubjectID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LevelID')); ?>:</b>
	<?php echo CHtml::encode($data->LevelID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Modified')); ?>:</b>
	<?php echo CHtml::encode($data->Modified); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SysUserID')); ?>:</b>
	<?php echo CHtml::encode($data->SysUserID); ?>
	<br />


</div>