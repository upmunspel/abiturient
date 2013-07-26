<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idPersonBenefits')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idPersonBenefits),array('view','id'=>$data->idPersonBenefits)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('PersonID')); ?>:</b>
	<?php echo CHtml::encode($data->PersonID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('BenefitID')); ?>:</b>
	<?php echo CHtml::encode($data->BenefitID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Series')); ?>:</b>
	<?php echo CHtml::encode($data->Series); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Numbers')); ?>:</b>
	<?php echo CHtml::encode($data->Numbers); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Issued')); ?>:</b>
	<?php echo CHtml::encode($data->Issued); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Modified')); ?>:</b>
	<?php echo CHtml::encode($data->Modified); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('SysUserID')); ?>:</b>
	<?php echo CHtml::encode($data->SysUserID); ?>
	<br />

	*/ ?>

</div>