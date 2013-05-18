<?php
/* @var $this BenefitController */
/* @var $data Benefit */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idBenefit')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idBenefit), array('view', 'id'=>$data->idBenefit)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BenefitName')); ?>:</b>
	<?php echo CHtml::encode($data->BenefitName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BenefitKey')); ?>:</b>
	<?php echo CHtml::encode($data->BenefitKey); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BenefitGroupID')); ?>:</b>
	<?php echo CHtml::encode($data->BenefitGroupID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Visible')); ?>:</b>
	<?php if ($data->Visible==0) {$rez ='ні';} else {$rez ='так';};?>
	<br />

	<?php echo CHtml::encode($data->Visible); ?>
	<br />


</div>
