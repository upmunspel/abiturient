<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPerson')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPerson),array('view','id'=>$data->idPerson)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Birthday')); ?>:</b>
	<?php echo CHtml::encode($data->Birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonSexID')); ?>:</b>
	<?php echo CHtml::encode($data->PersonSexID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FirstName')); ?>:</b>
	<?php echo CHtml::encode($data->FirstName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MiddleName')); ?>:</b>
	<?php echo CHtml::encode($data->MiddleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LastName')); ?>:</b>
	<?php echo CHtml::encode($data->LastName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('IsResident')); ?>:</b>
	<?php echo CHtml::encode($data->IsResident); ?>
	<br />

	

</div>