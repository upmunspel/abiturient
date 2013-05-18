<?php
/* @var $this Personeducationpaymenttypescontroller */
/* @var $data Personeducationpaymenttypes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idEducationPaymentTypes')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idEducationPaymentTypes), array('view', 'id'=>$data->idEducationPaymentTypes)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EducationPaymentTypesName')); ?>:</b>
	<?php echo CHtml::encode($data->EducationPaymentTypesName); ?>
	<br />


</div>