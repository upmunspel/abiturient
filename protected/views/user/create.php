<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Перелік користувачів','url'=>array('index'),'icon'=>"icon-list-alt"),
	array('label'=>'Управління користівачами','url'=>array('admin'),'icon'=>"icon-user"),
);
?>

<h1>Створити користувача User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>