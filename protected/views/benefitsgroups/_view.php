<?php
/* @var $this BenefitsgroupsController */
/* @var $data Benefitsgroups */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idBenefitsGroups')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idBenefitsGroups), array('view', 'id'=>$data->idBenefitsGroups)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BenefitsGroupsName')); ?>:</b>
	<?php echo CHtml::encode($data->BenefitsGroupsName); ?>
	<br />


</div>