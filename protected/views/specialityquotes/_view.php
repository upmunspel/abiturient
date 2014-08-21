<?php
/* @var $this SpecialityquotesController */
/* @var $data Specialityquotes */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('idSpecialityQuotes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idSpecialityQuotes), array('view', 'id'=>$data->idSpecialityQuotes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityID')); ?>:</b>
	<?php echo CHtml::encode($data->spec->SpecialityClasifierCode . ' ' .
    ((empty($data->spec->SpecialityName))? $data->spec->SpecialityDirectionName : $data->spec->SpecialityName) .
    ((empty($data->spec->SpecialitySpecializationName))? '' : ' (' . $data->spec->SpecialitySpecializationName . ')') . 
     ' ('.mb_substr($data->spec->eduform->PersonEducationFormName,0,1,'utf-8') . ')'); ?>
	<br />
  
	<b><?php echo CHtml::encode($data->getAttributeLabel('QuotaID')); ?>:</b>
	<?php echo CHtml::encode($data->quota->QuotaName); ?>
	<br />
  
	<b><?php echo CHtml::encode($data->getAttributeLabel('BudgetPlaces')); ?>:</b>
	<?php echo CHtml::encode($data->BudgetPlaces); ?>
	<br />
</div>
