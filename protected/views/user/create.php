<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	
);
?>

<h1>Створити користувача User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>