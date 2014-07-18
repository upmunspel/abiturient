<?php
/* @var $this EdbodataController */
/* @var $model EdboData */

$this->menu=array(
	array('label'=>'Додати новий запис', 'url'=>array('create')),
	array('label'=>'Перегляд та редагування', 'url'=>array('admin')),
);
?>

<h1>Оновлення запису № <?php echo $model->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>