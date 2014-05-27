<?php
/* @var $this EdbodataController */
/* @var $model EdboData */

$this->menu=array(
	array('label'=>'Перегляд та редагування', 'url'=>array('admin')),
);
?>

<h1>Створення нового запису <!--EdboData--></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>