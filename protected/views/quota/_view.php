<?php
/* @var $this QuotaController */
/* @var $data Quota */
?>

<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('idQuota')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idQuota), array('view', 'id'=>$data->idQuota)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('QuotaName')); ?>:</b>
	<?php echo CHtml::encode($data->QuotaName); ?>
	<br />
</div>
