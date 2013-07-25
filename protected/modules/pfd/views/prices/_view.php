<?php
/* @var $this PricesController */
/* @var $data Prices */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPrice')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPrice), array('view', 'id'=>$data->idPrice)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultetID')); ?>:</b>
	<?php echo CHtml::encode($data->FacultetID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SpecialityID')); ?>:</b>
	<?php echo CHtml::encode($data->SpecialityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PriceYearInNumbers')); ?>:</b>
	<?php echo CHtml::encode($data->PriceYearInNumbers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PriceSemesterInNumbers')); ?>:</b>
	<?php echo CHtml::encode($data->PriceSemesterInNumbers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PriceYearInWords')); ?>:</b>
	<?php echo CHtml::encode($data->PriceYearInWords); ?>
	<br />


</div>