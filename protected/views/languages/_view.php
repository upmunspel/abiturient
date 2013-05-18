<?php
/* @var $this Languagescontroller */
/* @var $data Languages */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idLanguages')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idLanguages), array('view', 'id'=>$data->idLanguages)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LanguagesCode')); ?>:</b>
	<?php echo CHtml::encode($data->LanguagesCode); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('LanguagesName')); ?>:</b>
	<?php echo CHtml::encode($data->LanguagesName); ?>
	<br />


</div>