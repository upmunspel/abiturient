<?php
/* @var $this ContractsController */
/* @var $data Contracts */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idContract')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idContract), array('view', 'id'=>$data->idContract)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonSpecialityID')); ?>:</b>
	<?php echo CHtml::encode($data->PersonSpecialityID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractNumber')); ?>:</b>
	<?php echo CHtml::encode($data->ContractNumber); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContractDate')); ?>:</b>
	<?php echo CHtml::encode($data->ContractDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerName')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerDoc')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerDoc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerAddress')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerAddress); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CustomerPaymentDetails')); ?>:</b>
	<?php echo CHtml::encode($data->CustomerPaymentDetails); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PaymentDate')); ?>:</b>
	<?php echo CHtml::encode($data->PaymentDate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Comment')); ?>:</b>
	<?php echo CHtml::encode($data->Comment); ?>
	<br />

	*/ ?>

</div>