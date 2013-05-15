<?php
$this->menu=array(
	array('label'=>'Перелік абітурієнтів','url'=>array('index'),'icon'=>"icon-list-alt"),
	array('label'=>'Додати  абітурієнта','url'=>array('create'),'icon'=>"icon-plus"),
	
);
?>

<h1>Оновлення інформації про абітуріента (<?php echo $model->idPerson; ?>)</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>