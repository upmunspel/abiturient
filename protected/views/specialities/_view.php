<?php
/* @var $this Specialitiescontroller */
/* @var $data Specialities */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idSpeciality')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSpeciality), array('view', 'id'=>$data->idSpeciality)); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityName')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityName); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityKode')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityKode); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetID')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetID); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityClasifierCode')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityClasifierCode); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityBudgetCount')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityBudgetCount); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityContractCount')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityContractCount); ?>
	<br/> 
	<b><?php echo CHtml::encode($data->getAttributeLabel('isZaoch')); ?>:</b>
	<?php echo CHtml::encode($data->isZaoch); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('isPublishIn')); ?>:</b>
	<?php if ($data->isPublishIn==0) {$rez ='ні';} else {$rez ='так';};?>
	<br/>

	?>

</div>