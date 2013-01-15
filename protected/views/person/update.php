<?php
$this->menu=array(
	array('label'=>'List Person','url'=>array('index')),
	array('label'=>'Create Person','url'=>array('create')),
	array('label'=>'View Person','url'=>array('view','id'=>$model->idPerson)),
	array('label'=>'Manage Person','url'=>array('admin')),
);
?>

<h1>Оновлення інформації про абітуріента (<?php echo $model->idPerson; ?>)</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>