<?php
/* @var $this Countrycontroller */
/* @var $data Country */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idCountry')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idCountry), array('view', 'id'=>$data->idCountry)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CountryName')); ?>:</b>
	<?php echo CHtml::encode($data->CountryName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Visible')); ?>:</b>
	<?php if ($data->Visible==0) {$rez ='ні';} else {$rez ='так';};?>
	<br />

	<?php echo CHtml::encode($data->Visible); ?>
	<br />


</div>
